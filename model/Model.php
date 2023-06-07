<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 8:14 PM
 */

abstract class Model{
    protected $db = false;

    public function  __construct()
    {
        try {
            $config = include('config.php');
            if (!$this->db) {
                $con = new PDO("mysql:host={$config['server']};dbname={$config['dbname']}",
                    $config['dbuser'],$config['dbpass']);
                $con->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->db = $con;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
?>