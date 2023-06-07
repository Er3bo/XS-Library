<?php
class AdminModel extends Model
{
    public function notActiveUsers()
    {
        $query = "SELECT * FROM user WHERE active=0";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userData;
    }

    public function updateUserStatus($user_id)
    {
        $query = "UPDATE user SET active = '1' WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['id' => $user_id]);
        return true;
    }

    public function updateBook($id, $name, $isbn, $description,$image)
    {
        if ($id) {
            $query = "UPDATE books SET name = :name, ISBN = :isbn, description = :descr, image = :image WHERE id = :id;";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':descr', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            return true;
        } else {
            $query = "INSERT INTO books (name, isbn, description,image) VALUES (:name, :isbn, :description,:image)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':isbn', $isbn);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);

            $stmt->execute();
            return true;
        }
        return false;
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
}