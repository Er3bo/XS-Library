<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 09-May-23
 * Time: 1:52 PM
 */
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/customCss.css">

</head>
<body style="background-color: #eee;">
<?php include_once 'header.php'; ?>

<?php if(!empty($favoriteBooks)): ?>
<section >
    <div class="text-center container py-5">
        <h4 class="mt-1 mb-5 text-uppercase"><strong>Favorite books</strong></h4>
        <div class="row">
            <?php foreach ($favoriteBooks as $row): ?>
                <div class="col-lg-4 col-md-12 mb-4 same-size">
                    <div class="card">
                        <a href="?book_id=<?= $row['id'] ?>">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                                 data-mdb-ripple-color="light">
                                <img src="images/<?= empty($row['image'])? 'no-image.jpg' : $row['image'] ?>" class="mt-2 resize-img" />
                            </div>
                        </a>
                        <div class="card-body d-flex justify-content-center align-items-center">
                            <a href="?book_id=<?= $row['id'] ?>" class="text-reset ">
                                <h5 class="card-title mb-3"><?= $row['name'] ?></h5>
                            </a>
                        </div>
                        <div class="card-footer">
                                <div class="d-flex justify-content-center align-items-center">
                                    <form method="post" action="">
                                        <input type="hidden" name="remove_favorite" value="<?= $row['id']; ?>">
                                        <button class="btn btn-danger" type="submit">Remove from Favorite</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php else: ?>
<p class="text-uppercase text-center mt-5 font-weight-bold">Your list of Favorite books is empty.</p>
<?php endif; ?>
</body>
</html>

