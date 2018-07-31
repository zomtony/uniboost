<?php
    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
	$myconn = new createConnection();
    $conn = $myconn->connect();
    

    $groupNickNameb = $_POST['groupNickNamef'];
    $gmailb = $_POST['gmailf'];
    $schoolb = $_POST['schoolf'];
    $applyCourseNumberb = $_POST['applyCourseNumberf'];

    try{

        $stmt = $conn->prepare("SELECT * FROM RecordShareMateria WHERE userGmail = '$gmailb'");
        $stmt->execute();
        $total = $stmt->rowCount();	
        $result = $stmt->fetch(PDO::FETCH_BOTH);
	} catch(PDOException $err){
		echo $err->getMessage();		
    }	
    
    if($total > 0){
        $applyTimes = $result['applyTimes'] + 1;

        $stmt = $conn->prepare("UPDATE RecordShareMateria SET applyTimes = $applyTimes WHERE userGmail = '$gmailb'");
        $stmt->execute();
        $total = $stmt->rowCount();	
        if($total > 0){
            $stmt = $conn->prepare("INSERT INTO ApplyMateriaDetail (userGmail, school, applyCourseNumber, applyStatus) VALUES ('$gmailb', '$schoolb', '$applyCourseNumberb', 0)");
            $stmt->execute();
            $total = $stmt->rowCount();	  
            if($total > 0){
                header("Location: /shareMaterialsNodejs/apply/resultS.html");
            }else{
                header("Location: /shareMaterialsNodejs/apply/resultF.html");
            }	 
        }
	}else{
        $stmt = $conn->prepare("INSERT INTO RecordShareMateria (userGmail, groupNickName, applyTimes, shareTimies) VALUES ('$gmailb', '$groupNickNameb', 1, 0)");
        $stmt->execute();
        $total = $stmt->rowCount();	
    
        if($total > 0){
            $stmt = $conn->prepare("INSERT INTO ApplyMateriaDetail (userGmail, school, applyCourseNumber, applyStatus) VALUES ('$gmailb', '$schoolb', '$applyCourseNumberb', 0)");
            $stmt->execute();
            $total = $stmt->rowCount();
            if($total > 0){
                header("Location: /shareMaterialsNodejs/apply/resultS.html");
            }else{
                header("Location: /shareMaterialsNodejs/apply/resultF.html");
            }	
        }
    }

?>