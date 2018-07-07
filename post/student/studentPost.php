<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');?>

<script src="/post/js/JavaScript.js" type="text/javascript"></script>

<form name='uploadPost' action='php/uploadStudentPost.php' enctype='multipart/form-data' method='POST' class='body-margin' onsubmit="return checkTutorPostInput()">
    <div class="container padding-smaill  padding-bottom-m theme-backcolor3">
        <?php
            if(isset($_SESSION['accountb'])){
                include($_SERVER['DOCUMENT_ROOT'].'/userProfile/php/processUserInfo.php'); 
                $accountb = $_SESSION['accountb'];           
                $processUserInfo = new processUserInfo();
                $result=$processUserInfo->getInfo($accountb); 
                $processUserInfo->disconnect();

                echo    "<div class='row myprofild-padding-top'>
                            <div class='col-lg-1'></div>
                            <div class='col-lg-4 text-center'> 
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style'>
                                        <label class='col-sm-2 label-position padding-small'>名字</label>
                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='userNamef' id='userNamef' placeholder='' class='form-control label-style1 table-center'  value='". $result['userName'] ."' required maxlength='15'>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style post-form-style'>
                                        <label class='col-sm-2 label-position padding-small'>电话</label>

                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='phoneNumberf' id='phoneNumberf' placeholder='' class='form-control label-style1 table-center'  value='". $result['phoneNumber'] ."' maxlength='15'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style post-form-style'>
                                        <label class='col-sm-1 label-position padding-small'>微信</label>
                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='weChatNumberf' id='weChatNumberf' placeholder='' class='form-control label-style1 table-center'  value='". $result['weChatNumber'] ."' maxlength='15'>
                                        </div>
                                    </div>
                                </div>";
            }else{
                echo    "<div class='row myprofild-padding-top'>
                            <div class='col-lg-1'></div>
                            <div class='col-lg-4 text-center'> 
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style post-form-style'>
                                        <label class='col-sm-2 label-position padding-small'>名字<font color='red'>*</font></label>
                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='userNamef' id='userNamef' placeholder='' class='form-control label-style1 table-center'  value='' required autofocus maxlength='15'>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style post-form-style'>
                                        <label class='col-sm-2 label-position padding-small'>电话</label>

                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='phoneNumberf' id='phoneNumberf' placeholder='' class='form-control label-style1 table-center'  value='' maxlength='15'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row margin-position-top'>
                                    <div class='col-md-12 form-group post-form-style post-form-style'>
                                        <label class='col-sm-1 label-position padding-small'>微信</label>
                                        <div class='col-sm-5 padding-small'>
                                            <input type='' name='weChatNumberf' id='weChatNumberf' placeholder='' class='form-control label-style1 table-center'  value='' maxlength='15'>
                                        </div>
                                    </div>
                                </div>";
            }
        echo               "<div class='row margin-position-top'>
                                <div class='col-md-12 form-group post-form-style margin-position-top'>
                                    <label class='col-sm-1 label-position padding-small'>期望价格</label>                                              
                                    <div class='col-sm-5 padding-small'>
                                        <input type='number' step='1' name='expectedPricef' id='expectedPricef' placeholder='' class='form-control label-style1 table-center'  value=''>
                                    </div>
                                </div> 
                            </div>

                            <div class='row margin-position-top'>
                                <div class='col-md-12 form-group post-form-style margin-position-top'>
                                    <label class='col-sm-1 label-position padding-small'>所需课号</label>                                              
                                    <div class='col-sm-5 padding-small'>
                                        <input type='' name='expectedCoursef' id='expectedCoursef' placeholder='' class='form-control label-style1 table-center'  value='' required maxlength='10'>
                                    </div>
                                </div> 
                            </div>

                            <div class='row margin-position-top'>
                                <div class='col-md-12 form-group post-form-style margin-position-top'>
                                    <label class='col-sm-1 label-position padding-small'>选择学校</label>                                              
                                    <div class='col-sm-5 padding-small'>
                                        <select class='form-control label-style1 form-rounded-select' name='schoolf' id='chooseSchool' style='padding-top:0px;padding-bottom:0px;'>
                                            <option value='selected'>--课程所属学校--</option>
                                            <option value='Langara'>Langara</option>
                                            <option value='UBC'>UBC</option>
                                            <option value='SFU'>SFU</option>
                                            <option value='CC'>CC</option>
                                            <option value='AC'>AC</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                        </div>   
                        
                        <div class='col-lg-6 p-word'>
                            <div class='row myprofild-padding-top '>
                                <div class='col-lg-12 text-center'>
                                    <label class='text-center' style='display: block; margin-bottom: 18px;'>请选择你的空余时间</label>
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

                            <div class='row margin-top-m text-margin-bottom-comment'>
                                <div class='col-lg-12 text-center'>
                                    <h4 class='padding-bottom-m'>补充内容</h4>
                                    <textarea name='contentf' class='form-control form-rounded' placeholder='补充内容' rows='7'></textarea>
                                </div>
                                
                            </div>
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


