<?php

namespace App\Controllers;

class BmiController extends BaseController
{
    public function halamanBMI($req)
    {
        return $this->app->render('bmi', compact('req'));
    }

    public function calculate($req)
    {
        if (! $this->validate($req, ['height', 'weight'])) return $this->redirectBack();

        $bmi = $req['weight'] / pow(($req['height'] / 100), 2);
        return $this->redirect('/bmi?result=' . $bmi);
    }
}