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

    public function ajaxAction()
    {
        header('Content-type: application/json');
        $params = [
            'error' => 'asdasd',
        ];
        return json_encode($params);
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
