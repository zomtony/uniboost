<?php
    session_start();
    $count = 0;
    $tutorPostIdb = $_GET["tutorPost"];          

	//$pwd = MD5($pwd);	
	// Check connection
	include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
	$conn = $myconn->connect();
	
	try{
		$count = $conn->exec("DELETE FROM Tutor_Post WHERE tutorPostId='$tutorPostIdb'");
	} catch(PDOException $err){
		echo $err->getMessage();		
	}	
	if($count > 0 ){
        $acb = $_SESSION['accountb'];
		header("Location: /userProfile/myPostList.php?acb=$acb");
	}else{
		header("Location: /userProfile/myPostList.php?info=啊哦，删除失败，请在试试吧");
    }
?>