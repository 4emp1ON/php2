<?php


namespace App\repositories;


use App\entities\User;

class UserRepository extends Repository
{
    /**
     * Class UserRepository
     *
     * @method User getOne($id)
     */
    protected function getTableName(): string
    {
        return 'users';
    }

    protected function getEntityName(): string
    {
        return User::class;
    }

    public function getOne($name)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE name = :name";
        return static::getDB()->findObject($sql, $this->getEntityName(), [':name' => $name]);
    }
}