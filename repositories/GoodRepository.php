<?php


namespace App\repositories;


use App\entities\Good;

class GoodRepository extends Repository
{
    /**
     * Class GoodRepository
     *
     * @method Good getOne($id)
     */
    protected function getTableName(): string
    {
        return 'goods';
    }

    protected function getEntityName(): string
    {
        return Good::class;
    }
}