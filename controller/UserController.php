<?php

class UserController extends Controller
{
    protected function Index()
    {
        $this->runThis('registration.php');
    }

    protected function ForgotPass()
    {
        $this->runThis('forgot.php');
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
        } else if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            $this->runThis('login.php', ['message'=>$message]);
        }
    }

    protected function Register()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);

        $reg = new UserModel();
        $userReg = $reg->UserRegister($email, password_hash($password, PASSWORD_DEFAULT), $firstName, $lastName);

        if ($userReg) {
            $checkLogin = $reg->CheckUserLogin($email, $password);
            if ($checkLogin) {
                $_SESSION['userLogInStatus'] = 1;
            } else {
                $message = 'Your account is successfully created. <br> Now it has to be approved by Admin.';
                $this->runThis('login.php', ['message'=>$message]);
            }
        } else {
            $message = 'Your Email is already registered.';
            $this->runThis('registration.php', ['message'=>$message]);

        }

    }

    protected function ForgotPassSubmit()
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordConfirm = trim($_POST['passwordConfirm']);

        $forget = new UserModel();
        $saveNewPass = $forget->ForgottenPass($email, $password, $passwordConfirm);
        if ($saveNewPass) {
            $message = 'Password has been changed successfully.';
            $this->runThis('login.php', ['message' => $message]);
        } else {
            $message = 'Incorrect Email or Passwords doesnt match!';
            $this->runThis('forgot.php', ['message' => $message]);
        }
    }


}