<?php
    class studentPostInfo {

        function getPostInfo($studentPostIdb){
            include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
            $myconn = new createConnection(); //create new database connected
            $conn = $myconn->connect();
            try{
                $stmt = $conn->prepare("SELECT st.userAccount, st.date, st.content, st.	expectedPrice, st.school, st.avaliableDay, st.phoneNumber, st.weChatNumber, 
                st.expectedCourse, ui.briefIntroduction, st.userName, ui.userHQPhotoId FROM Student_Post st LEFT JOIN User_Info ui ON st.userAccount = ui.userAccount WHERE studentPostId='$studentPostIdb'"); 
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