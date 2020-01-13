<?php

session_start();

include 'View/View.php';
include 'Controller/Controller.php';
include 'Model/Model.php';
include 'Controller/CategoryController.php';
include 'Controller/NewController.php';
include 'Controller/UserController.php';
include 'Controller/LoginController.php';


if(isset ($_GET['controller'])) {
    $controllerStart = ucfirst($_GET['controller'] ."Controller");
} else {
    $controllerStart = 'NewController';
} 
/*
if (!isset($_SESSION['user']) && ($controllerStart != 'NewController' || $controllerStart != 'LoginController')) {
    $controllerStart ='LoginController';
    $_GET['action'] = "formLog";
} 
*/
$controller = new $controllerStart();

if(isset ($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'start';
} 

$controller->$action();

//var_dump($_SESSION);