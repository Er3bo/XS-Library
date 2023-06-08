<?php
class AdminController extends Controller
{
    private function userList(): bool
    {
        $nonActiveUsers = new AdminModel;
        $data = $nonActiveUsers->notActiveUsers();
        $this->runThis('users.php', ['data'=>$data]);

        return true;
    }

    private function userApprove(): bool
    {
        $user_id = $_POST['user_id'];

        $nonActiveUsers = new AdminModel;
        $update= $nonActiveUsers->updateUserStatus($user_id);

        if ($update) {
            header('Location: ?users');
            exit;
        }

        return true;
    }

    private function createBookForm(): bool
    {
        $message = '';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        $this->runThis('edit-book.php', ['message' => $message]);

        return true;
    }

    private function createBookFormSubmit(): bool
    {
        $id = $_POST['book_create'];
        $title = trim($_POST['title']);
        $isbn = trim($_POST['isbn']);
        $description = trim($_POST['description']);
        $image = trim($_FILES['image']['name']);

        $model = new AdminModel();
        $validIsbn = $model->validateISBN($isbn);

        $validIsbn = true;
        if ($validIsbn) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            if (isset($_POST["editBook"]) && $_FILES["image"]["name"] != '') {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
                if ($uploadOk) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                }
            }
            $update = $model->updateBook($id, $title, $isbn, $description,$image);
            if ($update) {
                header('Location: ?dashboard');
                exit;
            }
        } else {
            $_SESSION['message'] = 'Please enter a valid ISBN for the book.';
            header('Location: ?book_create');
            exit;
        }

        return true;
    }

    private function editBookForm(): bool
    {
        $message = '';
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        $singleBookData = new BookShelfModel();
        $book = $singleBookData->getSingleBook($_POST['book_edit']);
        $this->runThis('edit-book.php', ['book' => $book, 'message' => $message]);

        return true;
    }

    private function deleteBook(): bool
    {
        $book = $_POST['book_delete'];
        $model = new AdminModel();
        $delete = $model->deleteBook($book);
        if ($delete) {
            header('Location: ?dashboard');
            exit;
        }

        return true;
    }
}