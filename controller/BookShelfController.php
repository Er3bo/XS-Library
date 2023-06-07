<?php

class BookShelfController extends Controller
{
    private function Dashboard()
    {
        $books = new BookShelfModel();
        $books = $books->getBooks();
        $this->runThis('dashboard.php', ['books' => $books]);
    }

    private function SingleBook()
    {
        $books = new BookShelfModel();
        $books = $books->getSingleBook($_GET['book_id']);
        $this->runThis('single-book.php', ['book' => $books]);
    }
}