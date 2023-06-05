<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 06-May-23
 * Time: 10:45 PM
 */
?>


<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php include_once 'header.php'; ?>

<div class="container">
    <?php if (!empty($data)){ ?>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Approve</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['first_name']; ?></td>
                <td><?= $row['last_name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <form method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                    <button class="btn btn-primary" type="submit">Approve</button>
                </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php }
    else{
        ?>
        <p class="text-uppercase text-center mt-5 font-weight-bold">All users are approved</p>
        <?php
    }?>
</div>
</body>
</html>
