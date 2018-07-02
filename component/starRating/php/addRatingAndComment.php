<?php
    session_start();
    $tutorPostAccount =$_SESSION['tutorPostAccount'];
    $rateb = $_POST['ratef'];
    $commentb = $_POST['commentf'];
    var_dump($rateb) ;
    if(isset($_SESSION['accountb'])){
        $commentSenderAccountb = $_SESSION['accountb'];
    }else{
        $commentSenderAccountb = "GUEST";
    }
    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php');
    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    try{
      $countInsert = $conn->exec("INSERT INTO User_Comment (userAccount, comment, commentSenderAccount) VALUES ('$tutorPostAccount', '$commentb', '$commentSenderAccountb')");
    } catch(PDOException $err){
      echo $err->getMessage();		
    }

    try{
        $stmt = $conn->prepare("SELECT * FROM User_Info WHERE userAccount='$tutorPostAccount'"); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_BOTH);
        if($result != null ){
            $totalRateScore = $result['totalRateScore'] + $rateb;
            $rateNumber = $result['rateNumber'] + 1;
            $averageRateScore = $totalRateScore/$rateNumber;

            $stmt = $conn->prepare("UPDATE User_Info SET totalRateScore = '$totalRateScore', rateNumber = '$rateNumber',  averageRateScore = '$averageRateScore' WHERE userAccount='$tutorPostAccount'"); 
            $stmt->execute();
            $updateNum = $stmt->rowCount();
            if($updateNum > 0 ){
                echo 'suc';
            }else{
                echo 'failed';
            }
        }else{
            echo 'failed';
        }
                
    } catch(PDOException $err){
        echo $err->getMessage();		
    }   
    

    $data = array(
        'error'  => $err
    );

    echo json_encode($data);
?>
