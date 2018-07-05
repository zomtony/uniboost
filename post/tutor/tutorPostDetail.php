<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small">

    <script src="/component/starRating/js/rating.js" type="text/javascript"></script>

    
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/component/starRating/rating.php'); //rating
        include($_SERVER['DOCUMENT_ROOT'].'/post/tutor/php/getTutorPostInfo.php'); 
        $tutorPostIdb = $_GET["tutorPost"];          
        $tutorPostInfo = new tutorPostInfo();
        $result=$tutorPostInfo->getPostInfo($tutorPostIdb); 
        $tutorPostInfo->disconnect();

        $rating = new rating();
        $rateValue = $result['averageRateScore'];
		$ratePre = ($rateValue/5-4/120)*100;
        $rateTimes = $result['rateNumber'];
        $avaliableDay = $result['avaliableDay'];
        $courseArray = explode("|", $result['courseNumber']);
        $_SESSION['tutorPostAccount'] = $result['userAccount'];
        
        echo    "<div id='userProfile' class='theme-backcolor3'> 
                    <div class='row table-center'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3'>
                            <h3>". $result['userName'] ."老师</h3> 
                        </div>
                    </div>
                    <div class='row table-center'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3 padding-small'>                            
                            <img class='rounded profile-img-size' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>                                                        							
                        </div>    
                        <div class='col-lg-8 section-padding-left' style='margin-top: 12px'>

                            <div class='row section-padding-left'>
                                <div class='col-lg-1 padding-right-zero'><label class='label-position padding-small'>时间</label></div>
                                <div class='col-lg-11 table-center'>";

                                if($avaliableDay[0] == 1){
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='mondayf'>星期一</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='mondayf'>星期一</label>";
                                }
                                    
                                if($avaliableDay[1] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='tuesdayf'>星期二</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='tuesdayf'>星期二</label>";
                                }
                                    
                                if($avaliableDay[2] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='wednesdayf'>星期三</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='wednesdayf'>星期三</label>";
                                }
                                    
                                if($avaliableDay[3] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='thuesdayf'>星期四</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='thuesdayf'>星期四</label>";
                                }
                                    

                                if($avaliableDay[4] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='fridayf'>星期五</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='fridayf'>星期五</label>";
                                }
                                    

                                if($avaliableDay[5] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='saturdayf'>星期六</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='saturdayf'>星期六</label>";
                                }
                                    

                                if($avaliableDay[6] == 1){    
                                    echo "<label class='label-style-time text-center avaTime-bg label-margin' id='sundayf'>星期天</label>";
                                }else{
                                    echo "<label class='label-style-time text-center notAvaTime-bg label-margin' id='sundayf'>星期天</label>";
                                }
                                    
                                
                    echo        "</div>           
                            </div>

                            <div class='row margin-top-m section-padding-left'>
                                <div class='col-lg-5 padding-small margin--position-top '>
            
                                    <div class='row'>

                                        <div class='col-md-12 form-group '>
                                            <div class='col-sm-2 padding-small'><label class='label-position'>学校</label></div>
                                            <div class='col-sm-5' >
                                                <label class='label-style text-center padding-top' style='background-color: #F3A8B1;'>". $result['school'] ."</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <div class='col-sm-2 padding-small'><label class='label-position'>时薪</label></div>
                                            <div class='col-sm-5'>
                                                <label class='label-style text-center padding-top'>". $result['wage'] ."</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <div class='col-sm-2 padding-small'><label class='label-position'>电话</label></div>
                                            <div class='col-sm-5'>
                                                <label class='label-style text-center padding-top'>". $result['phoneNumber'] ."</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <div class='col-sm-2 padding-small'><label class='label-position'>微信</label></div>
                                            <div class='col-sm-5'>
                                                <label class='label-style text-center padding-top'>". $result['weChatNumber'] ."</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>";
 
                            if($courseArray[0] != ''){   
                    echo        "<div class='col-lg-7 padding-small text-margin-top table-center'>
                                    <div><label class='label-position padding-small'>所教课号</label></div>
                                    <div>";

                                    for($i = 0; $i < 3; $i++){
                                        if(isset($courseArray[$i])&&!empty($courseArray[$i])){
                                echo        "<label class='label-style-course text-center label-margin' id='mondayf' >".$courseArray[$i]."</label>";
                                        }
                                    }    

                            echo    "</div>
                                    <div>";
                                    for($i = 3; $i < 6; $i++){
                                        if(isset($courseArray[$i])&&!empty($courseArray[$i])){
                                echo        "<label class='label-style-course text-center label-margin' id='mondayf' >".$courseArray[$i]."</label>";
                                        }
                                    }  
                                          
                            echo    "</div>                                     
                                </div>";
                            }


                    echo    "</div>
                        </div>
                    </div>

                    <div class='row margin-top-s '>
                        <div class='col-sm-1 padding-small'></div>
                        <div class='col-sm-11 padding-small' >
                            <div class='row'>
                                <div class='col-xs-1 padding-small head-width intro-margin-left'>
                                    <h4>个人简介</h4>
                                </div>
                                <div class='col-xs-11 padding-small margin-top-s name-width'>";
                                    $rating->showRating($ratePre, $rateValue, $rateTimes); 
                echo            "</div>   
                            </div>
                            <div class='row p-word'>
                                <div class='col-xs-11 padding-small intro-margin-left'>
                                    <p>" . $result['briefIntroduction'] . "</p>
                                </div>
                            </div>
                            <div class='row p-word'>
                                <div class='col-xs-11 padding-small intro-margin-left'>
                                    <h4>内容</h4>
                                    <p>" . $result['content'] . "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='row'>
                    <div class='col-xs-1 padding-small'></div>                   
                    <div class='col-xs-5' style='margin-top:10px;padding-left:0px;'><h4 style='margin-right:0px;'>学生评论</h4></div>  
                    <div class='col-xs-5 TimeFontAlign'> 
                        <button class='btn userprofile-button-bg rating-button-margin button-width button-text' style='margin-right:0px;margin-left:0px;' type='button' data-toggle='modal' data-target='#myModal'>写评论</button>
                    </div>
                    <div class='col-xs-1 padding-small'></div>   
                </div>

                <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></button>
                                <h4 class='modal-title' id='myModalLabel'>我的评价</h4>
                            </div>
                            <div class='modal-body'>";    
                                $rating->userRating();
                
                echo       "</div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>取消</button>
                                <button type='button' class='btn btn-primary' onclick='userSubmit()' data-dismiss='modal'>确定</button>
                            </div>
                        </div>
                    </div>
                </div>";

    ?>
    <div class='row theme-backcolor3'>
        <div class='col-lg-1 padding-small'></div>
        <div class='col-lg-10 text-margin-top'>
            <?php include($_SERVER['DOCUMENT_ROOT'].'/component/comment/comment.php'); ?>
        </div>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
