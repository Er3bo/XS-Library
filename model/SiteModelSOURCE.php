<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 11:48 PM
 */


class SiteModelSOURCE extends Model
{
//    public function CheckUserLogin($email, $password)
//    {
//        $query = "SELECT * FROM user WHERE email=:email";
//        $stmt = $this->db->prepare($query);
//        $stmt->execute(['email' => $email]);
//        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
//        if ($userData) {
//            if (password_verify($password, $userData['password']) && ($userData['email'] == 'admin@gmail.com' || $userData['active'] != 0)) {
//                if ($userData['email'] == 'admin@gmail.com')
//                    $_SESSION['user_role'] = 'admin';
//                else
//                    $_SESSION['user_role'] = 'user';
//
//                $_SESSION['user_id'] = $userData['id'];
//
//                return true;
//            }
//            else if($userData['active'] == 0) {
//                $_SESSION['message'] = 'Account is not approved by admin';
//                return false;
//            }
//            else
//                return false;
//        } else
//            return false;
//    }
//    public function takeUserData($id){
//        $query = "SELECT * FROM user WHERE id=:id";
//        $stmt = $this->db->prepare($query);
//        $stmt->execute(['id' => $id]);
//        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
//        return $userData;
//    }







//    public function ForgottenPass($email, $password, $passwordConfirm)
//    {
//        if ($password == $passwordConfirm) {
//            $query = "SELECT * FROM user WHERE email=:email";
//            $stmt = $this->db->prepare($query);
//            $stmt->execute(['email' => $email]);
//            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
//
//            if ($userData) {
//                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
//                $queryUpdate = "UPDATE user SET password =:password WHERE id = :id";
//                $stmt = $this->db->prepare($queryUpdate);
//                $stmt->bindParam(':password', $hashedPass);
//                $stmt->bindParam(':id', $userData['id']);
//                $stmt->execute();
//                return true;
//            } else
//                return false;
//        }
//        return false;
//    }

//    public function UserRegister($email, $password, $firstName, $lastNAme)
//    {
//        $query = "INSERT INTO user (first_name, last_name, email, password) VALUES (:firstName, :lastName, :email, :password)";
//
//        try {
//            $stmt = $this->db->prepare($query);
//            $stmt->bindParam(':firstName', $firstName);
//            $stmt->bindParam(':lastName', $lastNAme);
//            $stmt->bindParam(':email', $email);
//            $stmt->bindParam(':password', $password);
//            $stmt->execute();
//
//            return 1;
//        } catch (PDOException $e) {
//            if ($e->getCode() == '23000') {
//                "The email address $email is already in use. Please choose a different email address.";
//            } else {
//                "An error occurred: " . $e->getMessage();
//            }
//            return 0;
//        }
//    }



//    public function getSingleBook($id)
//    {
//        $query = "SELECT * FROM books WHERE id=:id";
//        $stmt = $this->db->prepare($query);
//        $stmt->execute(['id' => $id]);
//        $book = $stmt->fetch(PDO::FETCH_ASSOC);
//        return $book;
//    }

//    public function updateBook($id, $name, $isbn, $description,$image)
//    {
//        if ($id) {
//            $query = "UPDATE books SET name = :name, ISBN = :isbn, description = :descr, image = :image WHERE id = :id;";
//            $stmt = $this->db->prepare($query);
//            $stmt->bindParam(':id', $id);
//            $stmt->bindParam(':name', $name);
//            $stmt->bindParam(':isbn', $isbn);
//            $stmt->bindParam(':descr', $description);
//            $stmt->bindParam(':image', $image);
//            $stmt->execute();
//            return true;
//        } else {
//            $query = "INSERT INTO books (name, isbn, description,image) VALUES (:name, :isbn, :description,:image)";
//            $stmt = $this->db->prepare($query);
//            $stmt->bindParam(':name', $name);
//            $stmt->bindParam(':isbn', $isbn);
//            $stmt->bindParam(':description', $description);
//            $stmt->bindParam(':image', $image);
//
//            $stmt->execute();
//            return true;
//        }
//        return false;
//    }

    public function getFavoriteBooks($id)
    {
        $query = "SELECT * FROM books WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        return $book;
    }
    public function isItInFavorite($book_id)
    {
        $user = $_SESSION['user_id'];

        $query = "SELECT * FROM favorite_book WHERE user_id=:user_id AND book_id=:book_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        $book = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($book)
            return true;
        else
            return false;
    }

    public function addToFavorite($book_id)
    {
        $user = $_SESSION['user_id'];
        $query = "INSERT INTO favorite_book (user_id, book_id) VALUES (:user_id, :book_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->execute();
        return true;
    }

    public function favoriteBooks(){
        $user = $_SESSION['user_id'];
        $query = "SELECT b.id, b.name, b.isbn, b.description, b.image FROM favorite_book fb JOIN books b ON fb.book_id = b.id WHERE fb.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user);
        $stmt->execute();
        $favBooks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($favBooks)
            return $favBooks;
        else
            return false;
    }

    public function removeFavorite($id){
        $user = $_SESSION['user_id'];
        $query = "DELETE FROM favorite_book WHERE book_id = :book_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $id);
        $stmt->execute();
        return true;
    }

    public function deleteBook($id){
        $query = "SELECT * FROM books WHERE id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id'=>$id]);

        $image_path = 'images/'.$book['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        return true;
    }

    function validateISBN($isbn) {
        // Remove any hyphens or spaces from the ISBN
        $isbn = str_replace(array('-', ' '), '', $isbn);

        // ISBNs must be either 10 or 13 digits long
        if (strlen($isbn) != 10 && strlen($isbn) != 13) {
            return false;
        }

        // For 10-digit ISBNs, calculate and check the check digit
        if (strlen($isbn) == 10) {
            $sum = 0;
            for ($i = 0; $i < 9; $i++) {
                $sum += (10 - $i) * intval($isbn[$i]);
            }
            $checkDigit = (11 - ($sum % 11)) % 11;
            if ($checkDigit != intval($isbn[9])) {
                return false;
            }
        }

        // For 13-digit ISBNs, calculate and check the check digit
        if (strlen($isbn) == 13) {
            $sum = 0;
            for ($i = 0; $i < 12; $i++) {
                $sum += (($i % 2) * 2 + 1) * intval($isbn[$i]);
            }
            $checkDigit = (10 - ($sum % 10)) % 10;
            if ($checkDigit != intval($isbn[12])) {
                return false;
            }
        }

        // If we made it this far, the ISBN is valid
        return true;
    }
}

?>