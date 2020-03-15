<?php
namespace App\controllers;

use App\entities\Good;

class GoodController extends Controller
{
    protected $repository;

    public function indexAction()
    {
        return $this->render('home');
    }


    public function oneAction()
    {
        $id = $this->getId();
        $good = $this->app->goodRepository->getOne($id);
        return $this->render(
            'good',
            [
                'good' => $good,
                'title' => 'Католог товаров',
                'msg' => $this->request->getMsg(),
            ]
        );
    }

    public function allAction()
{
    $goods = $this->app->goodRepository->getAll();
    return $this->render(
        'goods',
        [
            'goods' => $goods,
            'title' => 'Католог товаров',
        ]
    );
}

    public function editAction()
    {
        if (empty($this->getId())){
            return $this->render(
                'edit',
                [
                    'title' => 'Внести новый товар',
                ]
            );
        }
        $id = $this->getId();
        $good = $this->app->goodRepository->getOne($id);
        return $this->render(
            'edit',
            [
                'good' => $good,
                'title' => 'Изменение товара',
            ]
        );
    }


    public function ajaxAction()
    {
        header('Content-type: application/json');
        $params = [
            'error' => 'asdasd',
            'hello' => 'world',
        ];
        return json_encode($params);
    }

    public function fetchEditAction()
    {
        header('Content-Type: application/json');

        if (!$this->request->isPost()) {
            return json_encode([
                'success' => false,
                'error' => '123'
            ]);
        }
        if (!empty($_GET['name']) && !empty($_GET['info'] && !empty($_GET['price']))) {
            $good = new Good();
            if (!empty($this->getId())) {
                $good->setId($this->getId());
            }
            $good->setName($_GET['name']);
            $good->setInfo($_GET['info']);
            $good->setPrice($_GET['price']);

            $this->app->goodRepository->save($good);
            $params = [
                'success' => true,
                'good' => $good
            ];
            return json_encode($params);
        }

        return [];

    }

}
