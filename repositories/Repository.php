<?php
namespace App\repositories;

use App\entities\Entity;
use App\services\DB;

/**
 * Class Model
 * @property $id
 */
abstract class Repository
{
    /**
     * @var DB
     */
    protected $db;

    abstract protected function getTableName():string ;
    abstract protected function getEntityName():string ;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = static::getDB();
    }

    /**
     * @return DB
     */
    protected static function getDB()
    {
        return DB::getInstance();
    }

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return static::getDB()->findObject($sql, $this->getEntityName(), [':id' => $id]);
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return static::getDB()->findObjects($sql, $this->getEntityName());
    }

    protected function insert(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $key => $value) {
            if ($key === 'db' || $key ==='currency') {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $tableName = $this->getTableName();
        $fields = implode(',', $columns);
        $placeholders = implode(',', array_keys($params));
        $sql = "INSERT INTO {$tableName} ({$fields}) VALUES ($placeholders)";
        $this->db->execute($sql, $params);

        $entity ->id = $this->db->lastInsertId();
    }

    protected function update(Entity $entity)
    {
        foreach ($entity as $key => $value) {
            if ($key == 'db' || $key=='currency') {
                continue;
            }
            $statementsToUpdate[] = " {$key} = :{$key} ";
            $values[":{$key}"] = $value;
        }

        $implodedStatments = implode(',', $statementsToUpdate);
        $sql = "UPDATE {$this->getTableName()} SET {$implodedStatments} WHERE id={$entity->id}";
        $this->db->execute($sql, $values);
    }

    public function delete(Entity $entity)
    {
        $sql = "DELETE FROM {$this->getTableName()} WHERE id = :id";
        $this->db->execute($sql, [':id' => $entity->id]);
    }

    public function save(Entity $entity)
    {
        if (!$entity->getId()) {
            $this->insert($entity);
            return;
        }

        $this->update($entity);
    }
}