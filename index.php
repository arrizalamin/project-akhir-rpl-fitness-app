<?php

use App\Database;
use App\MVC;

require_once 'autoloader.php';
require_once 'app/helpers.php';

$connection = new mysqli('localhost', 'root', 'root', 'rpl');
Database::setConnection($connection);

$app = new MVC();
$app->setControllerNamespace('App\\Controllers\\');
$app->setViewDirectory(__DIR__ . '/app/Views/');

$app->get('/login', 'AuthenticationController:halamanLogin');
$app->post('/login', 'AuthenticationController:login');
$app->get('/register', 'AuthenticationController:halamanRegister');
$app->post('/register', 'AuthenticationController:register');

$app->middleware('AuthenticationController:isAuthenticated');

$app->get('/logout', 'AuthenticationController:logout');

$app->get('/', 'FitnessController:halamanTracking');
$app->post('/store', 'FitnessController:storeResult');

$app->get('/profile', 'ProfileController:halamanProfil');
$app->get('/profile/edit', 'ProfileController:halamanEditProfil');
$app->post('/profile/edit', 'ProfileController:simpanProfil');

$app->get('/statistics', 'FitnessController:halamanStatistikAktifitas');
$app->get('/statistics/calories', 'FitnessController:halamanStatistikKalori');

$app->get('/bmi', 'BmiController:halamanBmi');

$app->run();
