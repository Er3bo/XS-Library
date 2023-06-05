<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 10:49 PM
 */

class SiteController extends Controller
{
    public $model;

    public function routeManager()
    {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }

        if (isset($_SESSION['userLogInStatus'])) {
            if (isset($_GET['users'])) {
                $data = $this->model->notActiveUsers();
                return require_once('view/users.php');
            }
            if (isset($_GET['edit-profile']) || isset($_POST['editUser']))
            {
                $user = $this->model->takeUserData($_SESSION['user_id']);
                return require_once('view/edit-user.php');
            }

            if (isset($_GET['book_id'])  || isset($_POST['add-favorite'])){
                if (isset($_GET['book_id']))
                    $book_id = $_GET['book_id'];
                else
                    $book_id = $_POST['add-favorite'];

                $book = $this->model->getSingleBook($book_id);
                return require_once('view/single-book.php');
            }
            if (isset($_POST['book_create'])){
                if (isset($_POST['editBook']) && empty($message)) {
                    $books = $this->model->getBooks();
                    return require_once('view/dashboard.php');
                }
                $book = $this->model->getSingleBook($_POST['book_create']);
                return require_once('view/edit-book.php');
            }

            if (isset($_GET['book_create'])){
                return require_once('view/edit-book.php');
            }

            if (isset($_GET['favorite'])){
                $favoriteBooks = $this->model->favoriteBooks();
                return require_once('view/favorite.php');
            }

            $books = $this->model->getBooks();
            return require_once('view/dashboard.php');
        }

        if (isset($_GET['forgot'])) {
            return require_once('view/forgot.php');
        }

        if (isset($_GET['register'])) {
            return require_once('view/registration.php');
        }

        if (isset($_GET['login']) || isset($_GET['logOut'])) {
            return require_once('view/login.php');
        }

        return require_once('view/login.php');
    }

    public function actionIndex()
    {
        if (isset($_GET['logOut'])) {
            unset($_SESSION['userLogInStatus']);
        }

        if (isset($_POST['LoginSubmit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $checkLogin = $this->model->CheckUserLogin($email, $password);
            if ($checkLogin) {

                $_SESSION['userLogInStatus'] = 1;
            }
            else if (!isset($_SESSION['message']))
                $_SESSION['message'] = 'Incorrect Email or password!';
        }

        if (isset($_POST['ForgotSubmit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $passwordConfirm = trim($_POST['passwordConfirm']);

            $saveNewPass = $this->model->ForgottenPass($email, $password, $passwordConfirm);
            if ($saveNewPass) {
                $_SESSION['message'] = 'Password has been changed successfully.';
                if (isset($_GET['forgot'])) {
                    unset($_GET['forgot']);
                    $_GET['login'] = '';
                }
            } else
                $_SESSION['message'] = 'Incorrect Email or Passwords doesnt match!';
        }
        if (isset($_POST['editUser'])) {
            $firstName = trim($_POST['first_name']);
            $lastName = trim($_POST['last_name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $passwordConfirm = trim($_POST['password_confirm']);

            $saveNewData = $this->model->updateUserData($firstName,$lastName,$email, $password, $passwordConfirm);
            if (!$saveNewData)
                $_SESSION['message'] = 'Passwords doesn\'t match';
        }

        if (isset($_POST['RegisterSubmit'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);

            $userReg = $this->model->UserRegister($email, password_hash($password, PASSWORD_DEFAULT), $firstName, $lastName);
            if ($userReg) {
                $checkLogin = $this->model->CheckUserLogin($email, $password);
                if ($checkLogin)
                    $_SESSION['userLogInStatus'] = 1;
                else {
                    $_SESSION['message'] = 'Your account is successfully created. <br> Now it has to be approved by Admin.';
                }
            } else
                $_SESSION['message'] = 'Your Email is already registered.';
        }

        if (isset($_POST['user_id']))
        {
            $user_id = $_POST['user_id'];

            $update= $this->model->updateUserStatus($user_id);

            if ($update) {
                header('Location: http://localhost/XSSoft/?users');
                exit;
            }
            else
                $_SESSION['message'] = 'Couldn\'t update status';
        }
        if (isset($_POST['remove_favorite']))
        {
            $book_remove = $_POST['remove_favorite'];

            $update= $this->model->removeFavorite($book_remove);

            if ($update) {
                header('Location: http://localhost/XSSoft/?favorite');
                exit;
            }
            else
                $_SESSION['message'] = 'Couldn\'t update list';
        }

        if (isset($_POST['editBook']))
        {
            $id = $_POST['book_create'];
            $title = trim($_POST['title']);
            $isbn = trim($_POST['isbn']);
            $description = trim($_POST['description']);
            $image = trim($_FILES['image']['name']);
            $validIsbn = $this->model->validateISBN($isbn);
            if ($validIsbn) {
                $target_dir = "images/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                if(isset($_POST["editBook"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check !== false)
                        $uploadOk = 1;
                        else
                        $uploadOk = 0;
                    if ($uploadOk)
                    {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }

                }
                $update = $this->model->updateBook($id, $title, $isbn, $description,$image);
            }
            else
                $_SESSION['message'] = 'Please enter a valid ISBN for the book.';

        }
        if (isset($_POST['add-favorite']))
        {
            $book = $_POST['add-favorite'];
            $checkForFavorite = $this->model->isItInFavorite($book);
            if (!$checkForFavorite)
            $favoriteAdd = $this->model->addToFavorite($book);
            else
                $_SESSION['message'] = 'Book is already in your favorite list!';
        }
        if (isset($_POST['book_delete']))
        {
            $book = $_POST['book_delete'];
            $delete = $this->model->deleteBook($book);
            if ($delete) {
                header('Location: http://localhost/XSSoft/?dashboard');
                exit;
            }
        }

        $this->routeManager();
    }

}
?>