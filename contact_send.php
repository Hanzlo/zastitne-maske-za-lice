<?php
require('captcha/autoload.php');
 
$siteKey = '6LcbLeMUAAAAAImIiIosr_D7KnOFLbg5OsGT1RU_';
$secret = '6LcbLeMUAAAAAP5dSKnCldaFKpqGJdGX6oxwU';
 
$recaptcha = new \ReCaptcha\ReCaptcha($secret);
 
$gRecaptchaResponse = $_POST['g-recaptcha-response']; //google captcha post data
$remoteIp = $_SERVER['REMOTE_ADDR']; //to get user's ip
 
$recaptchaErrors = ''; // blank varible to store error
 
$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp); //method to verify captcha

$mail_status = false;

if ($resp->isSuccess()) {
	
	$field_name = $_POST['name'];
	$field_telefon = $_POST['phone'];
	$field_tvrtka = $_POST['tvrtka'];
	$field_email = $_POST['email'];
	$field_message = $_POST['textarea'];
   
	if

	(

		isset($_POST["name"]) && (strlen($_POST["name"]) > 0)
		&& isset($_POST["email"])  && (strlen($_POST["email"]) > 0)
		&& isset($_POST["phone"])  && (strlen($_POST["phone"]) > 0)
		&& isset($_POST["textarea"])  && (strlen($_POST["textarea"]) > 0)

		)

		{

		$mail_to = 'hanzlo89@gmail.com';
		$subject = 'Nova poruka od '.$field_name;

		$body_message = 'Poruku poslao: '.$field_name. "\n";
		$body_message .= 'Tvrtka: '.$field_tvrtka."\n";
		$body_message .= 'Telefon: '.$field_telefon."\n";
		$body_message .= 'E-mail: '.$field_email."\n";
		$body_message .= 'Poruka: '.$field_message;


		$headers = 'From: '.$field_email."\r\n";
		$headers .= 'Reply-To: '.$field_email."\r\n";


		$mail_status = mail($mail_to, $subject, $body_message, $headers);
		
		
		}
	else {
		?>

	<script language="javascript" type="text/javascript">
		alert('Poruka nije poslana, molimo ispunite sva polja');
		window.location = 'index.html';
	</script>
<?php
	}
   
} else {
?>
	<script language="javascript" type="text/javascript">
		alert('Poruka nije poslana, molimo ispunite captcha');
		window.location = 'index.html';
	</script>
<?php
}

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Hvala na poslanoj poruci. Kontaktirati ćemo vas uskoro.');
		window.location = 'index.html';
	</script>
<?php
}

?>