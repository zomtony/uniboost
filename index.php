
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');?>
    <div class="container">       
        <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="myCarousel">
            <div class="carousel-inner">
                <section class="item active">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutor.jpg" class="img-zoom imgSize"  alt = "">
                            </a>
                        </div>
                    </div>
                </section>

                <section class="item">
                    <div class="col-md-2 col-sm-6 col-xs-12 rollImagePosition imgSize">
                        <div class=img-box>
                            <a href="">
                                <img src="img/tutor.jpg" class="img-zoom" alt = "">
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
            <div class="TimeFontAlign padding-right-zero" style="float: right;">   
                
                <?php                   
                        if(isset($_SESSION['accountb'])){
                            echo "<a href='/post/tutor/tutorPost.php'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>发帖教学生</button></a>";
                        }else{
                            echo "<a href='signin_out_up/signin.php?info=请登陆先，然后再发老师帖。'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>发帖教学生</button></a>";    
                        }
                ?> 
                <a href='/post/student/studentPost.php'><button type="button" class="btn btn-margin btn-margin theme-button text-color" style="margin-left: 4px;">发帖找老师</button></a>

            </div>

            <div class="col-lg-8 padding-small">                                      
                <form class="navbar-form padding-small" role="search" action="index.php" method="POST">

                    <select class="form-control" name="choosePostType" id="choosePostType">
                        <option value="teacher">只看老师</option>
                        <option value="student">只看学生</option>
                    </select> 
                    <select class="form-control" name="chooseSchool" id="chooseSchool">
                        <option value="selected">--选择学校--</option>
                        <option value="Langara">Langara</option>
                        <option value="UBC">UBC</option>
                        <option value="SFU">SFU</option>
                        <option value="CC">CC</option>
                        <option value="AV">AC</option>
                    </select>
 
                    <div class="input-group">                           
                        <input class="form-control" placeholder="Search" name="key" id="srch-term" type="text">
                            <div class="input-group-btn">
                                <button class="btn theme-button site-btn" type="submit" name='submit' onclick="saveInfo()"><span class='search-button-padding text-color'>搜索</span><i class="glyphicon glyphicon-search text-color"></i></button>
                            </div>
                    </div>
                </form> 
            </div>
        </div>

        <div>
                      
            <?php    
                
                if(isset($_POST['submit'])){
                    $_SESSION['chooseSchool'] = $_POST["chooseSchool"];
                    $_SESSION['choosePostType'] = $_POST['choosePostType'];
                    $_SESSION['key'] = $_POST["key"];                    
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
        
 
        
        <footer>
            <div class="copyright">
                <div class="container">
                    <div class="row text-center copyright">
                        <p>Copyright © 2018 All rights reserved</p>
                    </div>        
                </div>
            </div>
        </footer>

    </body>
</html>

<script src="/js/mainpage.js" type="text/javascript"></script>