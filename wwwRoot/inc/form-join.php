<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/OAuth.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/POP3.php';

$success = $warning = $error = $msg = $wasSent = "";

// Make sure the form was indeed POST'ed:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// First, make sure the form was posted from a browser.
	if(!isset($_SERVER['HTTP_USER_AGENT'])) {
		die("Forbidden - You are not authorized to view this page");
		exit;
	}
	/*
	// Host names from where the form is authorized
	// to be posted from:  
	$authHosts = array("iconagility.com", "dev.iconagility.com");
	// Where have we been posted from?
	$fromArray = parse_url(strtolower($_SERVER['HTTP_REFERER']));
	// Test to see if the $fromArray used www to get here.
	$wwwUsed = strpos($fromArray['host'], "www.");
	// Make sure the form was posted from an approved host name.
	if(!in_array(($wwwUsed === false ? $fromArray['host'] : substr(stristr($fromArray['host'], '.'), 1)), $authHosts)) {
		//logBadRequest();
		header("Content-Type: text/html; charset=UTF-8");
		header("Location: " . basename($_SERVER['PHP_SELF']) . "");
		exit;
	}
	*/
	// Attempt to defend against header injections:
	$badStrings = array("Content-Type:", 
                     	"MIME-Version:", 
                     	"Content-Transfer-Encoding:", 
                     	"bcc:", 
                     	"cc:",
						"to:");
	// Loop through each POST'ed value and test if it contains
	// one of the $badStrings:
	foreach($_POST as $k => $v) {
		foreach($badStrings as $v2) {
			if(strpos($v, $v2) !== false) {
				//logBadRequest();
				header("Content-Type: text/html; charset=UTF-8");
				header("Location: " . htmlspecialchars(basename($_SERVER["REQUEST_URI"])) . "");
				exit;
			}
		}
	}
	// Made it past spammer test, free up some memory
	// and continue rest of script:
	unset($k, $v, $v2, $badStrings, $authHosts, $fromArray, $wwwUsed);
	
	// Check honeypot, ignore any submission that includes this field
	if(!empty($_POST['website'])) {
		die();
	}
	
	(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "") ? $whereFrom = $_SERVER['HTTP_REFERER'] : $whereFrom="No referer, direct request.";
	$inputEmail		=	test_input($_POST['inputEmail']);
	
	if (empty($inputEmail)) {
		$warning	=	"True";
		$msg		=	"Please provide your email address";
	} elseif (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
		$warning	=	"True";
		$msg		=	"Invalid email address format";
	} else {
		if ($warning == "") {
			//Create a new PHPMailer instance
			$mail = new PHPMailer;
			$mail->isSMTP();
			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->SMTPOptions = array(
									   'ssl' => array(
													  'verify_peer' => false,
													  'verify_peer_name' => false,
													  'allow_self_signed' => true
													  )
									   );
			$mail->Username = "webcontact@iconatg.com";
			$mail->Password = "riscjxmdgxnteamr";
			$mail->setFrom('diversitygallery@gmail.com', 'Diversity Gallery Website');
			$mail->addReplyTo('diversitygallery@gmail.com', 'Diversity Gallery Website');
			$mail->addAddress('diversitygallery@gmail.com', 'Diversity Gallery Website');
			//$mail->addAddress('scott.lix@iconagility.com', 'Icon Website');
			$mail->Subject = 'Diversity Gallery Website Join Request';
			$mail->Body =	"The user has sent an e-mail requesting to be emailed news and updates.\n" .
							"Please add this address to your Constant Contact database.\n\n" .
							"Referer: " . $whereFrom . "\n\n" . 
							"Contact Email: " . $inputEmail . "\n";
			if (!$mail->send()) {
				$error		=	"True";
			} else {
				$success	=	"True";
				$wasSent	=	"True";
			}
		}
	}
}
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
						<?php if(isset($success) && $success != "" && $success == "True"){ ?>
						<div class="alert alert-success">
							<strong>Thank you!</strong> Your e-mail address has been submitted. You will receive newsletters and updates from us!
						</div>
						<?php } elseif(isset($msg) && $msg != "" && isset($warning) && $warning != "" && $warning == "True"){ ?>
						<div class="alert alert-warning">
							<?php echo $msg ?>
						</div>
						<?php } elseif(isset($error) && $error != "" && $error == "True"){ ?>
						<div class="alert alert-danger">
							<strong>The message was not sent! An internal error occured.</strong>
						</div>
						<?php } ?>
						<?php if($wasSent==""){ ?>
						<p><strong>Enter your email address for news and updates!</strong></p>
						<form class="form-inline" action="<?php echo htmlspecialchars(basename($_SERVER["REQUEST_URI"]));?>#joinUpdates" method="post" id="subForm" name="subForm">
							<input type="text" id="website" name="website" />
							<div class="input-group">
								<label class="sr-only" for="inputEmail">Email address</label>
								<input type="email" value="" name="inputEmail" class="form-control input" id="inputEmail" placeholder="Email Address" required>
								<span class="input-group-btn btn-add">
									<input type="submit" value="Join" name="join" id="join" class="btn btn-subscribe">
								</span>
							</div>
						</form>
						<?php } ?>