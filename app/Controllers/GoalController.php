<?php

namespace App\Controllers;

use App\Models\Goal;
use App\Models\Member;
use App\MVC;

class GoalController extends BaseController
{
    private $model;

    public function __construct(MVC $app)
    {
        parent::__construct($app);
        $this->model = new Goal();
    }

    public function halamanGoal()
    {
        $goals = Member::me()->goals();
        $goals = array_map(function($goal) {
            switch ($goal->type) {
                case 'complete':
                    return "Complete {$goal->total} fitnesses";break;
                case 'track':
                    return "Track {$goal->total} minutes fitness";break;
                case 'burn':
                    return "Burn {$goal->total} calories fitness";break;
                default:
                    return $goal->type . " " . $goal->total;
            }
        }, $goals);
        return $this->app->render('goal', compact('goals'));
    }
    
    public function createGoal($req)
    {
        if (! $this->validate($req, ['type', 'total'])) {
            return $this->redirectBack(['error' => 'form is not valid']);
        }
        $this->model->create($req);
        return $this->redirect('/goals');
    }
}