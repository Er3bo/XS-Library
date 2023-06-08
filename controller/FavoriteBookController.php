<?php
class FavoriteBookController extends Controller
{
    /**
     * List of all books in user favorite list
     *
     * @return bool
     */
    private function favoriteList(): bool
    {
        $modelBooks = new FavoriteBooksModel();
        $favBooks = $modelBooks->favoriteBooks();
        $this->runThis('favorite.php', ['favoriteBooks' => $favBooks]);

        return true;
    }

    /**
     * Remove a book from user favorite list
     *
     * @return bool
     */
    private function RemoveFavorite(): bool
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

        return true;
    }

    /**
     * Add book to favorite book
     *
     * @return bool
     */
    private function AddToFavorite(): bool
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

        return true;
    }
}