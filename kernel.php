<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 10:39 PM
 */


session_start();
include_once('config.php');
include_once('Connection.php');
spl_autoload_register(function ($class){
    if (file_exists('controller/'.$class.'.php')){
        require 'controller/'.$class.'.php';
    }
    if (file_exists('model/'.$class.'.php')){
        require 'model/'.$class.'.php';
    }
});
$db = Connection::connect($config);
$loadNew = new SiteController();
$model = new SiteModel();
$loadNew->model=$model;
$model->db = $db;

$index = $loadNew->actionIndex();
?>