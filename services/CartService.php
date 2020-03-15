<?php


namespace App\services;


use App\controllers\Controller;
use App\main\App;

class CartService
{

    public function getCart(App $app)
    {
        $goods = $app->request->getSession(Controller::SESSION_NAME_GOODS);
        if (empty($goods)) {
            $goods = [];
        }
        return $goods;
    }

    public function add($id, App $app) {

        if (empty($id)) {
            return 'Не передан ID товара';
        }

        $good = $app->goodRepository->getOne($id);

        if (empty($good)) {
            return 'Товар не найден';
        }

        $goods = $app->request->getSession(Controller::SESSION_NAME_GOODS);
        if (is_array($goods) && array_key_exists($id, $goods)){
            $goods[$id]['count']++;
        } else {
            $goods[$id] = [
                'name' => $good->getName(),
                'price' => $good->getPrice(),
                'count' => 1
            ];
        }

        $app->request->setSession('good', $goods);
        return 'Товар успешно добавлен';
    }

    public function drop($id, App $app) {
        if (empty($id)) {
            return 'Не передан ID товара';
        }
        $goods = $app->request->getSession(Controller::SESSION_NAME_GOODS);
        if (is_array($goods) && array_key_exists($id, $goods)) {
            if ($goods[$id]['count']>1) {
                $goods[$id]['count']--;
            } else {
                unset($goods[$id]);
            }
        }
        $app->request->setSession('good', $goods);
        return 'Товар удален';
    }
}