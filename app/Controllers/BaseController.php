<?php

namespace App\Controllers;

use App\Models\Admin;
use App\MVC;

class BaseController
{
    protected $app;

    public function __construct(MVC $app)
    {
        $this->app = $app;
    }

    public function json(array $data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function redirect($path, $query = [])
    {
        $queryString = "";
        if (count($query) > 0) {
            $queryString = "?" . http_build_query($query);
        }

        header('Location: ' . $path . $queryString);
        exit();
    }

    public function redirectBack($query = [])
    {
        $this->redirect($_SERVER['HTTP_REFERER'], $query);
    }

    protected function validate(array $var, array $rules) : bool {
        foreach ($rules as $rule) {
            if (! isset($var[$rule]) or ! $var[$rule]) {
                return false;
            }
        }
        return true;
    }
}