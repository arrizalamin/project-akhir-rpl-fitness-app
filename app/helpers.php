<?php

function getToken() : array
{
    $token = explode(':', base64_decode($_COOKIE['token']));
    return [
        'username' => $token[0],
        'password' => $token[1],
    ];
}