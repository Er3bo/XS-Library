<?php

class UserController extends Controller
{
    protected function Index()
    {
        $viewmodel = new UserModel();
        $this->runThis('registration.php');
    }

    protected function Login()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        $checkLogin = new UserModel();
        $checkLogin = $checkLogin->CheckUserLogin($email, $password);

        if ($checkLogin) {
            $_SESSION['userLogInStatus'] = 1;
            header("Location: ?dashboard");
        } else if (!isset($_SESSION['message'])) {
            $_SESSION['message'] = 'Incorrect Email or password!';
        }
    }

    protected function Register()
    {
        $viewmodel = new UserModel();
        $this->runThis($viewmodel->Index(), true);
    }
}