<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 07-May-23
 * Time: 2:23 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Name</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php include_once 'header.php'; ?>

<div class="container my-5">
    <h1 class="text-center mb-5"><?= $book['name'] ?></h1>
    <div class="form-group justify-content-center d-md-flex">
        <?php if (!empty($message)): ?>
            <div class="alert alert-danger mt-3 " role="alert">
                <?= $message; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row my-4">
        <div class="col-md-4">
            <img src="images/<?= $book['image'] ?>" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-end">
            <form method="post" action="" class="mx-3">
                <input type="hidden" name="add-favorite" value="<?php echo $book['id']; ?>">
                <button class="btn btn-info" type="submit">Add to Favorite</button>
            </form>
            <a class="btn btn-primary mx-3" href="?dashboard">Back to Library</a>
            </div>
            <ul>
            <h4 class="">Product Description</h4>
            <li class="ms-5 mb-3"><?= $book['description'] ?></li>
            <h4>Product Details</h4>
                <li class="ms-5"><strong>ISBN:</strong> <?= $book['isbn'] ?></li>
            </ul>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-gxD9Gd1Cja8sRR2NfzFgs2QdYwFKg8qGqgHAYZAK1tXpI9vcnAlmBLYEMtRkvg5d"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>
</html>
