<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php if( isset($page_title) ) echo $page_title; else echo '360vuz'?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="assets/css/main.css" rel="stylesheet">
    <script src="assets/js/main.js"></script>
    <script src="assets/js/ChartJS.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

</head>

<body>
    <nav style="top:0;width: 100%; padding: 0 0; background-color: #ffb4b6 !important; color: black" class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php" style="margin-left: 40px;">User System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" style="padding: 0 25%;" id="navbarNav">
            <ul class="navbar-nav">
                <?php if( isset($_SESSION['username']) ) :?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/360VUZ/edit_user.php?id=<?php echo $_SESSION['id']?>"><span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/360VUZ/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/360VUZ/users.php">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/360VUZ/index.php">Home</a>
                    </li>
                <?php else: ?>

                <li class="nav-item">
                    <a class="nav-link" href="/360VUZ/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/360VUZ/register.php">Register</a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
    <br>
    <br><br>
    <br><br>
    <br>
