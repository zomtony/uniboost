<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
    <div class='row signup-container'>
        <?php
            extract ($_GET);
            if(isset($info)){
                echo "<div class='col-xs-12'><h4 style='text-align: center; color: coral;'>" . $info . "</h4></div>";
            }
        ?>
		<form action="/mail/SendPwdMail.php" method="POST" >
			<label for="userID" class="sr-only-focusable">用户名</label>
			<br />
			<input type="" id="accountf" class="form-control" placeholder="请输入您的账号" name="accountf" required autofocus>
			<br />
			<label for="inputPassword" class="sr-only-focusable">邮箱</label>
			<input type="email" class="form-control" placeholder="请输入你的邮箱" name="emailf" required>  
			<button class="btn btn-lg btn-primary btn-block login-signup-button" type="submit" style="width: 100px; margin: 20px auto 20px auto; padding: 4px">确认</button> 
			<br/>
		</form>

    </div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>

