<?php
class FavoriteBookController extends Controller
{
    private function favoriteList()
    {
        $modelBooks = new FavoriteBooksModel();
        $favBooks = $modelBooks->favoriteBooks();
        $this->runThis('favorite.php', ['favoriteBooks' => $favBooks]);
    }
    private function RemoveFavorite()
    {
        $modelBooks = new FavoriteBooksModel();
        $favBooks = $modelBooks->removeFavorite($_POST['remove_favorite']);

        if ($favBooks) {
            header('Location: ?favorite');
            exit;
        } else {
            $message = 'Couldn\'t update list';
            $this->runThis('favorite.php', ['message' => $message]);
        }
    }

    private function AddToFavorite()
    {
        $book = $_GET['add-favorite'];
        $model = new FavoriteBooksModel();
        $checkForFavorite = $model->isItInFavorite($book);
        if (!$checkForFavorite) {
            $favoriteAdd = $model->addToFavorite($book);
            header('Location: ?favorite');
            exit;
        } else {
            $message = 'Book is already in your favorite list!';
            $this->runThis('favorite.php', ['message' => $message]);
        }
    }
}