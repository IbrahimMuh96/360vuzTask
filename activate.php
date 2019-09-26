<?php
session_start();
$page_title = "Account activation";
include_once 'helpers/database.php';
include_once  "partials/header.php";
include_once "functions/register.php";
?>
<div class="container">
    <div class="flag">
        <h3 style="text-align: center">User Authentication System</h3>
        <?php if(isset($result)) echo $result; ?>
    </div>
</div>
<?php include_once 'partials/footer.php';
?>