<?php   
    session_start();
    $accountb = $_SESSION['accountb'];
    $newPwdb = $_POST['pwdf1'];
    $oldPwdb = $_POST['oldpwdf'];
    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    $count=0;
    try{
        $count = $conn->exec("UPDATE User_Info SET userPassword='$newPwdb' WHERE userAccount='$accountb' AND userPassword = '$oldPwdb'");
        if($count > 0){
            $conn->disconnect();
            header("Location: /userProfile/userProfile.php?info=修改成功");
        }else{
            $conn->disconnect();
            header("Location: /userProfile/changePwd.php?info=修改失败，有可能是输错了密码哦，请再试一遍");
        }  
    } catch(PDOException $err){
        $conn->disconnect();
        header("Location: /userProfile/changePwd.php?info=修改失败，有可能是输错了密码哦，请再试一遍");
        echo $err->getMessage();		
    }	
?>