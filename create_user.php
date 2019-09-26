<?php
session_start();
include_once 'helpers/database.php';
include_once 'helpers/validators.php';
include_once 'helpers/helperFunctions.php';
include_once 'partials/header.php';
include_once 'functions/create_user.php';
?>
<div class="errors">
    <section>
        <?php  if (isset($result) ) echo $result; ?>
        <?php if (!empty($errorsForm) )  echo show_errors($errorsForm);?>
    </section>
</div>

<h2>Create User Form</h2>
<div class="container" style="height: 70%">
    <form action="" method="post">
        <input type="text" name="name" placeholder="Name" value="">
        <input type="text" name="username" placeholder="UserName" value="">
        <input type="email" name="email" placeholder="Email" value="">
        <input type="password" name="password" placeholder="Password" value="">
        <br>
        <button type="submit" name="create" class="btn btn-primary">Create</button>
    </form>
</div>
