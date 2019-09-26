<?php
session_start();
include_once 'helpers/helperFunctions.php';

include_once 'partials/header.php';

unset($_SESSION['username']);
unset($_SESSION['id']);

session_regenerate_id(true);
session_destroy();


echo popupMessage("Logout Successfull",'Hope you enjoyed it :)','success','login.php');
include_once 'partials/footer.php';

?>

