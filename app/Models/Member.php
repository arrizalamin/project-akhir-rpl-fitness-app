<?php

namespace App\Models;

use App\Database;

class Member extends Database
{
    public $table = 'members';

    public static function me($username, $password) : Member {
        $me = (new static)->findBy('username', $username);
        if (password_verify($password, $me->password)) {
            return $me;
        }
        throw new \InvalidArgumentException("username and password didn't match");
    }

    public function check(array $request) : bool
    {
        try {
            $this->me($request['username'], $request['password']);
        } catch(\InvalidArgumentException $e) {
            return false;
        }
        return true;
    }

    public function barang() : array
    {
        return $this->hasMany(Barang::class, 'admin_id');
    }

    public function register(array $req) : bool
    {
        try {
            $this->findBy('username', $req['username']);
            return false;
        } catch (\InvalidArgumentException $e) {}
        $status = $this->insert([
            'username' => $req['username'],
            'password' => password_hash($req['password'], PASSWORD_BCRYPT),
        ]);
        return (bool) $status;
    }
}