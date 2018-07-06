<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
    <div>
        <form name="signupForm" class="form-signup" action="php/SignUp.php" method="POST" onsubmit="return checkSignUpInput()">

			<div class="container">
				<?php
					extract ($_GET);
					if(isset($info)){
						echo "<div class='col-xs-12'><h4 style='text-align: center; margin: 20px;'>" . $info . "</h4></div>";
					}
				?>
				<div class='row'>
					<div class="signup-container">
						<h1 class="dark-grey"></h1>
						<div class='row'> 
							<div class="form-group col-lg-12">
								<label>用户名<font color="red">*</font></label>
								<input type="" name="accountf" class="form-control account-form-hint" placeholder="选个好记的账号作为你登陆时的用户名" required autofocus>
								<!-- <p>请选择一个好记的账号作为你的登陆用户名</p> -->
							</div>
						</div>
						<div class='row'>
							<div class="form-group col-lg-6">
								<label>密码<font color="red">*</font></label>
								<input type="password" id="pwdf1" data-minlenth="3" placeholder="" name="pwdf1" class="form-control" required>
							</div>

							<div class="form-group col-lg-6">
								<label>请在输一次密码<font color="red">*</font></label>
								<input type="password" id="pwdf2" data-minlenth="3" placeholder="" name="pwdf2" class="form-control" required>						
							</div>
						</div>
	
						<div class='row'>
							<div class="form-group col-lg-12">
										<label>昵称<font color="red">*</font></label>
										<input type="" name="nickNamef" class="form-control" required>
							</div>
						</div>
						<div class='row'>
							<div class="col-md-6" style="width: 120px; margin-bottom: 16px;">
								<input type="submit" id="btnSubmit" class="btn btn-primary login-signup-button" value="一键注册"/>
							</div>
							<div class='col-md-6' style="padding-right: 0px;">
								<p>已经有了一个账号? <a class="label-link account-exist" href="signin.php" >登陆</a></p >
							</div>
						</div>
					</div>
				</div>	
			</div>
  </form>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');?>
