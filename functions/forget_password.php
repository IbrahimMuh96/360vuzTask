<?php
include_once 'helpers/validators.php';
include_once 'helpers/helperFunctions.php';

include_once 'helpers/sendEmail.php';
if(isset($_SESSION['id'])){
    header('Location: index.php');
}
if (isset($_POST['recovery'])) {
        $errorsForm = array();

        $required_fields_array = array('email');
        $errorsForm = array_merge(  $errorsForm, check_empty_fields($required_fields_array)  );

        $errorsForm = array_merge(  $errorsForm, check_email($_POST)  );

        if ( empty($errorsForm) ){
            $email = $_POST['email'];
            try{
                $sqlQuery = "SELECT * FROM 360vuz.users WHERE email=:email";
                $statement = $db->prepare($sqlQuery);
                $statement->execute( array(':email'=>$email) );
                if ( $row = $statement->fetch() ) {
                    $id = $row['id'];
                    $email = $row['email'];
                    $username = $row['username'];

                    $encode_id = base64_encode("encodeuserid-{$email}");


                    $mail_body = '<html>
									<body style="font-family: Arial, Helvetica, sans-serif; line-height:1.8em;">
										<h2>User Authentication System</h2>
										<p>Dear '.$username.'<br><br>To reset your login password ,please click on the link below:</p>
										<p><a href="http://localhost/360vuz/password_recovery.php?id='.$encode_id.'"> Reset Password</a></p>
									</body>
								</html>';
                    $mail->addAddress($email,$username);
                    $mail->Subject="Password recovery message";
                    $mail->Body = $mail_body;

                    if ( $mail->Send() ) {
                        $result = popupMessage("Password Recovery",'Password reset link send successfully, please check your email !','success','login.php');
                    }else{
                        $result = popupMessage("E-mail sending FAILED!!",$mail->ErrorInfo,'error','forget_password.php');
                    }
                }else{
                    $result =  flashMessage("No user with this email exist") ;
                }
            }catch(PDOException $ex){
                $result =  flashMessage("Something went wrong WHILE GETTING THE DATA FROM THE DATABASE --> {$ex->getMessage()}") ;
            }
        }
}
?>