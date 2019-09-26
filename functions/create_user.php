<?php
include_once 'helpers/sendEmail.php';

if(isset($_POST['create'])) {
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
                            VALUES  (:name, :username, :password, :email, now(), NULL , 0 ) ";

                $statement = $db->prepare($sqlInsert);
                $statement->execute( array(':name' =>  $name,':username'=>$username,':password'=>$hashed_password,':email'=>$userEmail ) );

                if($statement->rowcount()==1){
                    $user_id = $db->lastInsertId();
                    $encode_id = base64_encode("encodeUserid-{$user_id}");

                    $mail_body = '<html>
                                <body style="background-color:#CCCCCC; color:#000; font-family: Arial, Helvetica, sans-serif;
                                                line-height:1.8em;">
                                    <h2>Account Verification System </h2>
                                    <p>Dear '.$name.'<br><br>We Have Create An Account For You, please click on the link below to
                                    confirm your email address</p>
                                    <p><a href="http://localhost/360vuz/activate.php?id='.$encode_id.'"> Confirm Email</a></p>
                                </body>
                        </html>';

                    $mail->addAddress($userEmail); #  $email is necessary BUT $username is optional..
                    $mail->Subject = "360VUZ VERIFICATION SYSTEM.";
                    $mail->Body = $mail_body;

                    if ($mail->send()) {
                        $result = popupMessage("Account Created",'Please contact the user for conformation link!','success','edit_user.php?id='.$user_id);
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

}