<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small phone-body-margin">

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
                
        if(!isset($_SESSION['accountb'])){
            echo    "<div class='container'>
                        <div class='row text-center theme-backcolor3'>
                            <h1>这里什么都没有， 请返回主页</h1>
                        </div>
                    </div>";
        }else{
            if($result['userAccount'] != $_SESSION['accountb']){
            echo    "<div class='container'>
                        <div class='row text-center theme-backcolor3'>
                            <h1>这里什么都没有， 请返回主页</h1>
                        </div>
                    </div>";
            }else{
                echo    "<div id='userProfile' class='theme-backcolor3'> 
                            <div class='row table-center'>
                                <div class='col-lg-1 padding-small'></div>
                                <div class='col-lg-3'>
                                    <h3>". $result['userName'] ."老师</h3> 
                                </div>
                                <div class='col-lg-8' style='text-align:right;padding:15px;'>
                                    <a href='/post/tutor/php/deletePost.php?tutorPost=". $tutorPostIdb . "'><input type='submit' class='btn userprofile-button-bg name-width' value='删除帖子'/></a>
                                </div>
                            </div>
                            <div class='row table-center'>
                                <div class='col-lg-1 padding-small'></div>
                                <div class='col-lg-3 padding-small'>                            
                                    <img class='rounded profile-img-size' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>                                                        							
                                </div>    
                                <div class='col-lg-8 section-padding-left' style='margin-top: 12px'>

                                    <div class='row section-padding-left'>
                                        <div class='col-lg-1 padding-right-zero'><label class='label-position padding-small iphone5-fix-margin'>时间</label></div>
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
                    
                                        ";
                                            if($result['wage'] != '' && $result['wage'] != -0.01){   
                                echo           "<div class='row '>
                                                    <div class='col-md-12 form-group inner-group profile-form-style'>
                                                        <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>时薪</label></div>
                                                        <div class='col-sm-5 inner-textfield'>
                                                            <label class='label-style text-center padding-top'>$". round($result['wage']) ."</label>
                                                        </div>
                                                    </div>
                                                </div>";
                                            }else{
                                echo           "<div class='row '>
                                                    <div class='col-md-12 form-group inner-group profile-form-style'>
                                                        <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>时薪</label></div>
                                                        <div class='col-sm-5 inner-textfield'>
                                                            <label class='label-style text-center padding-top'>面议</label>
                                                        </div>
                                                    </div>
                                                </div>";
                                            }    
                                            if(trim($result['phoneNumber']) != ''){  
                                echo            "<div class='row '>
                                                    <div class='col-md-12 form-group inner-group profile-form-style'>
                                                        <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>电话</label></div>
                                                        <div class='col-sm-5 inner-textfield'>
                                                            <label class='label-style text-center padding-top'>". $result['phoneNumber'] ."</label>
                                                        </div>
                                                    </div>
                                                </div>";
                                            }
                                            if(trim($result['weChatNumber']) != ''){  
                                echo            "<div class='row '>
                                                    <div class='col-md-12 form-group inner-group profile-form-style'>
                                                        <div class='col-sm-2 padding-small iphone5-fix-margin'><label class='label-position'>微信</label></div>
                                                        <div class='col-sm-5 inner-textfield'>
                                                            <label class='label-style text-center padding-top'>". $result['weChatNumber'] ."</label>
                                                        </div>
                                                    </div>
                                                </div>";
                                            }
                                echo    "</div>";
        
                                    if(trim($courseArray[0]) != ''){   
                            echo        "<div class='col-lg-7 padding-small table-center phone-margin'>
                                            

                                            <label style='margin-right: 6px;'>所教学校</label>
                                            <div>
                                                <label class='label-style text-center padding-top' style='background-color: #F3A8B1; margin-right: 14px;'>". $result['school'] ."</label>
                                            </div>

                                            <label style='margin-right: 10px; margin-top: 8px;'>所教课号</label>
                                            <div>";

                                            for($i = 0; $i < 3; $i++){
                                                if(isset($courseArray[$i])&&!empty($courseArray[$i])){
                                        echo        "<label class='label-style-course text-center big-text-ellipsis label-margin' id='mondayf' >".$courseArray[$i]."</label>";
                                                }
                                            }    

                                    echo    "</div>
                                            <div>";
                                            for($i = 3; $i < 6; $i++){
                                                if(isset($courseArray[$i])&&!empty($courseArray[$i])){
                                        echo        "<label class='label-style-course text-center big-text-ellipsis label-margin' id='mondayf' >".$courseArray[$i]."</label>";
                                                }
                                            }  
                                                
                                    echo    "</div>                                     
                                        </div>";
                                    }


                            echo    "</div>
                                </div>
                            </div>

                            <div class='row margin-top-s  post-detail-margin'>
                                <div class='col-sm-1 padding-small'></div>
                                <div class='col-sm-11 padding-small' >";

                                if(trim($result['briefIntroduction']) != ''){   
                echo                "<div class='row'>
                                        <div class='col-xs-1 padding-small head-width intro-margin-left'>
                                            <h4>个人简介</h4>
                                        </div>
                                        <div class='col-xs-11 padding-small margin-top-s name-width'>";
                                            $rating->showRating($ratePre, $rateValue, $rateTimes); 
                echo                    "</div>   
                                    </div>";
                                }else{
                echo            "<div class='row'>
                                    <div class='col-xs-11 padding-small margin-top-s name-width phone-center-rating'>";
                                        $rating->showRating($ratePre, $rateValue, $rateTimes); 
                echo                "</div>   
                                </div>";
                                }



                echo                "<div class='row p-word'>
                                        <div class='col-xs-11 padding-small intro-margin-left'>
                                            <pre style='margin-top: 0px;'>" . $result['briefIntroduction'] . "</pre>
                                        </div>
                                    </div>";
                                    if(trim($result['content']) != ''){ 
                        echo            "<div class='row p-word'>
                                            <div class='col-xs-11 padding-small intro-margin-left'>
                                                <h4>补充内容</h4>
                                                <p>" . $result['content'] . "</p>
                                            </div>
                                        </div>";
                                    }
                        echo    "</div>
                            </div> 
                        </div>";
            }
        }

    ?>

 </div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
