<?php

require './user.php';


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User("", "", $_POST['password'], "");
    if (!$user->login($_POST['identifier'], $_POST['password'])) {
        $error = "Email/Username or password is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once './partials/head.php' ?>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="" method="post">
            <input type="text" placeholder="Email/Username" name="identifier" required>
            <input type="password" placeholder="Password" name="password" required>
            <?php echo "<p class='error-message'>$error</p>" ?>
            <input type="submit" value="Login" name="login">
        </form>
        <a href="signup.php">Sign up</a>
    </div>
</body>

</html>