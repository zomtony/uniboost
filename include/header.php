<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>红领巾</title>
        <link rel="shortcut icon" href="img/small_icon.png">
        <link href="/css/bootstrap.css" rel="stylesheet" media="screen">	
        <link href="/css/headerStyle.css" rel="stylesheet" media="screen">
        <link href="/css/mainPage.css" rel="stylesheet" media="screen">        
        <link href="/component/starRating/style.css" rel="stylesheet" media="screen">

        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/js/JavaScript.js" type="text/javascript"></script>
        <script src="/js/validata.js" type="text/javascript"></script>        
        <style>
            .resource-button-color {
                background-color: #93BDEE
            }

            .login-button-color {
                background-color: #FF7345
            }

            .login-button-layout {
                margin-left: 4px;
            }
        
            /* text-center post button */

            .phone-post-button {
                float: right;
            }

            @media (max-width: 460px) {
                .phone-post-button {
                    width: 100%;
                    text-align: center;
                    float: none;
                }
            }
        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122025311-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-122025311-1');
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse theme-backcolor">
            <div class="container comp" style="padding-right: 2px;">   
                <div class="container-fluid" style="margin: 0px 0px 0px -8px">                   
                    <div class="navbar-header padding-zero-logo" style='margin:0px;'>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo1 logo-color' src='/img/logo1.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo2 logo-color1' src='/img/logo2.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo3 logo-color' src='/img/logo3.png' alt = "我是红领巾"></a>
                    </div>
                    <div>
        
                        <ul class="nav navbar-nav navbar-right">
                            <li class='navElementPosition'>
                                <table>
                                    <tr>
                                        <td class='hidden-slogon'>
                                            <img class='slogon' src='/img/slogon.png' alt = "slogon">
                                        </td>
                                        <td>
                                            <a href='/shareMaterialsNodejs/apply/shareMaterialsForm.html' ><button type='button' class='btn btn-float theme-button resource-button-color text-color text-margin-top'>申请资料</button></a>
                                        </td>
                                    </tr>
                                </table>      
                            </li>                      
                            <?php                       
                                if(isset($_SESSION['accountb'])){
                                    echo    "<li class='dropdown'>
                                                <a class='dropdown-toggle' data-toggle='dropdown' style='margin-top: 0px;margin-bottom: 0px;'>
                                                    <img class='userPhotoId' src='data:image/jpeg;base64," . base64_encode($_SESSION['userLQPhotoId']) . "' alt='' >
                                                </a>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='/index.php'>回到首页</a></li>
                                                    <li><a href='/userProfile/userProfile.php'>我的档案</a></li>
                                                    <li><a href='/signin_out_up/php/SignOut.php'>登出</a></li>
                                                </ul>
                                            </li>";
                                }else {
                                    echo "<li class='navElementPosition' style='margin-left: 8px'><a href='/signin_out_up/signin.php' style='padding:0px;margin:0px;'><button type='button' class='btn btn-margin btn-float btn-margin login-button-color text-color'>登陆</button></a></li>
                                            <li class='navElementPosition' style='margin-left: 4px'><a href='/signin_out_up/signup.php' style='padding:0px;margin:0px;'><button type='button' class='btn btn-margin btn-float btn-margin login-button-color text-color'>注册</button></a></li>";
                                }
                            ?>                        				
                        </ul>
                    </div>
                </div>
            </div>


            <div class="container phone" style="padding-right: 0px; padding-left: 0px; margin-left: 10px;">   
                <div class="container-fluid" style="padding: 0">                   
                    <div class="navbar-header padding-zero-logo" style='margin:0px;'>                          
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='phonelogo1 logo-color' src='/img/logo1.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='phonelogo2 logo-color1' src='/img/logo2.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='phonelogo3 logo-color' src='/img/logo3.png' alt = "我是红领巾"></a>
                                
                    <?php
                        if(isset($_SESSION['accountb'])){
                            $accountb = $_SESSION['accountb'];
                    echo    "<div class='dropdown'>
                                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar' style='margin-top: 0px; margin-bottom: 0px;'>
                                    <img class='userPhotoId' src='data:image/jpeg;base64," . base64_encode($_SESSION['userLQPhotoId']) . "' alt='' >
                                </button>
                            </div>";
                        }else{       
                    echo    "<div class='dropdown'>
                                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>
                                    <span class='icon-bar'></span>                        
                                </button>
                            </div>";
                        }
                    ?>
                                
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">       
                        <ul class="nav navbar-nav navbar-right">
                        <li class='navElementPosition'>
                            <table>
                                <tr>
                                    <td class='hidden-slogon'>
                                        <img class='slogon' src='/img/slogon.png' alt = "slogon">
                                    </td>
                                </tr>
                            </table>      
                        </li>                      
                        <?php                       
                            
                            if(isset($_SESSION['accountb'])){
                                echo    "<li><a class='big-font' href='/index.php'>回到首页</a></li>
                                        <li>                                        
                                            <a class='big-font' href='/shareMaterialsNodejs/apply/shareMaterialsForm.html' style='color:#ffffff;'>申请资料</a>
                                        </li>                                  
                                        <li><a class='big-font' href='/userProfile/userProfile.php' style='color:#ffffff;'>我的档案</a></li>
                                        <li><a class='big-font' href='/signin_out_up/php/SignOut.php' style='color:#ffffff;'>登出</a></li>";
                            }else {
                                echo    "<li><a class='big-font' href='/shareMaterialsNodejs/apply/shareMaterialsForm.html' style='color:#ffffff;'>申请资料</a></li>
                                        <li><a class='big-font' href='/signin_out_up/signin.php' style='color:#ffffff;'>登陆</a></li>
                                        <li><a class='big-font' href='/signin_out_up/signup.php' style='color:#ffffff;'>注册</a></li>";
                            }
                        ?>                        				
                        </ul>
                    </div>
                </div>
            </div>
        </nav>