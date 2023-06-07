<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 05-Jun-23
 * Time: 10:22 PM
 */
class IndexController extends Controller
{
    private function Index()
    {
        $this->runThis('login.php');
    }

    private function LogOut()
    {
        unset($_SESSION['userLogInStatus']);
        $this->runThis('login.php');
    }
}