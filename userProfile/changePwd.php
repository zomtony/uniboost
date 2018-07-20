<?php
    include($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
?>

	<div class='row signup-container'>
		<?php
			extract ($_GET);
			if(isset($info)){
				echo "<div class='col-xs-12'><h4 style='text-align: center; color: coral;'>" . $info . "</h4></div>";
			}
		?>
		<form class="form-signin" action="php/processChangePwd.php" method="POST" onsubmit="return checkSignUpInput()">
			<label for="inputPassword" class="sr-only-focusable" style="margin-top: 5px">旧密码</label>
			<input type="password" class="form-control" placeholder="请输入您的密码" name="oldpwdf" required>

			<label for="inputPassword" class="sr-only-focusable" style="margin-top: 5px">新密码</label>
			<input type="password" class="form-control" placeholder="请输入您的密码" name="pwdf1" id="pwdf1" required>

			<label for="inputPassword" class="sr-only-focusable" style="margin-top: 5px">请再输入一次新密码</label>
			<input type="password" class="form-control" placeholder="请输入您的密码" name="pwdf2" id="pwdf2" required>

			<button class="btn btn-lg btn-primary btn-block login-signup-button" type="submit" style="width: 100px; margin: 20px auto 20px auto; padding: 4px">确认</button> 			
			<br/>
		</form>
	</div>
<?phpinclude($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>