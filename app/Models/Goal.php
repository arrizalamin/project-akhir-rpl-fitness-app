<?php

namespace App\Models;

use App\Database;

class Goal extends Database
{
    public $table = 'goals';

    public function member() : Member
    {
        return $this->belongsTo(Member::class, 'username', 'member_username');
    }

    public function create($req) : bool
    {
        return $this->insert([
            'member_username' => getToken()['username'],
            'type' => $req['type'],
            'total' => $req['total'],
        ]);
    }
}