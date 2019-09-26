<?php
include_once 'database.php';

function check_empty_fields($required_fields_array){
    $form_errors = array();

    foreach ($required_fields_array as $key ) {
        if ( !isset($_POST[$key])) {
            $form_errors[] = $key." is a required field";
        }
    }
    return $form_errors;
}

function check_min_length($fields_to_check_length){

    $form_errors = array();

    foreach ($fields_to_check_length as $name_of_the_field => $minimum_length_required	 ) {
        if (  isset($_POST[$name_of_the_field]) && $_POST[$name_of_the_field] != NULL ) {
            if ( strlen( trim( $_POST[$name_of_the_field]) ) < $minimum_length_required) {
                $form_errors[] = $name_of_the_field . " is too short, must be {$minimum_length_required} characters long";
            }
        }
    }
    return $form_errors;

}

function check_email($data){
    $form_errors = array();
    $key = 'email';
    if( array_key_exists($key, $data) ){
        if ($_POST[$key] != NULL) {
            $_POST[$key] = filter_var($_POST[$key],FILTER_SANITIZE_EMAIL);
            if ( filter_var( $_POST[$key],FILTER_VALIDATE_EMAIL ) == false ) {
                $form_errors[] = "{  {$_POST[$key]}  } is not a valid email address";
            }
        }
    }
    return $form_errors;
}

function checkDuplicasy($input, $columnName, $databaseName, $tableName, $db){
    try{
        $sqlQuery = "SELECT {$columnName}
					FROM {$databaseName}.{$tableName}
					WHERE {$columnName}=:input";

        $statement = $db->prepare($sqlQuery);

        $statement->execute( array(':input'=>$input) );
        if($statement->rowcount()==1){
            $status = true;
            $message = "Sorry this {$columnName} is already taken ";
        }else{
            $status = false;
            $message = NULL;
        }
    }catch(PDOException $ex){
        $status = 'exception';
        $message = "An error occoured : DURING THE CHECKING OF DUPLICASY OF {$columnName} IN {$databaseName}->{$tableName} ==> {$ex->getMessage()}";
    }
    $returnThis = array('status'=>$status, 'message'=>$message);
    return $returnThis;
}
