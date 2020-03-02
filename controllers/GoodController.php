<?php
namespace App\controllers;

use App\models\Good;

class GoodController
{
    protected $defaultAction = 'index';

    public function run($actionName)
    {
        if (empty($actionName)) {
            $actionName = $this->defaultAction;
        }
        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            return $this->$actionName();
        }
        return '404';
    }

    public function indexAction()
    {
        return $this->render('home');
    }

    public function oneAction()
    {
        $id = (int)$_GET['id'];
        $good = Good::getOne($id);
        return $this->render(
            'good',
            [
                'good' => $good,
                'title' => 'Католог товаров',
            ]
        );
    }

    public function allAction()
    {
        $goods = Good::getAll();
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
        if (empty($_GET['id'])){
            return $this->render(
                'edit',
                [
                    'title' => 'Внести новый товар',
                ]
            );
        }
        $id = (int)$_GET['id'];
        $good = Good::getOne($id);
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
        header('Content-Type: application/json');;

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return json_encode([
                'success' => false,
                'error' => 'Ошибка доступа'
            ]);
        }
        if (!empty($_GET['name']) && !empty($_GET['info'] && !empty($_GET['price']))) {
            $good = new Good();
            if (!empty($_GET['id'])) {
                $good->setId($_GET['id']);
            }
            $good->setName($_GET['name']);
            $good->setInfo($_GET['info']);
            $good->setPrice($_GET['price']);

            $good->save();
            $params = [
                'success' => true,
            ];
            echo json_encode($params);
        }

    }

    protected function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl(
            'layouts/main',
            ['content' => $content]
        );
    }

    protected function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include dirname(__DIR__) . '/views/' . $template . '.php';
        return ob_get_clean();
    }
}
