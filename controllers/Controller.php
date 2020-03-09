<?php

namespace App\controllers;


use App\services\renders\IRenderer;

abstract class Controller
{
    protected $defaultAction = 'index';
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
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

    protected function render($template, $params = [])
    {
        return $this->renderer->render($template, $params);
    }
}
