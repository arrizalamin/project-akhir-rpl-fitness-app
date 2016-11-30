<?php

namespace App\Controllers;

use App\Lib\CalorieCalculator\Calculator;
use App\Models\Activity;
use App\Models\Barang;
use App\Models\Member;
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

        $calc = new Calculator([
            ['type' => 'Running', 'calories' => 3.7],
            ['type' => 'Cycling', 'calories' => 2.9],
            ['type' => 'Walking', 'calories' => 2.35],
        ]);
        $req['calories'] = $calc->calculate($req['type'], $req['time']);
        if (! $this->model->create($req)) return $this->redirectBack();

        return $this->redirect('/statistics');
    }

    public function halamanStatistikAktifitas()
    {
        $activities = Member::me()->activities();
        $statistics = array_reduce($activities, function ($carry, $activity) {
            if (isset($carry[$activity->date])) {
                $carry[$activity->date] = $carry[$activity->date] + $activity->calories;
                return $carry;
            }
            $carry[$activity->date] = $activity->calories;
            return $carry;
        }, []);
        return $this->app->render('statistics', compact('activities', 'statistics'));
    }

    public function halamanStatistikKalori()
    {
        $activities = Member::me()->activities();
        $statistics = array_reduce($activities, function ($carry, $activity) {
            if (isset($carry[$activity->date])) {
                $carry[$activity->date] = $carry[$activity->date] + $activity->calories;
                return $carry;
            }
            $carry[$activity->date] = $activity->calories;
            return $carry;
        }, []);
        return $this->app->render('calories', compact('statistics'));
    }
    
    public function deleteActivity($req)
    {
        if (! $this->validate($req, ['id'])) return $this->redirectBack();
        $this->model->findBy('id', $req['id'])->delete();
        return $this->redirect('/statistics');
    }
}
