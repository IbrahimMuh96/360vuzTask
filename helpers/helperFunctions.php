<?php
function show_errors($errors_array){
    $errors = "<div class='alert alert-danger'>";

    foreach ($errors_array as $error) {
        $errors.= "<li>{$error}</li>";
    }
    $errors.="</div>" ;
    return $errors;

}


function flashMessage($message,$color='red'){
    if( $color === 'red' ){
        $data = "<div class='alert alert-danger'>{$message}</div>";
    }else{
        $data = "<div class='alert alert-success'>{$message}</div>";
    }
    return $data;
}

function popupMessage($title, $text, $type, $page){
    $message ="<script type='text/javascript'>
				swal({
  					title: '{$title}',
  					text: '{$text}',
  					timer: 2000,
  					type: '{$type}',
  					showConfirmButton: false
				});
	  				setTimeout(function(){
	    				window.location.href='{$page}'; 
	  				}, 1000);
				</script>";

    //$message = "$username";
    return $message;
}

function rememberMe($id){
    setcookie('authenticationSystem',$id,time()+60*60*24*100,"/");
}

function Not_authorized($message,$page,$link_ame){
    $returnMesssage= "<div class=\"container\" align=\"center\" style=\"padding-top: 30%\" >
						<section>
							<p class=\"lead\"> {$message} </br> <a href=\"{$page}\" >{$link_ame} </a> </p>
						</section>
					</div>";
    return $returnMesssage;
}