<?php
session_start();
include_once 'helpers/database.php';
include_once 'helpers/validators.php';
include_once 'helpers/helperFunctions.php';
include_once 'functions/home.php';
$page_title = 'Home';
?>
<?php
include_once 'partials/header.php';
?>
<div class="container-fluid">
    <div class="card" style="">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Number Of users: &nbsp <span class="badge badge-secondary" ><?php echo $all_usera['count']?> </span></li>
            <li class="list-group-item">Number Of Dectivated users: &nbsp <span class="badge badge-secondary"><?php echo $inactive_users['count']?> </span></li>
            <li class="list-group-item">The last User Signed in at: &nbsp <span class="badge badge-secondary"><?php echo $latest_user['login_date']?> </span></li>
            <li class="list-group-item">Total Numbers f login times: &nbsp <span class="badge badge-secondary"><?php echo $total_logins['total']?> </span></li>

        </ul>
    </div>
    <br>
    <div class="row" style="text-align: center">

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"style="">
            <div class="container-auth examplebar">
                <br>
                <h4 style="align-self: center">Monthly Login Times</h4>
                <?php echo $pieChartMonth->returnFullHTML();
                ?>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="container-auth examplebar">
                <br>
                <h4>Weekly Login Times</h4>
                <?php echo $pieChartWeek->returnFullHTML();
                ?>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="container-auth examplebar">
                <br>
                <h4>Daily Login Times</h4>
                <?php echo $pieChartDay->returnFullHTML();
                ?>
            </div>
        </div>

</div>




