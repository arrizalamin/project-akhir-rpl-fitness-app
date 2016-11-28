<?php

namespace App\Controllers;

use App\Models\Activity;
use App\Models\Barang;
use App\MVC;

class FitnessController extends BaseController
{
    private $model;

    public function __construct(MVC $app)
    {
        parent::__construct($app);
        $this->model = new Activity();
    }

    public function halamanTracking()
    {
        return $this->app->render('index');
    }

    public function storeResult($req)
    {
        if (! $this->validate($req, ['type', 'time'])) return $this->redirectBack();
        if (! $this->model->create($req)) return $this->redirectBack();

        return $this->redirect('/statistics');
    }

    public function halamanStatistikAktifitas()
    {
        return $this->app->render('statistics');
    }
}
