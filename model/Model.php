<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 8:14 PM
 */

class Model{
    protected $db = false;

    protected function  __construct($config){
        try{
            if(!$this->db){
                $con = new PDO("mysql:host={$config['server']};dbname={$config['dbname']}",
                    $config['dbuser'],$config['dbpass']);
                $con->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->db = $con;
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();

            exit;
        }
    }
}
?>