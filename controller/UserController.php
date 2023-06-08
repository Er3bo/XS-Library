<?php

class UserController extends Controller
{
    /**
     * Registration form
     *
     * @return bool
     */
    private function index(): bool
    {
        $this->runThis('registration.php');

        return true;
    }

    /**
     * Forgot password form
     *
     * @return bool
     */
    private function forgotPassword(): bool
    {
        $this->runThis('forgot.php');

        return true;
    }

    /**
     * Edit user personal info
     *
     * @return bool
     */
    private function userEdit(): bool
    {
        $userModel = new UserModel();
        $user = $userModel->takeUserData($_SESSION['user_id']);

        $message = '';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        $this->runThis('edit-user.php', ['user' => $user, 'message' => $message]);

        return true;
    }

    /**
     * Save edited changes of user personal info
     *
     * @return bool
     */
    private function userEditSubmit(): bool
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

        return true;
    }

    /**
     * Login the user into the site
     *
     * @return bool
     */
    private function login(): bool
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $checkLogin = new UserModel();
        $checkLogin = $checkLogin->checkUserLogin($email, $password);

        if ($checkLogin) {
            $_SESSION['userLogInStatus'] = 1;
            header("Location: ?dashboard");
            exit;
        } else if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            $this->runThis('login.php', ['message'=>$message]);
        }

        return true;
    }

    /**
     * Register new user form
     *
     * @return bool
     */
    private function register(): bool
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);

        $reg = new UserModel();
        $userReg = $reg->userRegister($email, password_hash($password, PASSWORD_DEFAULT), $firstName, $lastName);

        if ($userReg) {
            $checkLogin = $reg->checkUserLogin($email, $password);
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

        return true;
    }

    /**
     * Save new password for the user
     *
     * @return bool
     */
    private function forgotPassSubmit(): bool
    {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $passwordConfirm = trim($_POST['passwordConfirm']);

        $forget = new UserModel();
        $saveNewPass = $forget->forgottenPass($email, $password, $passwordConfirm);
        if ($saveNewPass) {
            $message = 'Password has been changed successfully.';
        } else {
            $message = 'Incorrect Email or Passwords doesnt match!';
        }

        $this->runThis('login.php', ['message' => $message]);

        return true;
    }


}