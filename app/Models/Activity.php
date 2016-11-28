<?php

namespace App\Models;

use App\Database;

class Activity extends Database
{
    public $table = 'activities';

    public function member() : Member
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function create($req) : bool
    {
        return (bool) $this->insert([
            'member_username' => getToken()['username'],
            'type' => $req['type'],
            'time' => (int) $req['time'],
        ]);
    }
}