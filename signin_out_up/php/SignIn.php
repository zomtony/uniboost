
<?php
 
 	session_start();
	$accountb = $_POST["accountf"];
	$pwdb = $_POST["pwdf"];
	//$pwdb = MD5($pwdb);
	// Check connection
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection(); //create new database connected
	$conn = $myconn->connect();
	$stmt = $conn->prepare("SELECT * FROM User_Info WHERE userAccount=:accountb AND userPassword=:pwdb"); 
	$stmt->bindParam(':accountb', $accountb);
	$stmt->bindParam(':pwdb', $pwdb);
	$stmt->execute();
	$result = $stmt->rowCount();
	$row = $stmt->fetch();
	if($result > 0 ){
		$_SESSION['accountb'] = $accountb;
		$_SESSION['userLQPhotoId'] = $row['userLQPhotoId'];
		header("Location: ../../index.php");
	}else{
		header("Location: ../signin.php?info=user account or password are wrong");
	}
	$myconn->disconnect();
?>