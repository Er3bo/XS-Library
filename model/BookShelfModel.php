<?php
class BookShelfModel extends Model {
    public function getBooks()
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
}