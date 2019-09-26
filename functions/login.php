<?php
    if(isset($_SESSION['id'])){
        header('Location: index.php');
    }

    if ( isset($_POST['login']) ) {
        $errorsForm= array();

        $required_fields = array('username', 'password');

        $errorsForm = array_merge( $errorsForm, check_empty_fields($required_fields) );

        $fields_to_check_length = array('username'=>4, 'password'=>6);
        $errorsForm = array_merge( $errorsForm,check_min_length($fields_to_check_length) );


        if ( empty($errorsForm) ) {

            $user = $_POST['username'];
            $password =  $_POST['password'];
            isset( $_POST['remember'] )? $remember = 'yes' : $remember='';

            try{
                $sqlQuery = "SELECT * FROM 360vuz.users WHERE username=:username";
                $statement = $db->prepare($sqlQuery);
                $statement->execute( array(':username'=> $user ) );

                if($row = $statement->fetch() ) {

                    $id = $row['id'];
                    $hashed_password = $row['password'];
                    $name = $row['name'];
                    $username = $row['username'];
                    $login_times = $row['login_times'] + 1;


                    $activated = $row['active'];
                    if ($activated === "1") {
                        if ( md5($password) == $hashed_password ) {

                            $sql = "UPDATE 360vuz.users SET login_date = now(), login_times = :login_times WHERE id=:id ";

                            $statement = $db->prepare($sql);
                            $statement->execute(array(':id' => $id, ':login_times' => $login_times));

                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;

                            if ( $remember === "yes") {
                                rememberMe($id);
                            }
                            $sqlInsert = "INSERT INTO 360vuz.login_history (user_id, login_date) 
                            VALUES  (:user_id, now()) ";

                            $statement = $db->prepare($sqlInsert);
                            $statement->execute( array(':user_id' =>  $id) );

                            $result =  popupMessage("Welcome {$name}!",'Its good to have you here','success','index.php');

                        }else{
                            $result = flashMessage("Invalid username or password !");
                        }
                    }else{
                        $result = flashMessage("Please activate your account first !");
                    }

                }else{
                    $result = flashMessage("Invalid username or password !");
                }
            }catch(PDOException $ex){
                $result = flashMessage("Something went wrong while searching for the user in database!");
            }
        }else{

        }
    }

?>