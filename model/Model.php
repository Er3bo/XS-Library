<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 8:14 PM
 */

class Model{
    public static $connection = false;

    private function  __construct($config){
        try{
            if(!self::$connection){
                $con = new PDO("mysql:host={$config['server']};dbname={$config['dbname']}",
                    $config['dbuser'],$config['dbpass']);
                $con->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$connection = $con;

                return self::$connection;
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();

            exit;
        }
    }
}
?>