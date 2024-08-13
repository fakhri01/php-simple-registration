<?php

session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
    header("Location: index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once './partials/head.php' ?>

<body>
    <div class="container">
        <h1>Welcome!</h1>
        <p>Your Name: <?= $_SESSION['name']; ?></p>
        <p>Your Email: <?= $_SESSION['email']; ?></p>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>