<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>登录-大学生签到网</title>
<style>
html, body {
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	min-width: 1024px;
}

ul {
	list-style: none;
}

h1 {
	height: 70px;
	padding-left: 150px;
	line-height: 70px;
}

h1 img {
	width: 50px;
	height: 60px;
}

.center {
	width: 100%;
	height: 400px;
	margin-top: 30px;
	background-image: url("images/login-background.jpg");
	background-size: 100% 100%;
}

.center .form-wrapper {
	float: right;
	width: 360px;
	height: 350px;
	margin-top: 25px;
	margin-right: 150px;
	background-color: white;
	box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.3);
}

.center .form-wrapper .nav {
	width: 100%;
	height: 60px;
}

.center .form-wrapper .nav span {
	display: inline-block;
	width: 170px;
	height: 100%;
	margin-left: 5px;
	text-align: center;
	line-height: 60px;
	border-bottom: 2px solid white;
	cursor: pointer;
}

.center .form-wrapper .nav .user-login {
	border-bottom-color: black;
}

.center .form-wrapper .user-login-form {
	margin-top: 10px;
}

.center .form-wrapper .user-login-form .input {
	width: 330px;
	height: 50px;
	margin-top: 10px;
	margin-left: 10px;
	padding-left: 15px;
	color: rgba(0, 0, 0, 0.2);
	outline: none;
	border: 0px solid #cccccc;
	border-bottom: 1px solid rgba(0, 0, 0, 0.2);
	transition: all .3s ease;
}

.center .form-wrapper .user-login-form .input:focus {
	border-bottom-color: rgba(0, 0, 0, 1);
}

.center .form-wrapper .user-login-form .checkbox-wrapper {
	height: 20px;
	margin-top: 25px;
}

.center .form-wrapper .user-login-form .radio-label {
	position: relative;
	display: inline-block;
	width: 20px;
	height: 20px;
	margin-left: 10px;
	border: 1px #ccc solid;
	border-radius: 50%;
	cursor: pointer;
}

.center .form-wrapper .user-login-form .textForgetPasswd {
	float: right;
	height: 100%;
	margin-right: 10px;
}

.center .form-wrapper .user-login-form .textForgetPasswd a {
	color: black;
	text-decoration: none;
}

.center .form-wrapper .user-login-form .textForgetPasswd a:hover {
	text-decoration: underline;
}

.center .form-wrapper .user-login-form .textRemenberPasswd {
	float: right;
	height: 100%;
	margin-right: 170px;
}

.center .form-wrapper .user-login-form #radio:checked+.radio-label:after
	{
	content: "";
	position: absolute;
	width: 13px;
	height: 13px;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	margin: auto;
	background-color: black;
	border-radius: 50%;
}

.center .form-wrapper .user-login-form .btn {
	display: inline-block;
	width: 80px;
	height: 50px;
	text-align: center;
	line-height: 50px;
	margin-top: 25px;
	color: white;
	cursor: pointer;
	background-color: #33cccc;
	border-radius: 4px;
	transition: all .3s ease;
}

.center .form-wrapper .user-login-form .btn:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

.center .form-wrapper .user-login-form .submit {
	margin-left: 48px;
}

.center .form-wrapper .user-login-form .sign {
	margin-left: 104px;
}

.center .form-wrapper .user-login-form .sign a {
	color: white;
	text-decoration: none;
}

.center .form-wrapper .QRcode-login-form img {
	width: 150px;
	height: 150px;
	margin-left: 102px;
	margin-top: 60px;
}

.footer {
	margin-top: 30px;
}

.footer ul {
	width: 316px;
	height: 21px;
	margin: auto;
}

.footer ul li {
	float: left;
	margin-left: 15px;
}

.footer ul li a {
	text-decoration: none;
	color: black;
}

.footer h4 {
	margin-top: 10px;
	text-align: center;
	font-weight: normal;
}
</style>
</head>
<body>
	<h1>
		<img src="images/logo.jpg"> 大学生签到网
	</h1>
	<div class="center">
		<div class="form-wrapper">
			<div class="nav">
				<span id="user-login" class="user-login">用户登录</span> <span
					id="QRcode-login" class="QRcode-login">扫码登录</span>
			</div>
			<form action="loginAction.php" method="post" id="user-login-form"
				class="user-login-form">
				
				<?php 
				    if(!empty($_COOKIE['check'])){?>
				<div>
				    <input class="input" value="<?php echo $_COOKIE['account']?>" name="account">
				</div>			
				<div>
					<input class="input" type="password" value="<?php echo $_COOKIE['password']?>" name="password">
				</div>
				<?php }else{?>
				<div>
				    <input class="input" value="用户名" name="account">
				</div>			
				<div>
					<input class="input" type="password" value="密码" name="password">
				</div>
				<?php }?>
				
				
				<div class="checkbox-wrapper">
					<input class="input" id="radio" type="checkbox" name="checkbox"
						style="display: none"> <label for="radio" class="radio-label"></label>
					<span class="textForgetPasswd"><a href="#">忘记密码？</a></span> <span
						class="textRemenberPasswd">记住密码</span>
				</div>
				<div>
					<input id="submit" type="submit" style="display: none"> <label
						for="submit" class="submit btn">登录</label> <span class="sign btn"><a
						href="sign.html">注册</a></span>
				</div>
			</form>
			<form id="QRcode-login-form" class="QRcode-login-form"
				style="display: none">
				<img src="images/weixin_qrcode.jpg">
			</form>
		</div>
	</div>
	<div class="footer">
		<ul>
			<li><a href="#">关于我们</a></li>
			<li><a href="#">联系我们</a></li>
			<li><a href="#">广告服务</a></li>
			<li><a href="#">友情链接</a></li>
		</ul>
		<h4>CopyRight © xxxxxxxxxx</h4>
	</div>
	<script src="javascripts/md5.js"></script>
	<script>
    (function(){
        var userLogin = document.getElementById("user-login"),
                QRcodeLogin = document.getElementById("QRcode-login"),
                userLoginForm = document.getElementById("user-login-form"),
                QRcodeLoginForm = document.getElementById("QRcode-login-form"), 
                radio = document.getElementById("radio"),   //记住密码
				submit = document.getElementById("submit"),  //登录
				input = document.getElementsByClassName("input")  //获取用户名密码框
		<?php
		  if(!empty($_COOKIE['check'])){?>
		      radio.checked = true;
		<?php }else{?>
		  radio.checked = false;
		<?php }?>	
		
		submit.onclick = function(){
		    <?php
		    if(empty($_COOKIE['check'])){?>
		    
		        input[1].value = hex_md5(input[1].value)
		        
		    <?php }?>
			}
		
        userLogin.onclick = function(){
                userLogin.style.borderBottomColor = "black"
                QRcodeLogin.style.borderBottomColor = "white"
                userLoginForm.style.display = "block"
                QRcodeLoginForm.style.display = "none"
        }
        QRcodeLogin.onclick = function() {
            userLogin.style.borderBottomColor = "white"
            QRcodeLogin.style.borderBottomColor = "black"
            userLoginForm.style.display = "none"
            QRcodeLoginForm.style.display = "block"
        }

    })()
</script>

</body>
</html>