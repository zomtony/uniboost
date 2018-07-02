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

        function updataInfo($accountb, $phoneb, $wechatb, $briefIntroductionb, $contentHQPhotoIdb, $contentLQPhotoIdb){

            include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
            $myconn = new createConnection(); //create new database connected
            $conn = $myconn->connect();
            $count=0;
            try{
                if($contentHQPhotoIdb != ''  &&  $contentLQPhotoIdb != ''){
                    $count = $conn->exec("UPDATE User_Info SET userHQPhotoId='$contentHQPhotoIdb', phoneNumber='$phoneb', weChatNumber='$wechatb', briefIntroduction='$briefIntroductionb', userLQPhotoId='$contentLQPhotoIdb' WHERE userAccount='$accountb'");
                }else{
                    $count = $conn->exec("UPDATE User_Info SET phoneNumber='$phoneb', weChatNumber='$wechatb', briefIntroduction='$briefIntroductionb' WHERE userAccount='$accountb'");
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