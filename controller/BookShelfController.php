<?php
class BookShelfController extends Controller {

    protected function Dashboard() {
        if ($_SESSION['userLogInStatus']) {
            $books = new BookShelfModel();
            $books = $books->getBooks();
            $this->runThis('dashboard.php', ['books'=>$books]);
        }
    }
}