<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small phone-body-margin">
    <script src='/component/crop/js/croppie.js'></script>
	<link href='/component/crop/css/croppie.css' rel='stylesheet' />
   
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
        include($_SERVER['DOCUMENT_ROOT'].'/userProfile/php/processUserInfo.php'); 
        $accountb = $_GET["accountb"];           
        $processUserInfo = new processUserInfo();
        $result=$processUserInfo->getInfo($accountb); 
        $processUserInfo->disconnect();

        $rating = new rating();
        $rateValue = $result['averageRateScore'];
		$ratePre = ($rateValue/5-4/120)*100;
		$rateTimes = $result['rateNumber'];
        $_SESSION['tutorPostAccount'] = $result['userAccount'];

    echo    "<div class='theme-backcolor3'>
                <div id='userProfile'>  
                    <div class='row myprofild-padding-top table-center'>
                        <div class='col-lg-1'></div>
                        <div class='col-lg-3'> 
                            <img class='rounded profile-img-size' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>                                                        							
                        </div>    
                    
                        <div class='col-lg-4  margin-position-top section-padding-left'>
            
                            <div class='row'>

                                <div class='col-md-12 form-group profile-form-style inner-group'>
                                    <div class='col-sm-1' ></div>
                                    <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>名字</label></div>
                                    <div class='col-sm-5 inner-textfield' >
                                        <label class='label-style text-center padding-top'>". $result['userName'] ."</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class='row '>
                                <div class='col-md-12 form-group profile-form-style inner-group'>
                                    <div class='col-sm-1' ></div>
                                    <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>电话</label></div>
                                    <div class='col-sm-5 inner-textfield' >
                                        <label class='label-style text-center padding-top'>". $result['phoneNumber'] ."</label>
                                    </div>
                                </div>
                            </div>
                            <div class='row '>
                                <div class='col-md-12 form-group profile-form-style inner-group'>
                                    <div class='col-sm-1' ></div>
                                    <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>微信</label></div>
                                    <div class='col-sm-5 inner-textfield' >
                                        <label class='label-style text-center padding-top'>". $result['weChatNumber'] ."</label>
                                    </div>
                                </div>
                            </div>
                            
                        </div>   
                        
                        <div class='col-lg-4 p-word'>
                                <h4>个人简介</h4> 
                                <p>" . $result['briefIntroduction'] . "</p>
                        </div>
                    </div>
                </div>

                <div id='uploadimageModal' class='modal' role='dialog'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            <h4 class='modal-title'>剪裁头像</h4>
                        </div>
                        <div class='text-center'>
                            <div id='image' style='margin-top:auto'></div>
                            <button type='button' class='btn btn-default crop_image' style='margin-bottom:20px;'>确定</button>
                            <button type='button' class='btn btn-default' data-dismiss='modal' style='margin-bottom:20px;'>取消</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='changeProfile'>
                    <form name='signupForm' action='php/passData.php' enctype='multipart/form-data' method='POST'>
                        <div class='row myprofild-padding-top'>

                            <div class='col-md-4 text-center'>
                                <img class='rounded profile-img-size' name='photoId' id='photoId' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>  
                                <div id='uploaded_image'></div>
                                <div>
                                    <span class='btn btn-default btn-file margin-position-top'>                                                      						
                                        选择头像<input type='file' name='upload_image' id='upload_image' accept='image/x-png,image/gif,image/jpeg'/>
                                    </span>
                                </div>
                            </div>
                  
                            <div class='col-md-4 margin-position-top padding-small'>
                                <div class='row'>
                                    <div class='col-md-12 form-group inner-group flexbox-center'>
                                        <label class='col-sm-2 label-position padding-small text-center'>名字</label>                                              
                                        <div class='col-sm-5 inner-textfield'>
                                            <input type='' name='userNamef' id='userNamef' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='" . $result['userName'] . "'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 form-group inner-group flexbox-center'>
                                        <label class='col-sm-2 label-position padding-small text-center'>电话</label>                                              
                                        <div class='col-sm-5 inner-textfield'>
                                            <input type='' name='phonef' id='phonef' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='" . $result['phoneNumber'] . "'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-md-12 form-group inner-group flexbox-center'>
                                        <label class='col-sm-2 label-position padding-small text-center'>微信</label>                                               									
                                        <div class='col-sm-5 inner-textfield'>
                                            <input type='' name='wechatf' id='wechatf' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='" . $result['weChatNumber'] . "'>
                                        </div>
                                    </div>
                                </div>                           
                            </div> 
                            
                        </div>

                        <div class='row textArea-width' style='margin-top: 15px;'>
                                <h4>个人简介</h4>
                                <textarea name='briefIntroductionf' class='form-control' placeholder='编辑你的个人简介' rows='5'>" . $result['briefIntroduction'] ."</textarea>
                        </div>

                        <div class='row'>				
                            <div class='col-lg-12 text-center margin-position-top' style='margin-top: 10px; margin-bottom: 10px'>
                                <button onclick='editMyProfile()' type='button' class='btn btn-margin btn-margin userprofile-button-bg'>返回个人信息</button>
                                <input type='submit' id='btnSubmit' class='btn userprofile-button-bg' value='完成修改' onclick='cleanInput()'/>
                            </div>
                        </div>
                    
                    </form>
                </div>";
                


        echo    "<div class='row myprofild-padding-top' id='edit-Profile'>
                    <div class='col-md-12 form-group text-center'>					 
                        <button onclick='editMyProfile()' type='button' class='btn btn-margin userprofile-button-bg'>编辑信息</button>                            
                        <a href='/userProfile/myPostList.php?accountb=$accountb'><button type='button' class='btn btn-margin userprofile-button-bg' style='margin-left: 6px'>查看帖子</button></a>

                    </div>
                </div>
            </div>        
        
                <div class='row'>
                    <div class='col-xs-1 padding-small'></div>
                    <div class='col-xs-2 padding-small my-rating-mess padding-left'><label class='btn'><h4>学生留言</h4></label></div>
                    <div class='col-xs-4 padding-small margin-position-top'>";
                        $rating->showRating($ratePre, $rateValue, $rateTimes);    
                                        
        echo        "</div>
                
                </div>";
    ?>
    
    <div class='theme-backcolor3'>
        <?php include($_SERVER['DOCUMENT_ROOT'].'/component/comment/comment.php'); ?>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
