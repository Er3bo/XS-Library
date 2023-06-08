<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 05-Jun-23
 * Time: 10:22 PM
 */
class IndexController extends Controller
{
    /**
     * Login page
     *
     * @return bool
     */
    private function index(): bool
    {
        $this->runThis('login.php');

        return true;
    }

    /**
     * Logout user and return to login page
     *
     * @return bool
     */
    private function logOut(): bool
    {
        unset($_SESSION['userLogInStatus']);
        $this->runThis('login.php');

        return true;
    }
}