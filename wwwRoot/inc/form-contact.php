<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/OAuth.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/POP3.php';

$success = $warning = $error = $msg_contact = $wasSent = "";

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
	$authHosts = array("diversitygallerystl.com", "staging.iconagility.com");
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
	$badStringsContact = array("Content-Type:", 
                     	"MIME-Version:", 
                     	"Content-Transfer-Encoding:", 
                     	"bcc:", 
                     	"cc:",
						"to:");
	// Loop through each POST'ed value and test if it contains
	// one of the $badStrings:
	foreach($_POST as $k => $v) {
		foreach($badStringsContact as $v2) {
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
	unset($k, $v, $v2, $badStringsContact, $authHosts, $fromArray, $wwwUsed);
	
	// Check honeypot, ignore any submission that includes this field
	if(!empty($_POST['website'])) {
		die();
	}
	
	(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "") ? $whereFrom = $_SERVER['HTTP_REFERER'] : $whereFrom="No referer, direct request.";
	$inputName			=	test_input_contact($_POST['inputName']);
	$inputEmail			=	test_input_contact($_POST['inputEmail']);
	$inputPhone			=	test_input_contact($_POST['inputPhone']);
	$inputComments		=	test_input_contact($_POST['inputComments']);
	
	if (empty($inputName)) {
		$warning		=	"True";
		$msg_contact	=	"Please provide your name";
	} elseif (!preg_match("/^[a-zA-Z ]*$/",$inputName)) {
		$warning		=	"True";
		$msg_contact	=	"Only letters and white space allowed in your name";
	} elseif (empty($inputEmail)) {
		$warning		=	"True";
		$msg_contact	=	"Please provide your email address";
	} elseif (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
		$warning		=	"True";
		$msg_contact	=	"Invalid email address format";
	} elseif (empty($inputComments)) {
		$warning		=	"True";
		$msg_contact	=	"Please provide your comments, questions, requests, etc.";
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
			$mail->Subject = 'Diversity Gallery Website Contact';
			$mail->Body =	"The user has sent an e-mail.\n" .
							"Referer: " . $whereFrom . "\n\n" . 
							"Name: " . $inputName . "\n" .
							"Contact Email: " . $inputEmail . "\n" .
							"Phone Number: " . $inputPhone . "\n" .
							"Comments:\n" . $inputComments . "\n\n";
			if (!$mail->send()) {
				$error		=	"True";
			} else {
				$success	=	"True";
				$wasSent	=	"True";
			}
		}
	}
}
function test_input_contact($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
						<?php if(isset($success) && $success != "" && $success == "True"){ ?>
						<div class="alert alert-success">
							<strong>Thank you!</strong> Your e-mail has been sent. Please allow 24-48 hours for us to address your request.
						</div>
						<?php } elseif(isset($msg_contact) && $msg_contact != "" && isset($warning) && $warning != "" && $warning == "True"){ ?>
						<div class="alert alert-warning">
							<?php echo $msg_contact ?>
						</div>
						<?php } elseif(isset($error) && $error != "" && $error == "True"){ ?>
						<div class="alert alert-danger">
							<strong>The message was not sent! An internal error occured.</strong>
						</div>
						<?php } ?>
						<?php if($wasSent==""){ ?>
						<p>Have questions about us, our products, our services, or something else? Please contact us!</p>
						<form role="form" id="contactForm" method="post" action="<?php echo htmlspecialchars(basename($_SERVER["REQUEST_URI"]));?>">
							<input type="text" id="website" name="website" />
							<div class="form-group">
								<label for="inputName">Full Name</label> <small class="text-danger">(Required)</small>
								<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Full Name" value="<?php if(isset($inputName) && $inputName != "") { ?><?php echo $inputName ?><?php } ?>" />
							</div>
								<div class="form-group">
								<label for="inputEmail">Email address</label> <small class="text-danger">(Required)</small>
								<input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email Address" value="<?php if(isset($inputEmail) && $inputEmail != "") { ?><?php echo $inputEmail ?><?php } ?>" />
							</div>
							<div class="form-group">
									<label for="inputPhone">Phone Number</label> <small class="text-info">(Optional)</small>
								<input type="tel" class="form-control" id="inputPhone" name="inputPhone" placeholder="Phone Number" value="<?php if(isset($inputPhone) && $inputPhone != "") { ?><?php echo $inputPhone ?><?php } ?>" />
							</div>
								<div class="form-group">
								<label for="inputComments">Requests / Questions</label> <small class="text-danger">(Required)</small>
								<textarea class="form-control" rows="7" id="inputComments" name="inputComments" placeholder="Requests / Questions"><?php if(isset($inputComments) && $inputComments != "") { ?><?php echo $inputComments ?><?php } ?></textarea>
							</div>
							<div class="form-group">
								<button type="submit" 
									class="g-recaptcha btn btn-success" 
									data-sitekey="6LcA1JMaAAAAAKzWd7aJB0NKPOi4kZQaGVlJ3hKO" 
									data-callback='onSubmit' 
									data-action='submit'>
										<i class="fa fa-envelope" aria-hidden="true"></i> Submit
								</button> 
								<button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-remove-sign"></span> Clear</button>
							</div>
						</form>
						<?php } ?>