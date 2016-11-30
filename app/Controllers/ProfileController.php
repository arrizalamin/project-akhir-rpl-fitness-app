<?php

namespace App\Controllers;

use App\Database;
use App\Models\Member;

class ProfileController extends BaseController
{

    public function halamanProfil()
    {
        return $this->app->render('profile');
    }

    public function halamanEditProfil()
    {
        $profile = Member::me();
        return $this->app->render('edit_profile', compact('profile'));
    }

    public function simpanProfil($req)
    {
        if (! $this->validate($req, ['username', 'password'])) return $this->redirectBack();
        $profile = Member::me();
        $profile->update($req);
        return $this->redirect('/profile');
    }

    public function deleteProfile()
    {
        Member::me()->delete('username');
        return $this->redirect('/');
    }

}