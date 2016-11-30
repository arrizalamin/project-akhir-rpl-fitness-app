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

    public function halamanLogin($req)
    {
        return $this->app->render('login', compact('req'));
    }

    public function login($req)
    {
        if (! $this->validate($req, ['username', 'password'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }
        if ($this->model->verify($req)) {
            $this->saveToken($req['username'], $req['password']);
            $this->redirect('/');
        }
        $this->redirectBack(['error' => 'username and password combination is not valid']);
    }

    public function halamanRegister($req)
    {
        return $this->app->render('register', compact('req'));
    }

    public function register($req)
    {
        if (! $this->validate($req, ['username', 'password', 'password_confirmation'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }
        if ($req['password'] !== $req['password_confirmation']) {
            return $this->redirectBack(['error' => 'password and password confirmation are not matched']);
        }
        if ($this->model->register($req)) {
            $this->saveToken($req['username'], $req['password']);
            return $this->redirect('/');
        }
        return $this->redirect('/register', ['error' => 'username is not available']);
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
        if ( ! $this->model->verify(getToken()) ) {
            return $this->logout();
        }
    }

    private function saveToken($username, $password)
    {
        $token = base64_encode($username . ':' . $password);
        setcookie('token', $token, time() + (60 * 60 * 24));
    }
}