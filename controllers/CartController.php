<?php
namespace App\controllers;


use App\entities\Order;

class CartController extends Controller
{

    public function indexAction() {
        return $this->render(
            'cart',
            [
                'goods' => $this->app->cartService->getCart($this->app),
                'title' => 'Корзина',
                'msg' => $this->request->getMsg(),
                'total' => $this->app->cartService->calcTotal($this->app),
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
        $msg = $this->app->cartService->drop($id, $this->app);
        $this->request->addMsg($msg);
        $this->redirect();
    }

    public function orderAction(){
        if (!$this->request->isPost()) {
            $this->request->addMsg('Неверные параметры запроса');
            $this->redirect('/cart/');
        }
        $post = $this->request->post();
        if (!empty($post['email']) && !empty($post['address']) && !empty($this->request->getSession('good'))) {
            $user = $this->request->getSession('user');
            $order = new Order();
            $order->setUserId(!empty($user) ? $user->id : 0); // 0 - guest
            $order->setGoods(json_encode($this->request->getSession('good'), JSON_UNESCAPED_UNICODE));
            $order->setTotal($this->app->cartService->calcTotal($this->app));
            $order->setEmail($post['email']);
            $order->setAddress($post['address']);
            $order->setOrderDate(date("Y-m-d H:i:s"));
            $this->app->orderRepository->save($order);
            $this->request->setSession('good', '');
            $this->request->addMsg('Заказ успешно оформлен');
            $this->redirect('/good/all');

        } else {
            $this->request->addMsg('Ошибка формирования заказа');
            $this->redirect('/user/lk');
        }
    }
}