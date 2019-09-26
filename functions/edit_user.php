<?php
include_once 'helpers/database.php';


if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $id = $_GET['id'];

    try{
        $sqlQuery = "UPDATE 360vuz.users 
					SET name = :name, username = :username, email = :email
					WHERE id = :id ";
        $statement = $db->prepare($sqlQuery);
        $statement->execute( array(':name' => $name,':id'=>$id, ':username' => $username, ':email'=>$email ) );

        $msg = 'User '. $name . ' Updated Successfully';

    }catch(PDOException $ex){
        $result = flashMessage("something went wrong! --> while inserting the new_password {$ex->getMessage()}"); # not specified the color !
    }
}
$query = "SELECT * FROM 360vuz.users WHERE id = :id";
$statement = $db->prepare($query);
$statement->execute(array(':id' => $_GET['id']));
$user = $statement->fetch();