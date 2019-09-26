<?php $page_title = 'Forget Password';
session_start();
include_once 'partials/header.php'; ?>
<?php 	include_once 'functions/forget_password.php'; ?>
<div class="errors">
    <section>
        <?php  if (isset($result) ) echo $result;      # these are for successfull AND unsuccessful  messages  ?>
        <?php if (!empty($errorsForm) )  echo show_errors($errorsForm); # these are for error messages  ?>
    </section>
</div>
<div class="container">
    <div class="form-container">
        <br>
        <h5 style="align-self: center">To reset password reset link, please enter your email address in the form below</h5>
            <form style="height: 60%" action="" method="post">
                    <label for="emailField">Email Address</label>
                    <input type="text" class="form-control" name="email" id="emailField" placeholder="email">
                <button type="submit" name="recovery" class="btn btn-primary pull-right">Recover Password</button>
            </form>
    </div>
</div>
<?php include_once 'partials/footer.php';
?>