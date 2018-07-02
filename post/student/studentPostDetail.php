<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small">

    
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/post/student/php/getStudentPostInfo.php'); 
        $studentPostIdb = $_GET["studentPost"];          
        $studentPostInfo = new studentPostInfo();
        $result=$studentPostInfo->getPostInfo($studentPostIdb); 
        $studentPostInfo->disconnect();

        $avaliableDay = $result['avaliableDay'];

        echo    "<div id='userProfile' class='theme-backcolor2'> 
                    <div class='row table-center'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3'>
                            <h3>". $result['userName'] ."同学</h3> 
                        </div>
                    </div>
                    <div class='row table-center'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3 padding-small'>";   
                        
                        if($result['userAccount'] == 'Guest' || $result['userAccount'] == NULL){
        echo                "<img class='rounded profile-img-size' src='/img/defaultHQPohotId.jpg' alt='photoId'/>";  
                        }else{
        echo                "<img class='rounded profile-img-size' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>";    
                        }                                                    							
        echo            "</div>    
                        <div class='col-lg-8 section-padding-left'>

                            <div class='row'>
                                <div class='col-lg-1 text-center padding-top'></div>
                                <div class='col-lg-1 text-center padding-top'>时间:</div>
                                <div class='col-lg-9 table-center'>";

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
                                <div class='col-lg-6 padding-small margin--position-top '>
            
                                    <div class='row'>

                                        <div class='col-md-12 form-group '>
                                            <label class='col-sm-3 label-position padding-small'>学校:</label>
                                            <lable class='col-sm-5 label-style text-center padding-top'>
                                                ". $result['school'] ."
                                            </lable>
                                        </div>
                                    </div>
                                    
                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <label class='col-sm-3 label-position padding-small'>时薪:</label>
                                            <div class='col-sm-5 label-style text-center padding-top'>
                                                ". $result['expectedPrice'] ."
                                            </div>
                                        </div>
                                    </div>

                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <label class='col-sm-2 label-position padding-small'>电话:</label>
                                            <div class='col-sm-5 label-style text-center padding-top'>
                                                ". $result['phoneNumber'] ."
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row '>
                                        <div class='col-md-12 form-group'>
                                            <label class='col-sm-1 label-position padding-small'>微信:</label>
                                            <div class='col-sm-5 label-style text-center padding-top'>
                                                ". $result['weChatNumber'] ."
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class='col-lg-6 padding-small margin--position-top table-center'>
                                    <div>所需课号</div>
                                    <div>
                                        <label class='label-style-course text-center label-margin' id='mondayf' >".$result['expectedCourse']."</label>
                                    </div>                                     
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class='row margin-top-s'>
                        <div class='col-sm-1 padding-small'></div>
                        <div class='col-sm-11 padding-small' >                           
                            <div class='row p-word'>
                                <div class='col-xs-12 padding-small'>
                                    <h4>学生要求</h4>
                                    <p>" . $result['content'] . "</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";


    ?>
</div>

