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
        $this->runThis($viewmodel->Index(), true);
    }

    protected function Login()
    {
        if (isset($_POST['LoginSubmit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $checkLogin = new IndexModel();
            $checkLogin = $checkLogin->CheckUserLogin($email, $password);

            if ($checkLogin) {
                $_SESSION['userLogInStatus'] = 1;
            } else if (!isset($_SESSION['message'])) {
                $_SESSION['message'] = 'Incorrect Email or password!';
            }
        }
    }
}