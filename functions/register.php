<?php
include_once 'helpers/sendEmail.php';
if(isset($_SESSION['id'])){
    header('Location: index.php');
}
if(isset($_POST['signup'])) {
    $errorsForm = array();

    $required_fields = array('username','email','password');

    $errorsForm = array_merge($errorsForm, check_empty_fields($required_fields));
    $fields_to_check_length = array('username' => 4, 'password' => 6, 'email'=>12);

    $errorsForm = array_merge($errorsForm, check_min_length($fields_to_check_length));

    $errorsForm = array_merge($errorsForm, check_email($_POST));


    if (empty($errorsForm)) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $hashed_password = md5($_POST['password']);
        $userEmail = $_POST['email'];

        $arrayReturned = checkDuplicasy($userEmail, 'email', '360vuz', 'users', $db);
        $arrayReturned = checkDuplicasy($username, 'username', '360vuz', 'users', $db);

        if ($arrayReturned['status'] == false ) {
            try{
                $sqlInsert = "INSERT INTO 360vuz.users (name, username, password, email, join_date, login_date, active) 
                            VALUES  (:name, :username, :password, :email, now(), now(), 0 ) ";

                $statement = $db->prepare($sqlInsert);
                $statement->execute( array(':name' =>  $name,':username'=>$username,':password'=>$hashed_password,':email'=>$userEmail ) );

                if($statement->rowcount()==1){
                    $user_id = $db->lastInsertId();
                    $encode_id = base64_encode("encodeUserid-{$user_id}");

                    $mail_body = '<html>
                                <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                                line-height:1.8em;">
                                    <h2>Account Verification System </h2>
                                    <p>Dear '.$name.'<br><br>Thank you for registering, please click on the link below to
                                    confirm your email address</p>
                                    <p><a href="http://localhost/360vuz/activate.php?id='.$encode_id.'"> Confirm Email</a></p>
                                </body>
                        </html>';

                    $mail->addAddress($userEmail); #  $email is necessary BUT $username is optional..
                    $mail->Subject = "360VUZ VERIFICATION SYSTEM.";
                    $mail->Body = $mail_body;

                    if ($mail->send()) {
                        $result = popupMessage("Hey {$name}!!",'Hurray, registration successfull.<br>Please check your email for conformation link!','success','login.php');
                    }else{
                        $result = popupMessage("E-mail sending FAILED!!",$mail->ErrorInfo,'error','signup.php');
                    }

                }else{
                    $result = flashMessage("Signup unsuccessfull");
                }

            }catch(PDOException $ex){
                $result = flashMessage("An error occured".$ex->getMessage());
            }
        } else {
            $result =  flashMessage($arrayReturned['message']);
        }

    }

} else {
    if(isset($_GET['id'])) {
        $encoded_id = $_GET['id'];
        $decode_id = base64_decode($encoded_id);
        $user_id_array = explode("-", $decode_id);
        $id = $user_id_array[1];

        $sql = "UPDATE 360vuz.users SET active =:active WHERE id=:id AND active='0'";

        $statement = $db->prepare($sql);
        $statement->execute(array(':active' => "1", ':id' => $id));


        $sql2 = "SELECT * FROM 360vuz.users WHERE id=:id";

        $data = $db->prepare($sql2);
        $data->execute(array(':id' => $id));
        $sqlInsert = "INSERT INTO 360vuz.login_history (user_id, login_date) 
                            VALUES  (:user_id, now()) ";

        $statement = $db->prepare($sqlInsert);
        $statement->execute( array(':user_id' =>  $id) );


        $_SESSION['id'] = $data->fetch()['id'];
        $_SESSION['username'] = $data->fetch()['username'];

        if ($statement->rowCount() == 1) {
            // TODO fix it
            $result = "<div class=\"container\"  style=\"padding-top:25%\"><h2>Email Confirmed </h2>
			<p class='lead' style=\"padding-top:6px\">Your email address has been verified, you can now <a href=\"login.php\">login</a> with your email and password.</p></div>";
        } else {
            $result = "<div class=\"container\" style=\"padding-top:30%\"><p class='lead'>No changes made please contact site admin,
		    if you have not confirmed your email before</p></div>";
        }
    }
}

?>