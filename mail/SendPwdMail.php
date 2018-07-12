<?php
	
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require $_SERVER['DOCUMENT_ROOT'].'/mail/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'/mail/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'/mail/src/SMTP.php';   

	$accountb = $_POST['accountf'];
	$emailb = $_POST['emailf'];
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection(); //create new database connected
	$conn = $myconn->connect();
	$stmt = $conn->prepare("SELECT * FROM User_Info WHERE userAccount=:accountb AND userEmail=:emailb"); 
	$stmt->bindParam(':accountb', $accountb);
	$stmt->bindParam(':emailb', $emailb);
	$stmt->execute();
	$result = $stmt->rowCount();
	if($result > 0 ){

		$length = 8;
		$ramdowPwd = random_password($length);

		$stmt = $conn->prepare("UPDATE User_Info SET userPassword='$ramdowPwd' WHERE userAccount=:accountb"); 
		$stmt->bindParam(':accountb', $accountb);
		$stmt->execute();
		$result = $stmt->rowCount();
		if($result > 0){
			$myconn->disconnect();
			$mail = new PHPMailer(true); // Passing `true` enables exceptions
			try {
				//Server settings
				$mail->SMTPDebug = 0;                                 // Enable verbose debug output
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = 'no.replay.woshihlj@gmail.com';                 // SMTP username
				$mail->Password = 'Uniboost12';                           // SMTP password
				$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;                                    // TCP port to connect to
		
				//Recipients
				$mail->setFrom('no-replay@woshihlj.com', 'woshihlj.com');
				//$mail->addAddress('ellen@gmail.com', 'Joe User');     // Add a recipient
				$mail->addAddress($emailb);               // Name is optional
				//$mail->addReplyTo('info@example.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
		
				//Attachments
				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
				//Content
		
		
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'woshihlj.com';
				$mail->Body    = "Hi:<br><br>This is your new password: <b>" . $ramdowPwd . "</b>, For your account safe，please login with the new password and change to your password as soon as possible.<br><br>Please do not reply to this message; it was sent from an unmonitored email address and you will not receive a response";
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
				$mail->send();
				//echo 'Message has been sent';
				header("Location: /signin_out_up/signin.php?info=请检查邮箱,并用邮箱里的密码登陆");
			} catch (Exception $e) {
				header("Location: /signin_out_up/findPwd.php?info=用户名或邮箱不存在");
				//echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			}
		}else{
			$myconn->disconnect();
			header("Location: /signin_out_up/findPwd.php?info=用户名或邮箱不存在");
		}
	}else{
		$myconn->disconnect();
		header("Location: /signin_out_up/findPwd.php?info=用户名或邮箱不存在");
	}


	function random_password($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
?>
