<?php
require 'bootstrap.php';
require_once __DIR__ . '/Jwt.php';

// token test gerador
$jwtGerador = new Jwt();

$jwtGerador->setSecret(getenv('SECRET'));
$token = $jwtGerador->setPayload([
    'user_id' => 1,
    'role' => 'admin',
    'exp' => ((new DateTime())->modify('+30 minutes')->getTimestamp()) // 1593828222
])->generateToken();

var_dump($token);

// token teste validador
$jwtValidador = new Jwt();
$jwtValidador->setSecret(getenv('SECRET'));
var_dump($jwtValidador->setToken($token)->validate() === Jwt::TOKEN_VALID);