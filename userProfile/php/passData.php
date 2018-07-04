<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'].'/userProfile/php/processUserInfo.php'); 
    $accountb=$_SESSION['accountb'];
    $phoneb=$_POST['phonef'];
    $wechatb=$_POST['wechatf'];
    $userNameb=$_POST['userNamef'];
    $briefIntroductionb=$_POST['briefIntroductionf'];
    if(!empty($_FILES['file']['name'])){
        $filename = $_FILES['file']['name'];
        $ext = explode( ".", $filename);

        $image_path = $_FILES['file']['tmp_name'];
        $info = getimagesize($_FILES['file']['tmp_name']);
        
        $ext = strtolower(end($ext));

        $userHQPhotoIdb = compress($info, $image_path, 300, 300);
        $HQPhotoIdb= 'photos_'.uniqid(mt_rand(10, 15)).'_'.time().'_300x300.'.$ext;
        imagejpeg($userHQPhotoIdb, $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$HQPhotoIdb, 100);
        $contentHQPhotoIdb=addslashes(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$HQPhotoIdb));
        imagedestroy($userHQPhotoIdb);

        $userLQPhotoIdb = compress($info, $image_path, 60, 60);
        $LQPhotoIdb = 'photos_'.uniqid(mt_rand(10, 15)).'_'.time().'_60x60.'.$ext;
        imagejpeg($userLQPhotoIdb, $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$LQPhotoIdb, 100);
        $contentLQPhotoIdb=addslashes(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$LQPhotoIdb));
        imagedestroy($userLQPhotoIdb);

        $LQPhotoIdNav = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$LQPhotoIdb);       
    }else{
        $contentHQPhotoIdb='';
        $contentLQPhotoIdb='';
    }

    $processUserInfo = new processUserInfo();
    $count = 0;
    $count = $processUserInfo->updataInfo($accountb, $userNameb, $phoneb, $wechatb, $briefIntroductionb, $contentHQPhotoIdb, $contentLQPhotoIdb, $LQPhotoIdNav); 

    if($count > 0 ){
        $processUserInfo->disconnect();
        header("Location: ../userProfile.php?accountb=$accountb");
    }else{
        $processUserInfo->disconnect();
        header("Location: ../userProfile.php?accountb=$accountb&info=no change");
    } 


    function compress($info, $image_path, $resizeWidth, $resizeHeight) {
        $sourceImageWidth = $info[0];
        $sourceImageHeight = $info[1];

        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($image_path);
    
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($image_path);
    
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($image_path);
    
        $imResize = imagecreatetruecolor($resizeWidth,$resizeHeight);
        imagecopyresampled($imResize,$image , 0,0,0,0,$resizeWidth,$resizeHeight,$sourceImageWidth,$sourceImageHeight);    
        return $imResize;
    }
    
?>