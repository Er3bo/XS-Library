<?php
session_start();
require('config.php');
require ('RouterManager.php');
require ('routes.php');

require('model/Model.php');
require('model/BookShelfModel.php');
require('model/FavoriteBooksModel.php');
require('model/UserModel.php');

require('controller/Controller.php');
require('controller/BookShelfController.php');
require('controller/FavoriteBookController.php');
require('controller/UserController.php');
require('controller/IndexController.php');

end($_REQUEST);
$reqUrl = key($_REQUEST);
if (!$reqUrl) {
    $reqUrl = explode('XSSoft/',$_SERVER['REQUEST_URI']);
    $reqUrl = end($reqUrl);
}
//var_dump($reqUrl);

$route = new RouterManager($reqUrl);
$controller = $route->createController();

if ($controller) {
    $controller->executeAction();
}

?>