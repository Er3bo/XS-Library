<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 04-May-23
 * Time: 11:53 PM
 */

?>

<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/customCss.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body style="background-color: #eee;">
<?php include_once 'header.php'; ?>

<section >
    <div class="text-center container py-5">
        <h4 class="mt-1 mb-5"><strong>XS Library</strong></h4>
        <div class="row">
            <?php foreach ($books as $row): ?>
            <div class="col-lg-4 col-md-12 mb-4 same-size">
                <div class="card">
                    <a href="?book_id=<?= $row['id'] ?>">
                    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                         data-mdb-ripple-color="light">
                        <img src="images/<?= empty($row['image']) ? 'no-image.jpg' : $row['image'] ?>" class="mt-2 resize-img" />
                    </div>
                    </a>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <a href="?book_id=<?= $row['id'] ?>" class="text-reset ">
                            <h5 class="card-title mb-3"><?= $row['name'] ?></h5>
                        </a>
                    </div>
                    <div class="card-footer">
                        <?php if ($_SESSION['user_role'] == 'admin') { ?>
                            <div class="d-flex justify-content-center align-items-center">
                                <form method="post" action="">
                                    <input type="hidden" name="book_edit" value="<?= $row['id']; ?>">
                                    <button class="btn btn-primary mx-2" type="submit">Edit</button>
                                </form>
                                <form method="post" action="">
                                    <input type="hidden" name="book_delete" value="<?= $row['id']; ?>">
                                    <button class="btn btn-danger" type="submit">Delete book</button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <a href="?book_id=<?= $row['id'] ?>" class="btn btn-primary">
                                See more
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</body>
</html>

