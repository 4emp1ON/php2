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

    protected function insert()
    {
        foreach ($this as $key => $value) {
            echo 'Key^ ' . $key;
            var_dump($value);
        }
    }

    protected function update()
    {
        foreach ($this as $key => $value) {
            echo 'Key^ ' . $key;
            var_dump($value);
        }
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