<?php

namespace App\Controllers;

use App\Database;
use App\Models\Member;

class ProfileController extends BaseController
{

    public function halamanProfil()
    {
        $profile = Member::me();
        $activities = count($profile->activities());
        $total = array_reduce($profile->activities(), function($carry, $activity) {
            $carry['time'] = $carry['time'] + $activity->time;
            $carry['calories'] = $carry['calories'] + $activity->calories;
            return $carry;
        }, ['time' => 0, 'calories' => 0]);
        return $this->app->render('profile', compact('profile', 'activities', 'total'));
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