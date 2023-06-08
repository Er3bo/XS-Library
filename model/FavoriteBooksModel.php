<?php
class FavoriteBooksModel extends Model {
    public function getFavoriteBooks(int $id): array
    {
        $query = "SELECT * FROM books WHERE id=:id";
        $stmt = $this->db->prepare($query);

        $stmt->execute(['id' => $id]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        return $book;
    }

    public function isItInFavorite(int $book_id): bool
    {
        $user = $_SESSION['user_id'];

        $query = "SELECT * FROM favorite_book WHERE user_id=:user_id AND book_id=:book_id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $book_id);

        $stmt->execute();

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($book) {
            return true;
        } else {
            return false;
        }
    }

    public function addToFavorite(int $book_id): bool
    {
        $user = $_SESSION['user_id'];
        $query = "INSERT INTO favorite_book (user_id, book_id) VALUES (:user_id, :book_id)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $book_id);

        $stmt->execute();

        return true;
    }

    public function favoriteBooks(): array
    {
        $user = $_SESSION['user_id'];
        $query = "SELECT b.id, b.name, b.isbn, b.description, b.image FROM favorite_book fb JOIN books b ON fb.book_id = b.id WHERE fb.user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFavorite(int $id): bool
    {
        $user = $_SESSION['user_id'];
        $query = "DELETE FROM favorite_book WHERE book_id = :book_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user);
        $stmt->bindParam(':book_id', $id);

        $stmt->execute();

        return true;
    }
}