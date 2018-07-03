<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');?>

<script src="/post/js/JavaScript.js" type="text/javascript"></script>

<form name='uploadPost' action='php/uploadTutorPost.php' enctype='multipart/form-data' method='POST' class='body-margin' onsubmit="return checkTutorPostInput()">
    <div class="container theme-backcolor3">
        <?php
            include($_SERVER['DOCUMENT_ROOT'].'/userProfile/php/processUserInfo.php'); 
            $accountb = $_SESSION['accountb'];           
            $processUserInfo = new processUserInfo();
            $result=$processUserInfo->getInfo($accountb); 
            $processUserInfo->disconnect();
            $count = 0;
            echo    "<div class='row myprofild-padding-top'>
                        <div class='col-lg-1'></div>
                        <div class='col-lg-4'> 
                            <div class='row margin-top-m padding-bottom-m margin-position-top'>
                                <div class='col-sm-2 padding-small table-center'><label class='label-position'>名字</label></div>
                                <div class='col-sm-5 padding-small'>
                                    <input type='' name='userNamef' id='userNamef' placeholder='' class='form-control label-style1 table-center'  onclick='infoChangeName()' value='". $result['userName'] ."' readonly>
                                </div>
                            </div>
                            
                            <div class='row margin-position-top padding-bottom-m margin-position-top'>
                                <div class='col-sm-2 padding-small table-center'><label class='label-position padding-small'>电话</label></div>
                                <div class='col-sm-5 padding-small '>
                                    <input type='' name='phoneNumberf' id='phoneNumberf' placeholder='' class='form-control label-style1 table-center'  value='". $result['phoneNumber'] ."'>
                                    
                                </div>
                            </div>
                            <div class='row margin-position-top padding-bottom-m'>
                                <div class='col-sm-2 padding-small table-center'><label class='label-position padding-small'>微信</label></div>
                                <div class='col-sm-5 padding-small '>
                                    <input type='' name='weChatf' id='weChatf' placeholder='' class='form-control label-style1 table-center'  value='". $result['weChatNumber'] ."'>
                                    
                                </div>
                            </div>

                            <div class='row margin-position-top padding-bottom-m'>
                                <div class='col-sm-2 padding-small table-center'><label class='label-position padding-small'>时薪</label></div>                                              
                                <div class='col-sm-5 padding-small '>
                                    <input type='number' step='.01' name='wagef' id='wagef' placeholder='' class='form-control label-style1 table-center'  value=''>
                                </div>
                            </div>
                            <div class='row margin-position-top padding-bottom-m'>
                                <div class='col-sm-2 padding-small table-center'><label class='label-position padding-small'>学校</label></div>                                               
                                <div class='col-sm-5 padding-small'>
                                    <select class='form-control form-rounded-select' name='schoolf' id='chooseSchool'>
                                        <option value='selected'>--选择学校--</option>
                                        <option value='Langara'>Langara</option>
                                        <option value='UBC'>UBC</option>
                                        <option value='SFU'>SFU</option>
                                        <option value='CC'>CC</option>
                                        <option value='AC'>AC</option>
                                    </select>
                                </div>
                            </div>

                        </div>   
                        
                        <div class='col-lg-5 p-word text-margin-top'>
                            <h4>个人简介</h4> 
                            <textarea name='briefIntroductionf' class='form-control form-rounded' rows='5' > " . $result['briefIntroduction'] . " </textarea>

                                    <button class='btn button-add-course-button add-more margin--position-top button-width button-margin-left form-rounded button-course margin-position-top' type='button'>
                                        继续添加
                                    </button>
                                    
                                    <div class='input-group control-group after-add-more  clean-input-group-display'>
        
                                </div>

                                <div class='row'>
                                    <div class='copy-fields hide'>";
                                        $count++;
                    echo                "<div class='col-lg-4 course-input-padding'> <input type='text' name='courseArrayf[]' id='courseArrayf". $count ."' class='form-control form-rounded' placeholder='输入所教课号'>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class='col-lg-2'></div>
                    </div>

                    <div class='row myprofild-padding-top '>
                        <div class='col-lg-1'></div>
                        <div class='col-lg-11 '>
                            <div class='row'>
                                <div class='col-sm-2 padding-small table-center'>
                                    <label class='label-position time-text-width'>请选择你的空余时间:</label>
                                </div>
                                <div class='col-sm-10 table-center'>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='mondayf' type='button' onclick='setValueForMonday()'>星期一</button>
                                    <input type='hidden' id='monday' name='mondayf' value='0'/>    
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='tuesdayf' type='button' onclick='setValueTuesday()'>星期二</button>
                                    <input type='hidden' id='tuesday' name='tuesdayf' value='0'/>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='wednesdayf' type='button' onclick='setValueForWednesday()'>星期三</button>
                                    <input type='hidden' id='wednesday' name='wednesdayf' value='0'/>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='thursdayf' type='button' onclick='setValueForThursday()'>星期四</button>
                                    <input type='hidden' id='thursday' name='thursdayf' value='0'/>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='fridayf' type='button' onclick='setValueForFriday()'>星期五</button>
                                    <input type='hidden' id='friday' name='fridayf' value='0'/>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='saturdayf' type='button' onclick='setValueForSaturday()'>星期六</button>
                                    <input type='hidden' id='saturday' name='saturdayf' value='0'/>
                                    <button class='btn button-bg course-input-padding avaliabletime-margin-top margin-right-s button-style-time' id='sundayf' type='button' onclick='setValueForSunday()'>星期天</button>
                                    <input type='hidden' id='sunday' name='sundayf' value='0'/>
                                </div> 
                            </div>
                        </div>           
                    </div>
                    
                    
                    
                    <div class='row padding-bottom-m'>
                        <div class='col-lg-1'></div>
                        <div class='col-lg-10'>
                            <h4>补充内容</h4>
                            <textarea name='contentf' class='form-control form-rounded' placeholder='补充内容' rows='5'></textarea>
                        </div>
                        <div class='col-lg-1'></div>
                    </div>";
                    
                    
                    


        ?>
    </div>
    <div class='row padding-bottom-m margin-position-top'>				
        <div class='col-lg-12 text-center margin--position-top'>
            <input type='submit' id='btnSubmit' class='btn button-upload-post-button' value='发布帖子'/>
        </div>
    </div>
</form>
