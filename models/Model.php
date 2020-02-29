<?php
namespace App\models;

use App\services\DB;

/**
 * Class Model
 */
abstract class Model
{

    /**
     * @var DB
     */
    protected $db;

    abstract protected function getTableName():string ;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->find($sql, [':id' => $id]);
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->findAll($sql);
    }

    public function getOneObject($id)
    {
        $sql = "SELECT * FROM {$this->getTableName()} WHERE id = :id";
        return $this->db->findObject($sql, static::class, [':id' => $id]);
    }

    public function getAllObjects()
    {
        $sql = "SELECT * FROM {$this->getTableName()}";
        return $this->db->findAllObjects($sql, static::class);
    }

    protected function insert()
    {
        foreach ($this as $key => $value) {
            if ($key == 'db') {
                continue;
            }
            $keys[] = $key;
            $values[":{$key}"] = $value;
        }
        $cols = implode(', ', $keys);
        $valuesString = implode(',', array_keys($values));
        $sql = "INSERT INTO {$this->getTableName()} ({$cols}) VALUES ({$valuesString})";
        $this->db->execute($sql, $values);
        $this->id = $this->db->lastInsertId();
    }

    public function update()
    {
        foreach ($this as $key => $value) {
            if ($key == 'db') {
                continue;
            }
            $statementsToUpdate[] = " {$key} = :{$key} ";
            $values[":{$key}"] = $value;
        }

        $implodedStatments = implode(',', $statementsToUpdate);
        $sql = "UPDATE {$this->getTableName()} SET {$implodedStatments} WHERE id={$this->id}";
        $this->db->execute($sql, $values);
    }

    public function delete()
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $this->db->execute($sql, [':id' => $this->id]);
    }

    public function save()
    {
        if (!$this->id) {
            $this->insert();
            return;
        }

        $this->update();
    }
}