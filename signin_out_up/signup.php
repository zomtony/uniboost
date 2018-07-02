<?php include($_SERVER['DOCUMENT_ROOT'].'/include/header.php'); ?>
    <div>
        <form name="signupForm" class="form-signup" action="php/SignUp.php" method="POST" onsubmit="return checkSignUpInput()">

			<div class="container">
				<?php
					extract ($_GET);
					if(isset($info)){
						echo "<div class='col-xs-12'><h3>" . $info . "</h3></div>";
					}
				?>
				<div class='row'>
					<div class="col-lg-1"></div>
					<div class="col-lg-5">
						<h1 class="dark-grey">注册</h1>
						<div class='row'> 
							<div class="form-group col-lg-12">
								<label>用户名<font color="red">*</font></label>
								<input type="" name="accountf" class="form-control" placeholder="请输入您的登陆账号" required autofocus>
								<p>请选择您容易记住的账号作为您的登陆用户名</p>
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
							<div class="col-md-6">
								<input type="submit" id="btnSubmit" class="btn btn-primary" value="创建用户"/>
							</div>
							<div class='col-md-6 margin-top-s'>
								<p>已经有了一个账号? <a class="label-link" href="signin.php"> &nbsp 登陆</ a></p >
							</div>
						</div>
					</div>
				</div>	
			</div>
  </form>
</div>
