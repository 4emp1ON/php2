<?php


namespace App\repositories;


use App\entities\Order;

class OrderRepository extends Repository
{
    /**
     * Class GoodRepository
     *
     * @method Order getOne($id)
     */
    protected function getTableName(): string
    {
        return 'orders';
    }

    protected function getEntityName(): string
    {
        return Order::class;
    }

    public function getAllOrders($userId)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE userId = :userId";
        $results = static::getDB()->findObjects($sql, $this->getEntityName(), [':userId' => $userId]);
        foreach ($results as $result) {
            $result->goods = json_decode($result->goods, JSON_UNESCAPED_UNICODE);
        }
        return $results;
    }
}