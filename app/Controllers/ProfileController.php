<?php

namespace App\Controllers;

class ProfileController extends BaseController
{

    public function halamanProfil()
    {
        return $this->app->render('profile');
    }

    public function halamanEditProfil()
    {
        return $this->app->render('edit_profile');
    }

}