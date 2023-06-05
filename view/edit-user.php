<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 09-May-23
 * Time: 3:09 PM
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
<body style="background-color: #eee;">
<?php include_once 'header.php'; ?>

<section class="mt-4 mb-4">
    <div class="container">
        <div class="row justify-content-center">
            <h4 class="mt-1 mb-5 text-center text-uppercase"><strong>Edit user data</strong></h4>

            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="title" name="first_name" maxlength="120" value="<?= isset($user['first_name'])? $user['first_name'] : '' ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">Last Name</label>
                            <input type="text" class="form-control"  maxlength="120" value="<?= isset($user['last_name'])? $user['last_name'] : '' ?>" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">Email</label>
                            <input type="email" class="form-control"  maxlength="120" value="<?= isset($user['email'])? $user['email'] : '' ?>" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">Password</label>
                            <input type="password" class="form-control"  value="" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">Password Confirm</label>
                            <input type="password" class="form-control" value="" name="password_confirm" required>
                        </div>
                        <button type="submit" name="editUser" class="btn btn-primary mb-4">Submit</button>
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
