<?php

use App\Database;
use App\MVC;

require_once 'autoloader.php';
require_once 'app/helpers.php';

$dbConfig = json_decode(file_get_contents('config.json'))->database;
$connection = new mysqli($dbConfig->host, $dbConfig->user, $dbConfig->password, $dbConfig->name);
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
$app->get('/profile/delete', 'ProfileController:deleteProfile');

$app->get('/color_scheme', 'GantiBackgroundController:halamanGantiBackground');
$app->post('/color_scheme', 'GantiBackgroundController:simpanWarna');

$app->get('/statistics', 'FitnessController:halamanStatistikAktifitas');
$app->get('/statistics/calories', 'FitnessController:halamanStatistikKalori');

$app->get('/activity/delete', 'FitnessController:deleteActivity');

$app->get('/bmi', 'BmiController:halamanBmi');
$app->post('/bmi', 'BmiController:calculate');

$app->get('/goals', 'GoalController:halamanGoal');
$app->post('/goals', 'GoalController:createGoal');

$app->run();
