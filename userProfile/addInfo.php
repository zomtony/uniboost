<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small phone-body-margin">
    <script src='/component/crop/js/croppie.js'></script>
	<link href='/component/crop/css/croppie.css' rel='stylesheet' />
   
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
        include($_SERVER['DOCUMENT_ROOT'].'/userProfile/php/processUserInfo.php'); 
    echo    "<div class='row text-center'>
                <h3>完善个人资料</h3>
            </div>
            <div class='theme-backcolor3'>

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

                <div class='row' style='text-align:right;padding:15px;'>
                    <a href='/index.php'><input type='submit' class='btn userprofile-button-bg name-width' value='跳过'/></a>
                </div>
                <form name='signupForm' action='php/passData.php' enctype='multipart/form-data' method='POST'>
                    <div class='row myprofild-padding-top'>

                        <div class='col-md-4 text-center'>
                            <img class='rounded profile-img-size' name='photoId' id='photoId' src='/img/defaultHQPhotoId.jpg' alt='userpic'/>  
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
                                        <input type='' name='userNamef' id='userNamef' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='红领巾' maxlength='15'>
                                    </div>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-md-12 form-group inner-group flexbox-center'>
                                    <label class='col-sm-2 label-position padding-small text-center'>电话</label>                                              
                                    <div class='col-sm-5 inner-textfield'>
                                        <input type='' name='phonef' id='phonef' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='' maxlength='15'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 form-group inner-group flexbox-center'>
                                    <label class='col-sm-2 label-position padding-small text-center'>微信</label>                                               									
                                    <div class='col-sm-5 inner-textfield'>
                                        <input type='' name='wechatf' id='wechatf' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='' maxlength='30'>
                                    </div>
                                </div>
                            </div>    
                            
                            <div class='row'>
                                <div class='col-md-12 form-group inner-group flexbox-center'>
                                    <label class='col-sm-2 label-position padding-small text-center'>邮箱</label>                                               									
                                    <div class='col-sm-5 inner-textfield'>
                                        <input type='email' name='emailf' id='emailf' placeholder='' class='form-control label-info-position margin-left-zero label-style1'  value='' maxlength='30'>
                                    </div>
                                </div>
                            </div>  
                            
                        </div>                    
                    </div>

                    <div class='row textArea-width' style='margin-top: 15px;'>
                            <h4>个人简介</h4>
                            <textarea name='briefIntroductionf' class='form-control' placeholder='编辑你的个人简介' rows='5'></textarea>
                    </div>

                    <div class='row' style='text-align:right;padding:15px;'>				
                            <input type='submit' id='btnSubmit' class='btn userprofile-button-bg name-width' style='background: #8CCE44;' value='完成' onclick='cleanInput()'/>
                    </div>
                
                </form>
            
            </div>";
    ?>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
