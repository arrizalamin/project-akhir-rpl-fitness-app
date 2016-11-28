<?php

namespace App\Controllers;

use App\Models\Barang;
use App\Models\Harga;
use App\Models\Member;
use App\MVC;

class AuthenticationController extends BaseController
{
    private $model;

    public function __construct(MVC $app)
    {
        parent::__construct($app);
        $this->model = new Member();
    }

    public function halamanLogin()
    {
        return $this->app->render('login');
    }

    public function login($req)
    {
        if (! $this->validate($req, ['username', 'password'])) {
            return $this->redirect('/login');
        }
        if ($this->model->check($req)) {
            $this->saveToken($req['username'], $req['password']);
            $this->redirect('/');
        }
        $this->redirect('/login');
    }

    public function halamanRegister()
    {
        return $this->app->render('register');
    }

    public function register($req)
    {
        if (! $this->validate($req, ['username', 'password', 'password_confirmation'])) {
            return $this->redirect('/register');
        }
        if ($req['password'] !== $req['password_confirmation']) {
            return $this->redirect('/register');
        }
        if ($this->model->register($req)) {
            $this->saveToken($req['username'], $req['password']);
            return $this->redirect('/');
        }
        return $this->redirect('/register');
    }

    public function logout()
    {
        setcookie('token', '', 1);
        return $this->redirect('/login');
    }

    public function isAuthenticated()
    {
        if (! $this->validate($_COOKIE, ['token'])) {
            return $this->redirect('/login');
        }
        if ( ! $this->model->check(getToken()) ) {
            return $this->logout();
        }
    }

    private function saveToken($username, $password)
    {
        $token = base64_encode($username . ':' . $password);
        echo base64_decode($token);
        setcookie('token', $token, time() + (60 * 60 * 24));
    }
}