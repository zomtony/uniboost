
<?php	
	session_start();

	$dirHQ = $_SERVER['DOCUMENT_ROOT'].'/img/defaultHQPohotId.jpg';
	$photoHQIdb = addslashes(file_get_contents($dirHQ));
	$dirLQ = $_SERVER['DOCUMENT_ROOT'].'/img/defaultLQPohotId.jpg';
	$photoLQIdb = addslashes(file_get_contents($dirLQ));

	$count = 0;
	$accountb = $_POST["accountf"];
	$pwdb = $_POST["pwdf1"];
	$nickNameb = $_POST["nickNamef"];		
	//$pwd = MD5($pwd);	
	// Check connection
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
	$conn = $myconn->connect();
	
	try{
		$count = $conn->exec("INSERT INTO User_Info (userAccount, userPassword, userName, userHQPhotoId, userLQPhotoId) VALUES ('$accountb', '$pwdb', '$nickNameb', '$photoHQIdb', '$photoLQIdb')");
	} catch(PDOException $err){
		echo $err->getMessage();		
	}	
	if($count > 0 ){
		$_SESSION['accountb'] = $accountb;
		header("Location: ../../index.php");
	}else{
		header("Location: ../signup.php?info=账号已经被注册请输入其他账号");
	}

	$myconn->disconnect();
?>