<?php
include_once 'helpers/database.php';
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}
if(isset($_GET['activate'])){
    $id = $_GET['activate'];
    try{
        $sqlQuery = "UPDATE 360vuz.users 
					SET active = 1
					WHERE id = :id ";
        $statement = $db->prepare($sqlQuery);
        $statement->execute( array(':id'=>$id ) );

        $msg = 'User Enabled Successfully';

    }catch(PDOException $ex){
        $result = flashMessage("something went wrong! --> while inserting the new_password {$ex->getMessage()}"); # not specified the color !
    }

} elseif(isset($_GET['deactivate'])) {
    $id = $_GET['deactivate'];
    try{
        $sqlQuery = "UPDATE 360vuz.users 
					SET active = 0
					WHERE id = :id ";
        $statement = $db->prepare($sqlQuery);
        $statement->execute( array(':id'=>$id ) );

        $msg = 'User Disabled Successfully';

    }catch(PDOException $ex){
        $result = flashMessage("something went wrong! --> while inserting the new_password {$ex->getMessage()}"); # not specified the color !
    }
}

$query = "SELECT * FROM 360vuz.users";
$statement = $db->prepare($query);
$statement->execute();

$users = $statement->fetchAll();
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/26/2019
 * Time: 12:54 AM
 */