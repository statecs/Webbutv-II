<?php

//Läser in hjälp-class och skapar en "PHPMailer"
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;

//Stänger av verifiering av SSL-certifikat för att förhindra felmeddelande
$mail->SMTPOptions = array(
  'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
  )
);

$sign = "Observera! Detta meddelande är sänt från ett formulär på Internet och avsändaren kan vara felaktig!";

//Läser in värden från POST till mailet
$mail->		IsSMTP();
$mail->		Mailer 		= "smtp";
$mail->		Host 		= "ssl://smtp.gmail.com";
$mail->		Port 		= 465;
$mail->		SMTPAuth 	= true;
$mail->		Username 	= "webbtest0@gmail.com"; // SMTP username
$mail->		Password 	= $_POST['password']; 
$mail->		Cc		   	= $_POST['cc'];
$mail->		Bcc		   	= $_POST['bcc'];
$mail->		From     	= $_POST['from'];
$mail->		Subject  	= $_POST['subject'];
$mail->		Body     	= $_POST['message'] . $sign . "\n\n";
$mail->		AddAddress($_POST['to']);  
//Loopar igenom filer som laddats upp. 
for($i=0;$i<count($_FILES['file']['name']);$i++){
	if($_FILES["file"]["name"][$i]!= ""){  
	  $strFilesName = $_FILES["file"]["name"][$i];  
	  $strContent = chunk_split(base64_encode(file_get_contents($_FILES["file"]["tmp_name"][$i])));  
	  $strSid = md5(uniqid(time()));
	  $uploadfile .= "--".$strSid."\n";  
	  $uploadfile .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\n";  
	  $uploadfile .= "Content-Transfer-Encoding: base64\n";  
	  $uploadfile .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\n\n";  
	  $uploadfile .= $strContent."\n\n";  
	  //Bifogar filer till epostmeddelandet.
	  $mail->addStringAttachment(base64_decode($uploadfile), $strFilesName);
	}
  }

$mail->WordWrap = 50;  

 header('Content-type: text/plain');
 
//Skriver ut felmeddelande om varför mailet ej gick att skicka
if(!$mail->send()) {
  echo "Lägger till fil" . $uploadfile . "\n";
  echo "Mailet kunde ej skickas\n\n";
  echo "Error: " . $mail->ErrorInfo;
} else {
	//Skriver ut vad som skickades (förutom lösenord)
	echo "Mailet har skickats\n\n";
	echo "Från: " . $_POST['from'] . "\n";
	echo "Till: " . $_POST['to'] . "\n";
	echo "Cc: " . $_POST['cc'] . "\n";
	echo "Bcc: " . $_POST['bcc'] . "\n";
	echo "Ärende: " . $_POST['subject'] . "\n";
	echo "Meddelande: " . $_POST['message'] . "\n";
	echo "Lägger till fil: " . $uploadfile . "\n";
}
?>
