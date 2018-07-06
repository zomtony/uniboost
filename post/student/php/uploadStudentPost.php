<?php
    session_start();
    if(isset($_SESSION['accountb'])){
        $accountb = $_SESSION['accountb'];
    }else{
        $accountb = 'Guest';
    }

    $userNameb=$_POST['userNamef'];
    $phoneNumberb=$_POST['phoneNumberf'];
    $weChatNumberb=$_POST['weChatNumberf'];
    $schoolb=$_POST['schoolf'];
    $expectedCourseb=$_POST['expectedCoursef'];
    $expectedCourseb = str_replace(' ', '', $expectedCourseb);
    $contentb=$_POST['contentf'];
    
    if($_POST['expectedPricef'] != null){
        $expectedPriceb = $_POST['expectedPricef'];
    }else{
        $expectedPriceb = 0.00;
    }
  
    $avaDayb = $_POST['mondayf'].$_POST['tuesdayf'].$_POST['wednesdayf'].$_POST['thursdayf'].$_POST['fridayf'].$_POST['saturdayf'].$_POST['sundayf'];
    $count = 0;
    

    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
	$conn = $myconn->connect();
	
	try{
		$count = $conn->exec("INSERT INTO Student_Post (userAccount, userName, avaliableDay, expectedPrice, school, phoneNumber, weChatNumber, expectedCourse, content) 
            VALUES ('$accountb', '$userNameb', '$avaDayb', '$expectedPriceb', '$schoolb', '$phoneNumberb', '$weChatNumberb', '$expectedCourseb', '$contentb')");
	} catch(PDOException $err){
		echo $err->getMessage();		
	}	

    if($count > 0 ){
        $_SESSION['choosePostType'] = 'student';
        $_SESSION['chooseSchool'] = 'selected';
        $_SESSION['keyWords'] = '';
		header("Location: /index.php");
	}else{
		header("Location: ../studentPost.php?info=发布消息失败");
	}

?>