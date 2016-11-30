<?php

namespace App\Models;

use App\Database;

class Member extends Database
{
    public $table = 'members';

    public static function me() : Member {
        $instance = new static();
        $token = getToken();
        if ($instance->verify($token)) {
            return $instance->findBy('username', $token['username']);
        }
        throw new \BadMethodCallException("token is not valid");
    }

    public function verify(array $request) : bool
    {
        $me = (new static)->findBy('username', $request['username']);
        if (password_verify($request['password'], $me->password)) {
            return true;
        }
        return false;
    }

    public function activities() : array
    {
        return $this->hasMany(Activity::class, 'member_username', 'username');
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