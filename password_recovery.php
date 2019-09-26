<?php
session_start();
include_once 'helpers/database.php';
include_once 'helpers/helperFunctions.php';

include_once 'functions/password_recovery.php';
?>


<?php 	$page_title = 'Forgot Password';
include_once 'partials/header.php'; 	?>

<div class="errors">
    <section>
        <?php  if (isset($result) ) echo $result;      # these are for successfull AND unsuccessful  messages  ?>
        <?php if (!empty($errorsForm) )  echo show_errors($errorsForm); # these are for error messages  ?>
    </section>
</div>

<?php if(!isset($_GET['id']) ) :?>
    <?php echo Not_authorized('You are not authorized to view this page.', 'profile.php','Back'); ?>
<?php elseif( isset($_GET['user_id']) ) :?>
    <?php echo Not_authorized('Oops.. nothing to see here!', 'profile.php','Back'); ?>

<?php elseif( isset($_GET['id'])) : ?>
    <h2>Password Reset Form</h2><hr>

    <div class="container" >
        <div style="position: relative" class="form-container">
            <form style="align-items: normal" action="password_recovery.php" method="post" >
                <div class="form-group" >
                    <label for="newPasswordField4">New-Password:</label>
                    <input type="password" class="form-control" name="new_password"  id="newPasswordField4" placeholder="New Password">
                </div>
                <div class="form-group">
                    <label for="confirmPasswordField4">Confirm-Password:</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirmPasswordField4" placeholder="Confirm Password">
                </div>
                <input type="hidden" name="user_id" value="<?php if(isset($id)) echo $id ;?>" >
                <button type="submit" class="btn btn-primary pull-right" name="sbt">Reset password</button>
            </form>
        </div>
        <p><a href="login.php">Back</a></p>
    </div>
<?php else: ?>
    <p>Sorrey something went wrorng...! </p>
<?php endif ?>
<?php include_once 'partials/footer.php';
?>
