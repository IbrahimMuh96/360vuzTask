<?php

include_once 'helpers/helperFunctions.php';
include_once 'helpers/validators.php';
include_once 'helpers/sendEmail.php';

if ( isset($_POST['sbt']) ) {

        $errorsForm= array();

        $required_fields = array('new_password','confirm_password');
        $errorsForm = array_merge( $errorsForm, check_empty_fields($required_fields) );
        $fields_to_check_length = array('new_password'=>6, 'confirm_password'=>6);
        $errorsForm = array_merge( $errorsForm,check_min_length($fields_to_check_length) );

        if ( empty($errorsForm) ) {
            $email = $_POST['user_id'];
            $new_password =  $_POST['new_password'];
            $confirm_password =  $_POST['confirm_password'];
            try{
                $sqlQuery = "SELECT * FROM 360vuz.users WHERE email=:email";
                $statement = $db->prepare($sqlQuery);
                $statement->execute( array(':email'=> $email) );



                if($row = $statement->fetch() ) {

                    $id = $row['id'];
                    $hashed_password = $row['password'];
                    $username = $row['username'];

                    if ( $new_password == $confirm_password ) {
                        $hashed_password = md5($new_password);

                        try{
                            $sqlQuery = "UPDATE 360vuz.users 
										SET password = (:password)
										WHERE id = :id ";
                            $statement = $db->prepare($sqlQuery);
                            $statement->execute( array(':password'=>$hashed_password, ':id'=>$id ) );

                            $result = popupMessage("Updated!",'password reset successfully!','success','login.php');	;

                        }catch(PDOException $ex){
                            $result = flashMessage("something went wrong! --> while inserting the new_password {$ex->getMessage()}"); # not specified the color !
                        }

                    }else{
                        $result = flashMessage("Passwords does not match! Please re-enter the password !");
                    }
                }else{
                    $result = flashMessage("No user with email { {$email} } exist");# not specified the color !
                }
            }catch(PDOException $ex){
                $result = flashMessage("Something went wrong when searching for the user into database ! {$ex->getMessage()}");
            }

        }else{
        }

}elseif( isset($_GET['id']) ){
    $encoded_id = $_GET['id'];
    $decoded_id = base64_decode($encoded_id);

    if ( strpos($decoded_id, '-') != false) {
        $decodedArray= explode('-', $decoded_id );
        $id = $decodedArray['1'];
    }

}else{}

?>