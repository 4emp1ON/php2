<?php

namespace App\controllers;

use App\entities\User;

class UserController extends Controller
{

    public function indexAction()
    {
        return $this->render('login',
            [
                'msg' => $this->request->getMsg()
            ]);
    }

    public function loginAction()
    {
        if (
            !empty($this->request->post('userName')) &&
            !empty($this->request->post('password')) &&
            $this->request->isPost()) {

                $userName = $this->request->post('userName');
                $password = $this->request->post('password');
                $user = $this->app->userRepository->getOne($userName);

                if (password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user;
                    $this->redirect('/user/lk');
                    exit;
                }
        }
        $_SESSION['msg'] = 'Неправильный логин или пароль';
        $this->redirect('/user/');
    }

    public function lkAction()
    {
        if (!empty($_SESSION['user'])) {
            $user = $_SESSION['user'];
            return $this->render(
                'user',
                [
                    'user' => $user,
                    'title' => 'Личный кабинет',
                    'msg' => $this->request->getMsg(),
                    'orders' => $this->app->orderRepository->getAllOrders($user->id)
                ]
            );
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['user']);
        $_SESSION['msg'] = 'Выполнен выход';
        $this->app->cartService->clearCart($this->app);
        $this->redirect('/user/');
    }

//    public function allAction()
//    {
//        $a = $_SERVER['HTTP_REFERER'];
//        header('Location: ' . $a);
//
//        if ($_SESSION['user']['isAdmin'] === 1) {
//            $users = $this->app->userRepository->getAll();
//            return $this->render(
//                'goods',
//                [
//                    'goods' => $users,
//                    'title' => 'Список пользователей сайта',
//                ]
//            );
//        }
//    }
}
