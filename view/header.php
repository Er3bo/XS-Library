<?php
/**
 * Created by PhpStorm.
 * User: Er3b
 * Date: 07-May-23
 * Time: 12:32 AM
 */
?>
<title>XSSoft Library</title>

<nav class="nav border-bottom nav-stacked" style="background-color: white;">
    <a class="nav-link active" href="?dashboard">Library</a>
    <a class="nav-link active" href="?edit-profile">Edit my profile</a>
    <?php if ($_SESSION['user_role'] == 'admin'): ?>
    <a class="nav-link " href="?users">User Approval</a>
    <?php endif; ?>
    <a class="nav-link " href="?logOut">LogOut</a>
    <?php if ($_SESSION['user_role'] == 'admin'): ?>
        <a class="nav-link ms-auto" href="?book_create">Create Book</a>
    <?php endif; ?>
        <a class="nav-link <?= $_SESSION['user_role'] == 'user'? 'ms-auto' : '' ?>" href="?favorite"><i class="bi bi-heart"> </i>Favorite items</a>
</nav>