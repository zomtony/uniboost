<?php
class tutorPostInfo {

    function getPostInfo($tutorPostIdb){
        include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
        $myconn = new createConnection(); //create new database connected
        $conn = $myconn->connect();
        try{
            $stmt = $conn->prepare("SELECT tp.userAccount, tp.date, tp.content, tp.wage, tp.school, tp.avaliableDay, tp.phoneNumber, tp.weChatNumber, 
                tp.courseNumber, tp.briefIntroduction, ui.userName, ui.userHQPhotoId, ui.totalRateScore, ui.averageRateScore, ui.rateNumber
                FROM Tutor_Post tp LEFT JOIN User_Info  ui ON tp.userAccount = ui.userAccount WHERE tutorPostId='$tutorPostIdb'"); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_BOTH);
        } catch(PDOException $err){
            echo $err->getMessage();		
        }	
        return $result;
    }

    function getAdPostInfo($userIdb){
        include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
        $myconn = new createConnection(); //create new database connected
        $conn = $myconn->connect();
        try{
            $stmt = $conn->prepare("SELECT tp.userAccount, tp.date, tp.content, tp.wage, tp.school, tp.avaliableDay, tp.phoneNumber, tp.weChatNumber, 
                tp.courseNumber, tp.briefIntroduction, ui.userName, ui.userHQPhotoId, ui.totalRateScore, ui.averageRateScore, ui.rateNumber
                FROM Tutor_Post tp LEFT JOIN User_Info  ui ON tp.userAccount = ui.userAccount WHERE ui.userId = $userIdb ORDER BY tutorPostId DESC LIMIT 1"); 
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_BOTH);
        } catch(PDOException $err){
            echo $err->getMessage();		
        }	
        return $result;
    }

    function disconnect(){
        $this->conn = null;
    }
}
?>