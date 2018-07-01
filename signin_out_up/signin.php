<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
<div class='row'>
	<div class='col-lg-4'></div>
	<div class='col-lg-4'>
		<div class = "sign singinBody text-center">
			<form class="form-signin" action="php/SignIn.php" method="POST" >
				<h1 class="h3 mb-3 font-weight-normal">登陆</h1>
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
				<div class='margin-top-s text-center'>
					<p>没有账号? <a class="label-link" href="signup.php"> &nbsp 注册</a></p >
				</div>
				<button class="btn btn-lg btn-primary btn-block" type="submit">登陆</button> 
				<br />
			</form>
		</div>
	</div>
	<div class='col-lg-4'></div>
</div>
