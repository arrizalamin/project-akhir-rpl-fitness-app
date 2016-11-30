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

    public function halamanTracking($req)
    {
        return $this->app->render('index', compact('req'));
    }

    public function storeResult($req)
    {
        if (! $this->validate($req, ['type', 'time'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }

        $calc = new Calculator([
            ['type' => 'Running', 'calories' => 0.16],
            ['type' => 'Cycling', 'calories' => 0.1],
            ['type' => 'Walking', 'calories' => 0.03],
        ]);
        $req['calories'] = $calc->calculate($req['type'], $req['time']);
        if (! $this->model->create($req)) {
            return $this->redirectBack(['error' => 'internal server error']);
        }

        return $this->redirect('/statistics');
    }

    public function halamanStatistikAktifitas()
    {
        $activities = Member::me()->activities();
        $statistics = array_reduce($activities, function ($carry, Activity $activity) {
            $activity->member();
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
        $statistics = array_reduce($activities, function ($carry, Activity $activity) {
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
        if (! $this->validate($req, ['id'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }
        $this->model->findBy('id', $req['id'])->delete();
        return $this->redirect('/statistics');
    }
}
