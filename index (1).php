<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";

$mail = new PHPMailer;

/*if(isset($_POST['action'])){
  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTmpName = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  $fileExt = explode('.', $fileName);
  
  $fileActualExt = strtolower($fileExt[1]);
  
  $allowed = array('jpg','jpeg','pdf','bat','c','py');

  if(in_array($fileActualExt, $allowed)){
    if($fileError === 0){
      if($fileSize<10000000){
        $fileNewName = uniqid('',true).'.'.$fileActualExt;

        $fileDestination = 'uploads/'.$fileNewName;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: index.php?fileUpload==success");

      }else{
        echo 'File is Too Big';
      } 
    }else{
      echo 'There Was An Error in Uploading File';
    }
  }else{
    echo 'Format Not Supported';
  }
}*/

$email 			= 	$_POST['email'];
$name 			= 	$_POST['name'];
$subject 		= 	$_POST['sub'];
$password 	= 	$_POST['pass'];
$message 		= 	$_POST['message'];
$sentto 		= 	$_POST['sentto'];

$mail->isSMTP();          
$mail->SMTPOptions = array(
    'ssl' => array(
        	'verify_peer' 			  => false,
        	'verify_peer_name' 		=> false,
        	'allow_self_signed' 	=> true
    	)
	);
$mail->SMTPDebug 	  = 2;  
$mail->Host 		    = "smtp.gmail.com";
$mail->SMTPAuth 	  = true;                          
$mail->Username 	  = $email;                 
$mail->Password 	  = $password;                           
$mail->SMTPSecure 	= "tls";                           
$mail->Port 		    = 587;                                   

$mail->From 		    = $email;
$mail->FromName 	  = $name;
$mail->Subject 		  = $subject;
$mail->Body 		    = file_get_contents('send.html');

$mail->addAddress($sentto,$name);
$mail->addAttachment("uploads/".$fileNewName);
$mail->isHTML(true);

if(!$mail->send()) 
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} 
else 
{
    echo "Message has been sent successfully";
}
//echo file_get_contents('send.html');

?>

<!DOCTYPE html>
<html>
<head>
	<title>send mail</title>
	  <!-- Compiled and minified CSS -->
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
	  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	  <!-- Compiled and minified JavaScript -->
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
          
</head>
<body>
	<div class="row"> 
    <form class="col s12" action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="row">
        	<div class="input-field col s6">
          		<input placeholder="Name" type="text" class="validate" name="name">
        	</div>
        </div>
        <div class="row">
        	<div class="input-field col s6">
          		<input placeholder="Email" type="email" class="validate" name="email">
        	</div>
        </div>
        <div class="row">
        	<div class="input-field col s6">
          		<input id="password" placeholder="password" type="password" class="validate" name="pass">
        	</div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <input  type="email" placeholder="Send To" class="validate" name="sentto">
          </div>
        </div>
        <div class="row">
        	<div class="input-field col s6">
	          <label for="icon_prefix2">subject</label>
	          <input type="text" class="materialize-textarea" name="sub"></input>
        	</div>
        </div>
        <div class="input-field col s6">
          <label for="icon_prefix2">Message</label>
          <textarea  name="message" class="materialize-textarea"></textarea>
        </div>
        <div class="row">
	        <div class="input-field col s6">
	        
	  		</div>
  		</div>
      <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" name="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
      </div>
  		<button class="btn waves-effect waves-light" type="submit" name="action">Submit
   			 <i class="material-icons right">send</i>
  		</button>
    </form>
  </div>
		
</body>
</html>