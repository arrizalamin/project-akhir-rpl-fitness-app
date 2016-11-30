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
        try {
            $me = (new static)->findBy('username', $request['username']);
            if (password_verify($request['password'], $me->password)) {
                return true;
            }
        } catch (\InvalidArgumentException $e) {
            return false;
        }
        return false;
    }

    public function activities() : array
    {
        return $this->hasMany(Activity::class, 'member_username', 'username');
    }

    public function goals() : array
    {
        return $this->hasMany(Goal::class, 'member_username', 'username');
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

    public function update(array $data, string $primary = 'id') : bool
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return parent::update($data, 'username');
    }
}