<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>

<div class="container padding-small">

    
    <?php
        include($_SERVER['DOCUMENT_ROOT'].'/post/student/php/getStudentPostInfo.php'); 
        $studentPostIdb = $_GET["studentPost"];          
        $studentPostInfo = new studentPostInfo();
        $result=$studentPostInfo->getPostInfo($studentPostIdb); 
        $studentPostInfo->disconnect();

        $avaliableDay = $result['avaliableDay'];

        echo    "<div id='userProfile' class='theme-backcolor3'> 
                    <div class='row table-center'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3'>
                            <h3>". $result['userName'] ."同学</h3> 
                        </div>
                    </div>
                    <div class='row table-center' style='padding-bottom:20px;'>
                        <div class='col-lg-1 padding-small'></div>
                        <div class='col-lg-3 padding-small'>";   
                        
                        if($result['userAccount'] == 'Guest' || $result['userAccount'] == NULL){
        echo                "<img class='rounded profile-img-size' src='/img/defaultHQPohotId.jpg' alt='photoId'/>";  
                        }else{
        echo                "<img class='rounded profile-img-size' src='data:image/jpeg;base64," . base64_encode($result['userHQPhotoId']) . "'alt='userpic'/>";    
                        }                                                    							
        echo            "</div>    
                        <div class='col-lg-8 section-padding-left' style='margin-top: 12px'>

                            <div class='row section-padding-left'>
                                <div class='col-md-12 form-group '>
                                    <div class='col-sm-1 padding-small'>
                                        <label class='label-position'>时间
                                    </div>
                                    <div class='col-sm-9 table-center'>";

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
                                        
                                
                    echo            "</div>
                                </div>           
                            </div>

                            <div class='row margin-top-m section-padding-left'>
                                <div class='col-lg-6 padding-small margin--position-top '>
            
                                    <div class='row'>

                                        <div class='col-md-12 form-group '>
                                            <div class='col-sm-2 padding-small'><label class='label-position'>学校</label></div>
                                            <div class='col-sm-5'>
                                                <label class='label-style text-center padding-top' style='background-color: #F3A8B1;'>
                                                    ". $result['school'] ."
                                                </lable>
                                            </div>
                                        </div>
                                    </div>";

                                    if($result['expectedPrice'] != '' && $result['expectedPrice'] != 0.00){ 
                        echo            "<div class='row '>
                                            <div class='col-md-12 form-group'>
                                                <div class='col-sm-2 padding-small'><label class='label-position'>期望价</label></div>
                                                <div class='col-sm-5'>
                                                    <label class='label-style text-center padding-top'>$
                                                        ". $result['expectedPrice'] ."
                                                    </lable>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    if($result['phoneNumber'] != ''){ 
                        echo            "<div class='row '>
                                            <div class='col-md-12 form-group'>
                                                <div class='col-sm-2 padding-small'><label class='label-position'>电话</label></div>
                                                <div class='col-sm-5'>
                                                    <label class='label-style text-center padding-top'>
                                                        ". $result['phoneNumber'] ."
                                                    </lable>
                                                </div>
                                            </div>
                                        </div>";
                                    }

                                    if($result['weChatNumber'] != ''){ 
                        echo            "<div class='row '>
                                            <div class='col-md-12 form-group'>
                                                <div class='col-sm-2 padding-small'><label class='label-position'>微信</label></div>
                                                <div class='col-sm-5'>
                                                    <label class='label-style text-center padding-top'>
                                                        ". $result['weChatNumber'] ."
                                                    </lable>
                                                </div>
                                            </div>
                                        </div>";
                                    }
                                    
                        echo    "</div>";

                            if($result['expectedCourse'] != ''){ 
                    echo        "<div class='col-lg-6 padding-small margin--position-top table-center'>
                                    <div><label class='label-position'>所需课号</label></div>
                                    <div>
                                        <label class='label-style-course text-center label-margin' id='mondayf' >".$result['expectedCourse']."</label>
                                    </div>                                     
                                </div>";
                            }
                    echo    "</div>

                        </div>
                    </div>";

                if($result['content'] != ''){
        echo        "<div class='row'>
                        <div class='col-sm-1 padding-small'></div>
                        <div class='col-sm-11 padding-small' >                           
                            <div class='row p-word'>
                                <div class='col-xs-12 padding-small'>
                                    <h4>学生要求</h4>
                                    <p>" . $result['content'] . "</p>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
        echo    "</div>";


    ?>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
