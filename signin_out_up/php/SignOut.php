<?php	
	session_start(); 

	$id = $_SESSION['accountf'];



	//if($outputArray['@result'] == 1){
	session_destroy();
	header("Location: ../../index.php");

			
	$conn->close();
?>