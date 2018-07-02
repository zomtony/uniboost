<?php
class tutorPostInfo {

    function getPostInfo($tutorPostIdb){
        include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
        $myconn = new createConnection(); //create new database connected
        $conn = $myconn->connect();
        try{
            $stmt = $conn->prepare("SELECT * FROM User_Info NATURAL JOIN Tutor_Post WHERE tutorPostId='$tutorPostIdb'"); 
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