<?php

namespace App\Controllers;

class BmiController extends BaseController
{
    public function halamanBMI()
    {
        return $this->app->render('bmi');
    }
}