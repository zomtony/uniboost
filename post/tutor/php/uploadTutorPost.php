<?php
    session_start();
    $accountb = $_SESSION['accountb'];
    $phoneNumberb = $_POST['phoneNumberf'];
    $weChatb = $_POST['weChatf'];
    $userNamef = $_POST['userNamef'];
    $briefIntroductionb = $_POST['briefIntroductionf'];

    $date = date("Y-m-d H:i:s");
    $contentb = $_POST['contentf'];

    $courseArrayb = $_POST['courseArrayf'];
    $courseString = getCourseString($courseArrayb);

    if($_POST['wagef'] != null){
        $wageb = $_POST['wagef'];
    }else{
        $wageb = 0.00;
    }
    $schoolb=$_POST['schoolf'];
    
    $avaDayb = $_POST['mondayf'].$_POST['tuesdayf'].$_POST['wednesdayf'].$_POST['thursdayf'].$_POST['fridayf'].$_POST['saturdayf'].$_POST['sundayf'];
    $count = 0;
    $count1 = 0;

    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
	$conn = $myconn->connect();
	
	try{
		$count = $conn->exec("INSERT INTO Tutor_Post (userAccount, content, courseNumber, wage, school, avaliableDay) 
            VALUES ('$accountb', '$contentb', '$courseString', '$wageb', '$schoolb', '$avaDayb')");

        $count1 = $conn->exec("UPDATE User_Info SET userName='$userNamef', phoneNumber = '$phoneNumberb', weChatNumber = '$weChatb', briefIntroduction = '$briefIntroductionb' WHERE userAccount = '$accountb'");
	} catch(PDOException $err){
		echo $err->getMessage();		
	}	

    if($count > 0 ){
		$_SESSION['accountb'] = $accountb;
		header("Location: /index.php");
	}else{
		header("Location: ../tutorPost.php?info=发布消息失败");
	}

    function getCourseString($courseArrayb){
        $courseString = '';
        for($i = 0; $i < 6; $i++){
            if($courseArrayb[$i] != NULL && $courseArrayb[$i] != ''){
                $courseString .= $courseArrayb[$i].'|';   
            }             
        }
        return $courseString;
    }
?>