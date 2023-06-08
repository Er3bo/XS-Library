<?php

class BookShelfController extends Controller
{
    private function dashboard()
    {
        $books = new BookShelfModel();
        $books = $books->getBooks();
        $this->runThis('dashboard.php', ['books' => $books]);
    }

    private function singleBook()
    {
        $books = new BookShelfModel();
        $books = $books->getsingleBook($_GET['book_id']);
        $this->runThis('single-book.php', ['book' => $books]);
    }
}