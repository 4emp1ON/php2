<?php

namespace App\controllers;


use App\main\App;
use App\services\renders\IRenderer;
use App\services\Request;

abstract class Controller
{
    const SESSION_NAME_GOODS = 'good';
    protected $defaultAction = 'index';
    protected $renderer;
    protected $request;
    protected $app;

    public function __construct(IRenderer $renderer, Request $request, App $app)
    {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->app = $app;
    }

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

    protected function getId()
    {
        return (int)$this->request->get('id');
    }

    protected function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }

    public function redirect($path = '') {
        return $this->request->redirect($path);
    }

}
