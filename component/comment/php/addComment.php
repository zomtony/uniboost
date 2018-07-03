<?php
    
    //add_comment.php
    include($_SERVER['DOCUMENT_ROOT'].'/php/createConnection.php'); //database connected
    $myconn = new createConnection(); //create new database connected
    $connect = $myconn->connect();

    session_start();
    $tutorPostAccountb = $_SESSION['tutorPostAccount'];
    $error = '';
    if(isset($_SESSION['accountb'])){
        $commentSenderAccountb = $_SESSION['accountb'];
    }else{
        $commentSenderAccountb = "GUEST";
    }
    $comment_content = '';

    if(empty($_POST["comment_content"])){
        $error .= '<p class="text-danger">Comment is required</p>';
    }else{
        $comment_content = $_POST["comment_content"];
    }

    if($error == ''){
        $query = "INSERT INTO User_Comment 
                (userAccount, comment, commentSenderAccount) 
                VALUES (:userAccountb, :comment, :commentSenderAccountb)";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
            ':userAccountb' => $tutorPostAccountb,
            ':comment'    => $comment_content,
            ':commentSenderAccountb' => $commentSenderAccountb
            )
        );
        $error = '<label class="text-success">Comment Added</label>';
    }

    $data = array(
        'error'  => $error
    );

    echo json_encode($data);

?>