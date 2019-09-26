<?php
session_start();
include_once 'helpers/database.php';
include_once 'helpers/validators.php';
include_once "helpers/helperFunctions.php";
include_once 'functions/login.php';
$page_title = 'Login';
?>

<?php
include_once 'partials/header.php';
?>

<div class="errors">
    <section>
        <?php  if (isset($result) ) echo $result;      # these are for successfull AND unsuccessful  messages  ?>
        <?php if (!empty($errorsForm) )  echo show_errors($errorsForm); # these are for error messages  ?>
    </section>
</div>
<div class="container container-auth" id="container">
    <div class="form-container sign-in-container">
        <form method="POST" action="">
            <br>
            <h3>Sign in</h3>
            <br>
            <input type="text" name="username" placeholder="User Name" />
            <input type="password" name="password" placeholder="Password" />
            <input type="checkbox" name="remember"/>Remember me
            <a href="forget_password.php">Forgot your password?</a>
            <button type="submit" name="login">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <a href="register.php" class="ghost" id="signUp">Sign Up</a>
            </div>
        </div>
    </div>
</div>
<?php include_once 'partials/footer.php';
?>