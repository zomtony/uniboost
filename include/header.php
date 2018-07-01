<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>HomePage</title>
        <link href="/css/bootstrap.css" rel="stylesheet" media="screen">	
        <link href="/css/headerStyle.css" rel="stylesheet" media="screen">
        <link href="/css/mainPage.css" rel="stylesheet" media="screen">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="/component/starRating/style.css" rel="stylesheet" media="screen">

        <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
        <script src="/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/js/JavaScript.js" type="text/javascript"></script>
        <script src="/js/validata.js" type="text/javascript"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
    </head>
    <body>
        <nav class="navbar navbar-inverse theme-backcolor">
            <div class="container">   
                <div class="container-fluid">
                    <div class="navbar-header padding-zero-logo">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                        </button>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo1 logo-color' src='/img/logo1.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo2 logo-color1' src='/img/logo2.png' alt = "我是红领巾"></a>
                        <a class="navbar-brand titleFont padding-zero-logo" href="/index.php"><img class='logo3 logo-color' src='/img/logo3.png' alt = "我是红领巾"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
        
                        <ul class="nav navbar-nav navbar-right">
                            <?php                       
                                session_start();
                                if(isset($_SESSION['accountb'])){
                                    $accountb = $_SESSION['accountb'];
                                    echo    "<li class='dropdown'>
                                                <a href='/signin_out_up/php/SignOut.php' class='dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-user'></span>" .$accountb . "</a>
                                                <ul class='dropdown-menu'>
                                                    <li><a href='/userProfile/userProfile.php?accountb=$accountb'>我的档案</a></li>
                                                    <li><a href='/signin_out_up/php/SignOut.php'>登出</a></li>
                                                </ul>
                                            </li>";
                                }else {
                                    echo "<li class='navElementPosition'><a href='/signin_out_up/signin.php' style='padding:0px;margin:0px;'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>登陆</button></a></li>
                                        <li class='navElementPosition'><a href='/signin_out_up/signup.php' style='padding:0px;margin:0px;'><button type='button' class='btn btn-margin btn-float btn-margin theme-button text-color'>注册</button></a></li>";
                                }
                            ?>                        				
                        </ul>
                    </div>
                </div>
            </div>
        </nav>