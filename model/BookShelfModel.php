<?php
class BookShelfModel extends Model {
    /**
     * Get all the books to list them
     *
     * @return array
     */
    public function getBooks(): array
    {
        $query = "SELECT * FROM books ";
        $stmt = $this->db->prepare($query);

        $stmt->execute();

        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($books as $key => $checkImgs) {
            if (!file_exists('images/' . $checkImgs['image']))
                $books[$key]['image'] = null;
        }
        return $books;
    }

    /**
     * Give info for only one book
     *
     * @param int $id
     *
     * @return array
     */
    public function getSingleBook(int $id): array
    {
        $query = "SELECT * FROM books WHERE id=:id";
        $stmt = $this->db->prepare($query);

        $stmt->execute(['id' => $id]);

        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        return $book;
    }
}