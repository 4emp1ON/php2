<?php
namespace App\controllers;


class CartController extends Controller
{

    public function indexAction() {
        return $this->render(
            'cart',
            [
                'goods' => $this->app->cartService->getCart($this->app),
                'title' => 'Корзина',
            ]
        );
    }

    public function addAction()
    {
        $id = $this->getId();
        $msg = $this->app->cartService->add($id, $this->app);
        $this->request->addMsg($msg);
        $this->redirect();
    }

    public function dropAction() {
        $id = $this->getId();
        $this->app->cartService->drop($id, $this->app);
        $this->redirect();
    }

}
