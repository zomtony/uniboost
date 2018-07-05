<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
<div class='row signup-container'>

		<form class="form-signin" action="php/SignIn.php" method="POST" >
			<h1 class="h3 mb-3 font-weight-normal" style="text-align: center;">登陆</h1>
			<?php
				extract ($_GET);
				if(isset($info)){
					echo "<div class='col-xs-12'><h3>" . $info . "</h3></div>";
				}
			?>
			<label for="userID" class="sr-only-focusable">用户名</label>
			<br />
			<input type="" id="accountf" class="form-control" placeholder="请输入您的账号" name="accountf" required autofocus>
			<br />
			<label for="inputPassword" class="sr-only-focusable">密码</label>
			<input type="password" class="form-control" placeholder="请输入您的密码" name="pwdf" required>

			<button class="btn btn-lg btn-primary btn-block login-signup-button" type="submit" style="width: 100px; margin: 20px auto 20px auto; padding: 4px">登陆</button> 
			
			<div class='margin-top-s text-center'>
				<p>没有账号? <a class="label-link account-exist" style="display: inline-block" href="signup.php"> 一键注册</a></p >
			</div>

			<br/>
		</form>

</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>

