<?php

class BookShelfController extends Controller
{
    private function dashboard(): bool
    {
        $books = new BookShelfModel();
        $books = $books->getBooks();
        $this->runThis('dashboard.php', ['books' => $books]);

        return true;
    }

    private function singleBook(): bool
    {
        $books = new BookShelfModel();
        $books = $books->getsingleBook($_GET['book_id']);
        $this->runThis('single-book.php', ['book' => $books]);

        return true;
    }
}