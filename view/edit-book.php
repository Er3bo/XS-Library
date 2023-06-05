<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 08-May-23
 * Time: 12:35 AM
 */
?>

<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 10:53 PM
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<?php include_once 'header.php'; ?>

<section class="mt-4 mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" maxlength="120" value="<?= isset($book['name'])? $book['name'] : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn" value="<?= isset($book['isbn'])? $book['isbn'] : '' ?>" name="isbn" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" maxlength="1000" rows="3"><?= isset($book['description']) ? $book['description'] : '' ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label row">Book Image</label>
                            <input type="file" name="image" id="fileToUpload" value="<?= isset($book['image'])? $book['image'] : '' ?>">
                        </div>
                        <input type="hidden" name="book_create" value="<?= isset($book['id'])? $book['id'] : '' ?>">
                        <button type="submit" name="editBook" class="btn btn-primary mb-4">Submit</button>
                        <div class="form-group justify-content-center d-md-flex">
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?= $message; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>


