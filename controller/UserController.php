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

    protected function UserEdit()
    {
        $message = '';
        $userModel = new UserModel();
        $user = $userModel->takeUserData($_SESSION['user_id']);
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        $this->runThis('edit-user.php', ['user' => $user, 'message' => $message]);
    }

    protected function UserEditSubmit()
    {
        $userModel = new UserModel();

        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordConfirm = trim($_POST['password_confirm']);

        $saveNewData = $userModel->updateUserData($firstName,$lastName,$email, $password, $passwordConfirm);
        var_dump($saveNewData);
        if (!$saveNewData) {
            $_SESSION['message'] = 'Passwords doesn\'t match';
            var_dump($_SESSION['message']);
            header("Location: ?edit-profile");
            exit;
        } else {
            header("Location: ?edit-profile");
            exit;
        }

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
            exit;
        } else if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
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