
<?php 
    include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
    if(isset($_POST["chooseSchool"])){
        $_SESSION['chooseSchool'] = $_POST["chooseSchool"];
    }
    if(isset($_POST["choosePostType"])){
        $_SESSION['choosePostType'] = $_POST['choosePostType'];
    }
    if(isset($_POST["keyWords"])){
        $_SESSION['keyWords'] = trim($_POST["keyWords"]);
    }
?>

    <div class="container">       
        <div class="carousel slide multi-item-carousel" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
            <div class="carousel-inner">
<!-- 1 -->
                <section class="item active">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor1.jpg" class="img-zoom imgSize"  alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 2 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor2.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 3 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor3.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 4 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor4.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 5 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor5.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 6 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor6.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
<!-- 7 -->
                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutors/tutor7.jpg" class="img-zoom" alt = "">
                            </a>
                        </div>
                    </div>
                </section>
            </div>

            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        </div> 
        <!-- Alter width and notice how this behaves -->
        <div class="row" style="padding-top: 12px; padding-bottom: 4px">
            <div class="TimeFontAlign padding-right-zero phone-post-button">   
                
                <?php                   
                        if(isset($_SESSION['accountb'])){
                            echo "<a href='/post/tutor/tutorPost.php'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>发帖教学生</button></a>";
                        }else{
                            echo "<a href='signin_out_up/signin.php?info=Tutor需要有个账户哦'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>发帖教学生</button></a>";    
                        }
                ?> 
                <a href='/post/student/studentPost.php' style='margin-left: 4px;'><button type="button" class="btn btn-margin btn-margin theme-button text-color">发帖找老师</button></a>

            </div>

            <div class="col-lg-8 padding-small">                                      
                <form class="navbar-form padding-small" role="search" action="index.php" method="POST">
                    <?php
                        if(isset($_SESSION['choosePostType'])){
                echo        "<select class='form-control' name='choosePostType' id='choosePostType'>";
                                if($_SESSION['choosePostType'] == 'teacher'){
                        echo        "<option value='teacher' selected>只看老师</option>";
                                }else{
                        echo        "<option value='teacher'>只看老师</option>";                
                                }
                                if($_SESSION['choosePostType'] == 'student'){
                        echo        "<option value='student' selected>只看学生</option>";
                                }else{
                        echo        "<option value='student'>只看学生</option>";   
                                }
                echo        "</select>"; 
                        }else{
                echo        "<select class='form-control' name='choosePostType' id='choosePostType'>
                                <option value='teacher'>只看老师</option>
                                <option value='student'>只看学生</option>
                            </select>";                            
                        }


                        if(isset($_SESSION['chooseSchool'])){
                echo        " <select class='form-control' name='chooseSchool' id='chooseSchool'>
                                <option value='selected'>--选择学校--</option>";
                                if($_SESSION['chooseSchool'] == 'Langara'){
                echo                "<option value='Langara' selected>Langara</option>";
                                }else{
                echo                "<option value='Langara'>Langara</option>";
                                }
                                if($_SESSION['chooseSchool'] == 'UBC'){
                echo                "<option value='UBC' selected>UBC</option>";
                                }else{
                echo                "<option value='UBC'>UBC</option>";
                                }
                                if($_SESSION['chooseSchool'] == 'SFU'){
                echo                "<option value='SFU' selected>SFU</option>";
                                }else{
                echo                "<option value='SFU'>SFU</option>";
                                }
                                if($_SESSION['chooseSchool'] == 'CC'){
                echo                "<option value='CC' selected>CC</option>";
                                }else{
                echo                "<option value='CC'>CC</option>";
                                }  
                                if($_SESSION['chooseSchool'] == 'AC'){
                echo                "<option value='AC' selected>AC</option>";
                                }else{
                echo                "<option value='AC'>AC</option>";
                                }  
                                if($_SESSION['chooseSchool'] == 'OTHERS'){
                echo                "<option value='OTHERS' selected>其他</option>";
                                }else{
                echo                "<option value='OTHERS'>Ohters</option>";
                                }  
                echo            "</select>";
                        }else{
                echo        "<select class='form-control maingpage-button school-choose-select' name='chooseSchool' id='chooseSchool'>
                                <option value='selected'>--选择学校--</option>
                                <option value='Langara'>Langara</option>
                                <option value='UBC'>UBC</option>
                                <option value='SFU'>SFU</option>
                                <option value='CC'>CC</option>
                                <option value='AV'>AC</option>
                            </select>";         
                        }

                echo    "<div class='input-group maingpage-button' style='margin-top:1px;'>";   
                        if(isset($_SESSION['keyWords'])){
                echo        "<input type='text' class='form-control' placeholder='搜索' name='keyWords' id='keyWords' value='" . $_SESSION['keyWords'] . "'>";
                        }else{
                echo        "<input type='text' class='form-control' placeholder='搜索' name='keyWords' id='keyWords'>";
                        }
                echo        "<div class='input-group-btn'>
                                <button class='btn theme-button site-btn' type='submit' name='submit' onclick='saveInfo()'><span class='search-button-padding text-color'>搜索</span><i class='glyphicon glyphicon-search text-color'></i></button>
                            </div>
                        </div>";
                    ?>
                </form> 
            </div>
        </div>

        <div>
                      
            <?php                   
                if(isset($_POST['submit'])){  
                    
                    if($_POST['choosePostType'] == 'student'){
                        include($_SERVER['DOCUMENT_ROOT'].'/post/student/studentPostList.php'); 
                    }else{
                        include($_SERVER['DOCUMENT_ROOT'].'/post/tutor/tutorPostList.php'); 
                    }

                }else{
                    if(!isset($_SESSION['choosePostType'])){   
                        include($_SERVER['DOCUMENT_ROOT'].'/post/tutor/tutorPostList.php'); 
                    }elseif($_SESSION['choosePostType'] == 'teacher'){
                        include($_SERVER['DOCUMENT_ROOT'].'/post/tutor/tutorPostList.php');
                    }else{
                        include($_SERVER['DOCUMENT_ROOT'].'/post/student/studentPostList.php');
                    }
                }
            ?>                         
        </div> 
        
    </div>

<script src="/js/mainpage.js" type="text/javascript"></script>
<div class="height-div"></div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
