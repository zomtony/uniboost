<?php

//fetch_comment.php

include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
$myconn = new createConnection(); //create new database connected
$connect = $myconn->connect();

$query = "SELECT * FROM User_Comment uc LEFT JOIN User_Info ui ON uc.commentSenderAccount = ui.userAccount
        ORDER BY commentId DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
foreach($result as $row)
{


     
    echo "<div  class='row btn-margin theme-backcolor1 text-margin-bottom-comment'>
            <table>
                <tr>
                    <td class='text-position-top'>";
                    if($row['userLQPhotoId'] != null){
    echo               "<img class='Width rounded rating-button-margin' style='margin-left:16px;' src='data:image/jpeg;base64," . base64_encode($row['userLQPhotoId']) . "' alt='' >";
                    }else{
    echo               "<img class='Width rounded rating-button-margin' style='margin-left:16px;' src='/img/defaultLQPohotId.jpg' alt=''>";
                    }
    echo           "</td>
                    <td class='text-position-top'>";
                    if($row['userName'] != null){
                        echo "<div class='padding-left text-margin-top'><b>".$row['userName']."</b> on <span class='td-post-time'>".$row['date']."</span></div>";
                    }else{
                        echo "<div class='padding-left text-margin-top'><b>游客</b> on <span class='td-post-time'>".$row['date']."</span></div>"; 
                    }
                        echo "<div class='padding-left text-padding-bottom-right'>".$row['comment']."</div>
                    </td>
                </tr>
            </table>         
        </div>";
}



?>