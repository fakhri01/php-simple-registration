<?php
require_once './db.php';
require_once './user.php';

$emailError = '';
$passwordError = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password']);
    if ($user->emailExists($_POST['email'])) {
        $emailError = "Email already exists in the database!";
    }else if ($_POST['password'] !== $_POST['confirm_password']) {
        $passwordError = "Passwords do not match!";
    }elseif(strlen($user->password) < 8){
        $passwordError = "Password must be at least 8 characters long";
    } else {
        $user->create();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once './partials/head.php' ?>

<body>
    <div class="container">
        <h1>Signup</h1>
        <form action="" method="post">
            <input type="text" placeholder="Name" name="name" required>
            <input type="email" placeholder="Email" name="email" required>
            <?php
            if (isset($emailError) && $emailError != null) {
                echo "<p class='error-message'>$emailError</p>";
            }
            ?>
            <input type="password" placeholder="Password" name="password" required>
            <input type="password" placeholder="Confirm Password" name="confirm_password" required>
            <?php
            if (isset($passwordError) && $passwordError != null) {
                echo "<p class='error-message'>$passwordError</p>";
            }
            ?>
            <input type="submit" value="Signup">
        </form>
        <a href="index.php">Login</a>
    </div>
</body>

</html>