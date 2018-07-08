<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/php/getPostTime.php'); 
    $getPostTime = new getPostTime(); 

    $tutorPostAccount =$_SESSION['tutorPostAccount'];
    $rateb = $_POST['ratef'];
    $commentb = $_POST['commentf'];
    var_dump($rateb) ;
   
    $commentSenderAccountb = $_SESSION['accountb'];
    

    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php');
    $myconn = new createConnection(); //create new database connected
    $conn = $myconn->connect();
    $info = '';

    $query = "SELECT * FROM User_Comment  WHERE commentSenderAccount = '$commentSenderAccountb' ORDER BY commentId DESC limit 1";
    $postTimeSql = $conn->prepare($query);
    $postTimeSql->execute();
    $rowCount = $postTimeSql->rowCount();
    $result = $postTimeSql->fetch();

    if($rowCount > 0){
        $currectTimeSql = $conn->prepare("SELECT now() as now");
        $currectTimeSql -> execute();
        $currectTimeResult = $currectTimeSql->fetch(PDO::FETCH_OBJ);
        $currectTime = $currectTimeResult -> now;

        $postTime = $result['date'];
        $theTime = $getPostTime -> checkIfCanPost($currectTime, $postTime);
        
        if($theTime > 300){
            try{
                $countInsert = $conn->exec("INSERT INTO User_Comment (userAccount, comment, commentSenderAccount) VALUES ('$tutorPostAccount', '$commentb', '$commentSenderAccountb')");
            } catch(PDOException $info){
                echo $info->getMessage();		
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
                        
            } catch(PDOException $info){
                echo $info->getMessage();		
            }   
        }else{
            $theInterval = 300 - $theTime;
            if($theInterval > 60){
                $_SESSION['post_time_record'] = "<label>你刚刚评论过了哦，请在". round($theInterval/60) ."分钟后再尝试</label>";
            }else{
                $_SESSION['post_time_record'] = "<label>你刚刚评论过了哦，请在". $theInterval ."秒后再尝试</label>";
            }
        }

    }else{
        try{
            $countInsert = $conn->exec("INSERT INTO User_Comment (userAccount, comment, commentSenderAccount) VALUES ('$tutorPostAccount', '$commentb', '$commentSenderAccountb')");
        }catch(PDOException $info){
            echo $info->getMessage();		
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
                        
            } catch(PDOException $info){
                echo $info->getMessage();		
            }   
    }

?>
