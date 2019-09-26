<?php
session_start();
include_once 'partials/header.php';
include_once 'functions/edit_user.php';
?>
<?php if (isset($msg) ) : ?>
<div class="container">
    <div class="sa-success">
        <section>
            <div class="alert alert-success" role="alert">
                <?php echo $msg;?>
            </div>
        </section>
    </div>
</div>
<?php endif; ?>

<h2>Edit User Form</h2>
<div class="container" style="height: 70%">
    <form action="" method="post">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $user['name'] ?>">
        <label>User Name</label>
        <input type="text" name="username" value="<?php echo $user['username'] ?>">
        <label>Email address</label>
        <input type="email" name="email" value="<?php echo $user['email'] ?>">
        <label>Date Joined</label>
        <input disabled type="text" value="<?php echo $user['join_date'] ?>">
        <label>Last Login</label>
        <input disabled type="text" value="<?php echo $user['login_date'] ?>">
        <label>Number of Logins</label>
        <input disabled type="number" value="<?php echo $user['login_times'] ?>">

        <br>
        <br>
        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
    </form>
</div>
