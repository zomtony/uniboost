
<?php	
	session_start();

	$dirHQ = $_SERVER['DOCUMENT_ROOT'].'/img/defaultHQPhotoId.jpg';
	$photoHQIdb = addslashes(file_get_contents($dirHQ));
	$dirLQ = $_SERVER['DOCUMENT_ROOT'].'/img/defaultHQPhotoId.jpg';
	$photoLQIdb = addslashes(file_get_contents($dirLQ));

	$count = 0;
	$accountb = $_POST["accountf"];
	$pwdb = $_POST["pwdf1"];
	//$pwd = MD5($pwd);	
	// Check connection
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
	$conn = $myconn->connect();
	
	try{
		$count = $conn->exec("INSERT INTO User_Info (userAccount, userPassword, userHQPhotoId, userLQPhotoId) VALUES ('$accountb', '$pwdb', '$photoHQIdb', '$photoLQIdb')");
	} catch(PDOException $err){
		echo $err->getMessage();		
	}	
	if($count > 0 ){
		$_SESSION['accountb'] = $accountb;	
		$_SESSION['userLQPhotoId'] = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/img/defaultLQPohotId.jpg');
		header("Location: /userProfile/addInfo.php");
	}else{
		//header("Location: ../signup.php?info=啊哦，该账号已经被注测过啦，换一个试试吧");
	}

	$myconn->disconnect();
?>