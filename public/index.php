<?php



include '../Core/Routeur.php';

include '../Controllers/Controller.php';
include '../Controllers/HomeController.php';
include '../Controllers/ProjetController.php';
include '../Controllers/UserController.php';
include '../Controllers/TacheController.php';

session_start();


$route = new Routeur();

$route->routes();
