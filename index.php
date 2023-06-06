<?php
session_start();
require('config.php');
require ('RouterManager.php');

require('model/Model.php');
require('model/BookShelfModel.php');
require('model/FavoriteBooksModel.php');
require('model/UserModel.php');
require('model/SiteModelSOURCE.php');

require('controller/Controller.php');
require('controller/BookShelfController.php');
require('controller/FavoriteBookController.php');
require('controller/UserController.php');
require('controller/SiteControllerSOURCE.php');

$route = new RouterManager($_GET); // Get all url parameters
$controller = $route->createController();

if ($controller) {
    $controller->executeAction();
}

?>