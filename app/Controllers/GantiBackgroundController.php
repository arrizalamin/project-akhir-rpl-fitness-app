<?php

namespace App\Controllers;

use App\Models\Member;

class GantiBackgroundController extends BaseController
{
    public function halamanGantiBackground()
    {
        return $this->app->render('color_scheme');
    }

    public function simpanWarna($req)
    {
        if (! $this->validate($req, ['color'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }
        Member::me()->update($req);
        return $this->redirect('/profile');
    }
}