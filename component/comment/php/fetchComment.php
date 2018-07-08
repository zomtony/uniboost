<?php
    session_start();
    //fetch_comment.php
    $tutorPostAccount = $_SESSION['tutorPostAccount'];
	include($_SERVER['DOCUMENT_ROOT'].'/php/getPostTime.php'); 
    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
    $myconn = new createConnection(); //create new database connected
    $getPostTime = new getPostTime(); //create new database connected

    $connect = $myconn->connect();

	$currectTimeSql = $connect->prepare("SELECT now() as now");
	$currectTimeSql -> execute();
	$currectTimeResult = $currectTimeSql->fetch(PDO::FETCH_OBJ);
	$currectTime = $currectTimeResult -> now;

    $query = "SELECT * FROM User_Comment uc LEFT JOIN User_Info ui ON uc.commentSenderAccount = ui.userAccount WHERE uc.userAccount = '$tutorPostAccount'
            ORDER BY commentId DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $rowCount = $statement->rowCount();

    if($rowCount > 0){
    echo    "<div style='padding:10px;'>";
    }else{
    echo    "<div style='padding:10px;text-align:center;'>
            <h4>暂时还没有评论哦</h4>";
    }

    if(isset( $_SESSION['post_time_record'])){
        echo  "<div class='text-center' style='color: coral'>" . $_SESSION['post_time_record'] . "</div>";
        unset($_SESSION['post_time_record']);
    }

    foreach($result as $row)
    {
		$postTime = $row['date'];
        $timeAgo = $getPostTime -> timeAgo($currectTime, $postTime);
                
        echo "<div  class='row btn-margin theme-backcolor1 text-margin-bottom-comment' style='margin-left: 2%; margin-right: 2%;'>
                <table>
                    <tr>
                        <td class='text-position-top'>";
                        if($row['userLQPhotoId'] != null){
        echo               "<img class='Width rounded rating-button-margin' style='margin-left:16px;' src='data:image/jpeg;base64," . base64_encode($row['userLQPhotoId']) . "' alt='' >";
                        }else{
        echo               "<img class='Width rounded rating-button-margin' style='margin-left:16px;' src='/img/defaultLQPohotId.jpg' alt=''>";
                        }
        echo           "</td>
                        <td class='text-position-top' style='width:100%;'>";
                        if($row['userName'] != null){
                            echo "<div class='padding-left text-margin-top'><b>".$row['userName']."</b> <span class='comment-post-time'>". $timeAgo ."</span></div>";
                        }else{
                            echo "<div class='padding-left text-margin-top'><b>游客</b> <span class='comment-post-time'>". $timeAgo ."</span></div>"; 
                        }
                            echo "<div class='padding-left text-padding-bottom-right'>".$row['comment']."</div>
                        </td>
                    </tr>
                </table>         
            </div>";
    }

echo    "</div>";



?>