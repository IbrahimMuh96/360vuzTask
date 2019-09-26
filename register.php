<?php
session_start();
include_once 'helpers/database.php';
include_once 'helpers/validators.php';
include_once 'helpers/helperFunctions.php';
include_once 'functions/register.php';
$page_title = 'Registration';
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

<div class="container container-auth right-panel-active" id="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="">
            <h3>Create Account</h3>
            <br>
            <br>
            <input type="text" name="name" placeholder="Name" />
            <input type="text" name="username" placeholder="Username" />
            <input type="email" name="email" placeholder="Email" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit" name="signup">Sign Up</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <a href="login.php" class="ghost" id="signIn">Sign In</a>
            </div>
        </div>
    </div>
</div>
