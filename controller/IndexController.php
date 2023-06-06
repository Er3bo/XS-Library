<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 05-Jun-23
 * Time: 10:22 PM
 */
class IndexController extends Controller
{
    protected function Index()
    {
        $viewmodel = new IndexModel();
        $this->runThis('login.php');
    }
}