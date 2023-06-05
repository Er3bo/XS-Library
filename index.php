<?php
session_start();
require('config.php');

require('model/Model.php');

require('controller/Controller.php');

$bootstrap = new RouterManager($_GET); // Get all url parameters
$controller = $bootstrap->createController();

if($controller){
    $controller->executeAction();
}

?>