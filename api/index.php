<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Credentials: true");

require 'vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

    $app->post('/insert/', function () {

        require_once("api/Fila.php");

        api\Fila::Insert_Sort();

            
    });

    $app->post('/caixa/', function () {

        require_once("api/Call.php");

        api\Call::Selection_Sort();

            
    });

    $app->post('/caixa_fim/', function () {

        require_once("api/Call.php");

        api\Call::Term_Code();

            
    });

    $app->get('/display/', function () {

        require_once("api/Display.php");

        api\Display::Select_Display();

            
    });


    $app->post('/login/', function () {

        require_once("api/Login.php");

        api\Login::Login();

            
    });

$app->run();



?>