<?php
    class processUserInfo {

        function getInfo($accountb){
            include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
            $myconn = new createConnection(); //create new database connected
            $conn = $myconn->connect();
            try{
                $stmt = $conn->prepare("SELECT * FROM User_Info WHERE userAccount='$accountb'"); 
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_BOTH);
            } catch(PDOException $err){
                echo $err->getMessage();		
            }	
            return $result;
        }

        function updataInfo($accountb, $emailb, $userNameb, $phoneb, $wechatb, $briefIntroductionb, $contentHQPhotoIdb, $contentLQPhotoIdb, $LQPhotoIdNav){

            include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
            $myconn = new createConnection(); //create new database connected
            $conn = $myconn->connect();
            $count=0;
            try{
                if($contentHQPhotoIdb != ''  &&  $contentLQPhotoIdb != ''){
                    $count = $conn->exec("UPDATE User_Info SET userEmail='$emailb', userHQPhotoId='$contentHQPhotoIdb', userName='$userNameb', phoneNumber='$phoneb', weChatNumber='$wechatb', briefIntroduction='$briefIntroductionb', userLQPhotoId='$contentLQPhotoIdb' WHERE userAccount='$accountb'");                   
                    $_SESSION['userLQPhotoId'] = $LQPhotoIdNav;
                }else{
                    $count = $conn->exec("UPDATE User_Info SET userEmail='$emailb', phoneNumber='$phoneb', userName='$userNameb', weChatNumber='$wechatb', briefIntroduction='$briefIntroductionb' WHERE userAccount='$accountb'");
                }  
            } catch(PDOException $err){
                echo $err->getMessage();		
            }	

            return $count;
        }


        function disconnect(){
			$this->conn = null;
		}
    }

?>