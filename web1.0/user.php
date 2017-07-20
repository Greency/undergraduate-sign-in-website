<?php
session_start();
if (empty($_SESSION['userId'])) {
    header("location:login.html");
}
?> 


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>用户-大学生签到网</title>
<style>
html, body {
	padding: 0;
	margin: 0;
	min-width: 1024px;
	box-sizing: border-box;
}

input {
	outline: none;
	border-width: 0px;
}

ul {
	list-style: none;
	padding: 0px;
	margin: 0px;
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
	padding-bottom: 30px;
	background-color: #f0f0f0;;
}

.center .header {
	position: relative;
	width: 900px;
	height: auto;
	margin: auto;
	box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
}

.center .header .header-top {
	width: 100%;
	height: 116px;
	color: white;
	background-image: url("images/login-background.jpg");
	background-size: 100% 100%;
}

.center .header .header-top ul {
	float: left;
	margin-top: 5px;
	margin-left: 200px;
}

.center .header .header-top ul li {
	width: 294px;
	height: 24px;
	margin-top: 10px;
	font-size: 12px;
	line-height: 24px;
}

.center .header .header-top .name-wrapper {
	float: left;
	font-size: 20px;
}

.center .header .header-top .alter-name-btn {
	float: left;
	width: 24px;
	height: 24px;
	margin-left: 5px;
	background-image: url("images/alter.png");
	background-size: 100% 100%;
	cursor: pointer;
}

.center .header .header-top .btn {
	float: right;
	width: 80px;
	height: 50px;
	text-align: center;
	margin-top: 34px;
	margin-right: 35px;
	color: white;
	cursor: pointer;
	background-color: #33cccc;
	border-radius: 4px;
	transition: all .3s ease;
}

.center .header .header-top .btn:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

.center .header .header-bottom {
	width: 100%;
	height: 65px;
	background-color: white;
}

.center .header .header-bottom ul, 
.center .header .header-bottom ul li
	{
	float: left;
	height: 45px;
}

.center .header .header-bottom ul {
	margin-top: 11px;
}

.center .header .header-bottom ul li {
	width: 115px;
	margin-left: 98px;
	cursor: pointer;
}

.center .header .header-bottom ul li b {
	display: inline-block;
	width: 45px;
	height: 100%;
}

.center .header .header-bottom ul li span {
	float: right;
	height: 100%;
	font-size: 15px;
	line-height: 45px;
}

.center .header .header-bottom ul li:nth-child(1) b {
	background-image: url("images/self-info.png");
	background-size: 100% 100%;
}

.center .header .header-bottom ul li:nth-child(2) b {
	background-image: url("images/kecheng-info-hui.png");
	background-size: 100% 100%;
}

.center .header .header-bottom ul li:nth-child(3) b {
	background-image: url("images/kaoqing-info-hui.png");
	background-size: 100% 100%;
}

.center .header .header-bottom .head-portrait-uploading {
	float: left;
	margin-top: 40px;
	margin-left: 70px;
	font-weight: 600;
	background-color: white;
	cursor: pointer;
}

.center .header .head-portrait-wrapper {
	position: absolute;
	width: 300px;
	height: 200px;
	left: 130px;
	z-index: 100;
	background-color: white;
	border: 1px solid #cccccc;
}

.center .header .head-portrait-wrapper li {
	float: left;
	width: 100px;
	height: 100px;
	width: 100px;
}

.center .header .head-portrait-wrapper li img {
	width: 100%;
	height: 100%;
	border-radius: 50%;
}

.center .header .head-portrait {
	position: absolute;
	width: 140px;
	height: 140px;
	top: 10px;
	left: 30px;
	border: 3px solid white;
	border-radius: 50%;
}

.center .header .head-portrait img {
	width: 100%;
	height: 100%;
	border-radius: 50%;
}

.center .header .alter-name-form {
	position: absolute;
	width: 320px;
	padding-bottom: 10px;
	top: 188px;
	left: 299px;
	background-color: white;
	box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
}

.center .header .alter-name-form .tooltips {
	display:block;
	font-size:12px;
	padding-left:20px;
	padding-top:10px; 
}
.center .header .alter-name-form h6 { 
    height:34px;
	margin: 0px;
	text-align: center;
	line-height: 34px;
	color: white;
	background-color: #33cccc;
}

.center .header .alter-name-form input[type="password"],
.center .header .alter-name-form input[type="text"] {
	width: 80%;
	height: 30px;
	margin-top: 10px;
	margin-left: 30px;
	border: 1px solid black;
	border-radius: 5px;
}

.center .header .alter-name-form .btn {
	float: left;
	width: 70px;
	height: 40px;
	text-align: center;
	margin-top: 10px;
	margin-left: 58px;
	color: white;
	cursor: pointer;
	background-color: #33cccc;
	border-radius: 4px;
	transition: all .3s ease;
}

.center .header .alter-name-form .btn:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

.center .content {
	width: 900px;
	height: 650px;
	margin: auto;
	margin-top: 10px;
	background-color: white;
	box-shadow: -4px 7px 46px 2px rgba(0, 0, 0, 0.1);
}

.center .content .content-left {
	float: left;
	width: 19%;
	min-height: 650px;
	border-right: 1px solid rgba(0, 0, 0, 0.2);
}

.center .content .content-left ul {
	margin-top: 30px;
	margin-left: 18px;
}

.center .content .content-left ul li {
	position: relative;
	width: 130px;
	height: 30px;
	margin-top: 10px;
	font-size: 13px;
	line-height: 30px;
	text-align: center;
	background-color: rgba(0, 0, 0, 0.1);
	border-radius: 15px;
	cursor: pointer;
}

.center .content .content-left ul li.nav-bar-focus {
	border: 2px solid #33cccc;
}

.center .content .content-left ul li.nav-bar-focus:before, .center .content .content-left ul li.nav-bar-focus:after
	{
	background-color: #33cccc;
}

.center .content .content-left ul li:before {
	content: " ";
	position: absolute;
	top: 13px;
	left: 130px;
	width: 15px;
	height: 2px;
	background-color: rgba(0, 0, 0, 0.2);
}

.center .content .content-left ul li:after {
	content: " ";
	position: absolute;
	top: 7px;
	left: 145px;
	width: 15px;
	height: 15px;
	border-radius: 50%;
	background-color: #e3e3e3;
}

.center .content .content-left ul li:hover {
	border: 2px solid #33cccc;
}

.center .content .content-right {
	float: left;
	margin-left: 44px;
	width: 76%;
	min-height: 600px;
}

.center .content .content-right .content-right-userInfo {
	width: 100%;
}

.center .content .content-right .nav-bar-container h5 {
	position: relative;
}

.center .content .content-right .nav-bar-container h5:before {
	content: "  ";
	position: absolute;
	width: 2px;
	height: 17px;
	top: 2px;
	left: -6px;
	background-color: #33cccc;
}

.center .content .content-right .content-right-userInfo table tr {
	height: 40px;
}

.center .content .content-right .content-right-userInfo table tr td {
	height: 100%;
	margin: 0px;
	border: 1px solid rgba(0, 0, 0, 0.2);
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(1)
	{
	width: 100px;
	padding: 10px 0px;
	padding-right: 5px;
	text-align: right;
	background-color: #e3e3e3;
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(2) label
	{
	display: inline-block;
	font-size: 13px;
	line-height: 40px;
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(2)
	{
	padding-left: 10px;
	width: 512px;
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(2) input
	{
	display: none;
	width: 98%;
	height: 40px;
	border-bottom: 1px solid rgba(0, 0, 0, 1);
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(2) .birthdate
	{
	width: 70px;
	border: 1px solid rgba(0, 0, 0, 1);
}

.center .content .content-right .content-right-userInfo table tr td:nth-child(2) .adress
	{
	width: 200px;
	border: 1px solid rgba(0, 0, 0, 1);
}

.center .content .content-right .content-right-userInfo .btn {
	width: 115px;
	height: 45px;
	text-align: center;
	margin-top: 34px;
	color: white;
	cursor: pointer;
	background-color: #33cccc;
	border-radius: 4px;
	transition: all .3s ease;
}

.center .content .content-right .content-right-userInfo .btn:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

.center .content .content-right .content-right-userInfo #editBtn {
	margin-left: 265px;
}

.center .content .content-right .content-right-userInfo #submitBtn {
	margin-left: 200px;
}

.center .content .content-right .content-right-userInfo #cancleBtn {
	margin-left: 20px;
}

.center .content .content-right .account-safety li {
	height: 40px;
	margin-top: 15px;
	line-height: 40px;
}

.center .content .content-right .account-safety .btn {
	float: right;
	width: 80px;
	height: 40px;
	text-align: center;
	margin-right: 35px;
	color: white;
	cursor: pointer;
	background-color: #33cccc;
	border-radius: 4px;
	transition: all .3s ease;
}

.center .content .content-right .account-safety .btn:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

/*课程*/
.center .content .course {
	padding-left: 30px;
	padding-top: 20px;
}

.center .content .course h5 {
	position: relative;
}

.center .content .course h5:before {
	content: "  ";
	position: absolute;
	width: 2px;
	height: 17px;
	top: 2px;
	left: -6px;
	background-color: #33cccc;
}

.center .content .course ul li {
	float: left;
	width: 350px;
	height: 200px;
	margin-left: 48px;
	margin-top: 20px;
	background-color: #f0f0f0;
	border: 1px solid #cccccc;
}

.center .content .course ul li div {
	float: left;
}

.center .content .course ul li div:nth-child(1) {
	width: 200px;
}

.center .content .course ul li div:nth-child(2) {
	width: 140px;
}

.center .content .course ul li div:nth-child(1) span {
	display: inline-block;
	width: 100%;
	height: 30px;
	margin-top: 30px;
	padding-left: 16px;
}

.center .content .course ul li div:nth-child(2) input {
	float: left;
	width: 60px;
	height: 40px;
	margin-top: 20px;
	margin-left: 40px;
	cursor: pointer;
	border-radius: 4px;
	background-color: #33cccc;
	color: white;
}

.center .content .course ul li div:nth-child(2) .on {
	background-color: #33cccc;
	color: white;
}

.center .content .course ul li div:nth-child(2) .off {
	color: black;
	background-color: #cccccc;
}

.center .content .course ul li div:nth-child(2) .on:hover {
	box-shadow: -2px 10px 20px -1px rgba(51, 204, 204, 0.4);
}

.center .content .attendance-record {
	padding-left: 30px;
	padding-top: 20px;
}

.center .content .attendance-record h5 {
	position: relative;
	margin-top: 20px;
}

.center .content .attendance-record h5:before {
	content: "  ";
	position: absolute;
	width: 2px;
	height: 17px;
	top: 2px;
	left: -6px;
	background-color: #33cccc;
}

.center .content .attendance-record div {
	height: 454px;
}

.center .content .attendance-record table {
	width: 95%;
}

.center .content .attendance-record tr td {
	width: 25%;
	height: 50px;
	text-align: center;
	line-height: 40px;
}

.center .content .attendance-record tr td.normal {
	color: #68ba56;
}

.center .content .attendance-record tr td.late {
	color: red;
}

.center .content .attendance-record tr td.leave {
	color: #33cccc;
}

.center .content .attendance-record tr:nth-child(1) td {
	border-bottom: 1px solid black;
}

.center .content .attendance-record ul {
	width: 100%;
	margin-top: 32px;
	text-align: center;
}

.center .content .attendance-record ul li {
	display: inline-block;
	width: 30px;
	height: 30px;
	margin: 5px;
	text-align: center;
	line-height: 30px;
	background-color: rgba(0, 0, 0, .1);
	border: 1px solid rgba(0, 0, 0, .3);
	cursor: pointer;
}

.center .content .attendance-record ul li:hover {
	color: white;
	background-color: rgba(0, 0, 0, .3);
}

.center .content .attendance-record ul li:nth-child(1) {
	width: 50px;
}

.center .content .attendance-record ul li:nth-child(2) {
	width: 66px;
}

.center .content .attendance-record ul li:nth-child(3) {
	color: white;
	background-color: rgba(0, 0, 0, .3);
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
		<div class="header">
			<div class="header-top">
				<ul>
					<li>
						<div class="name-wrapper">
							<label id="nickname">暂无昵称</label>
						</div> <span id="alter-name-btn" class="alter-name-btn"></span>
					</li>
					<li class="account">账 号：20140657021112</li>
					<li class="lasttime">
                    上一次登陆时间：<?php echo $_SESSION['lasttime']?>
                </li>
				</ul>
				<input class="btn logoutBtn" type="button" value="注销">
			</div>
			<div class="header-bottom">
				<input class="head-portrait-uploading" type="button" value="修改头像">
				<ul>
					<li class="nav"><b></b><span>个人信息</span></li>
					<li class="nav"><b></b><span>我的课表</span></li>
					<li class="nav"><b></b><span>考勤记录</span></li>
				</ul>
			</div>
			<div class="head-portrait">
				<img src="images/head-portrait.jpg">
			</div>
			<ul class="head-portrait-wrapper" style="display: none">
				<li><img src="images/head-portrait1.jpg"></li>
				<li><img src="images/head-portrait2.jpg"></li>
				<li><img src="images/head-portrait3.jpg"></li>
				<li><img src="images/head-portrait4.jpg"></li>
				<li><img src="images/head-portrait5.jpg"></li>
				<li><img src="images/head-portrait6.jpg"></li>
			</ul>
			<form id="alter-name-form" class="alter-name-form" action=""method="post" style="display: none">
				<h6>昵称修改</h6>
				<input id="name-form" type="text">
				<div>
					<input id="alter-name-submit" class="btn" type="button" value="确定">
					<input id="alter-name-cancel" class="btn" type="button" value="取消">
				</div>
			</form>
			<form id="alter-pwd-form" class="alter-name-form" action=""
				method="post" style="display: none">
				<h6>密码修改</h6>
				<input class="pwd pwd-form" type="password" value=""  placeholder="请输入新密码"> 
				<input class="pwd pwdRep-form" type="password" value=""  placeholder="请再次输入新密码">
				 <span class="tooltips"></span>
				<div>
					<input id="alter-name-submit" class="btn pwd-btn" type="button"
						value="确定"> <input id="alter-name-cancel" class="btn pwd-btn"
						type="button" value="取消">
				</div>
			</form>
		</div>

		<div class="content">
			<div class="nav-container" style="display: none">
				<div class="content-left">
					<ul>
						<li class="nav-bar nav-bar-focus">个人资料</li>
						<li class="nav-bar">账号安全</li>
						<li class="nav-bar">我的消息</li>
					</ul>
				</div>
				<div class="content-right">
					<div class="content-right-userInfo nav-bar-container"
						style="display: block">
						<h5>个人资料</h5>
						<form id="self-info-form">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td>姓名</td>
									<td><label class="label editLabel"></label>
									   <input class="input name" type="text" value="">
									</td>
								</tr>
								<tr>
							        <td>身份证号</td>
									<td><label class="label editLabel"></label>
									   <input class="input idcard" type="text" value="">
									</td>
									
								</tr>
								<tr>
									<td>性别</td>
									<td><label class="label editLabel"></label> <input
										class="input" name="sex" type="text" value=""></td>
								</tr>
								<tr>
									<td>出生日期</td>
									<td><label class="label editLabel"></label> <input
										class="input birthdate" type="text" value=""> <input
										class="input birthdate" type="text" value=""> <input
										class="input birthdate" type="text" value=""> <input
										class="birthdateHidden" type="hidden" name="birthdate"></td>
								</tr>
								<tr>
									<td>所在地区</td>
									<td><label class="label editLabel"></label> <input
										class="input adress" type="text" value=""> <input
										class="input adress" type="text" value=""> <input
										class="adressHidden" type="hidden" name="adress"></td>
								</tr>
								<tr>
									<td>学校</td>
									<td><label class="label  editLabel"></label> <input
										class="input" name="school" type="text" value=""></td>
								</tr>
								<tr>
									<td>学院</td>
									<td><label class="label editLabel"></label> <input
										class="input" name="institute" type="text" value=""></td>
								</tr>
								<tr>
									<td>专业</td>
									<td><label class="label editLabel"></label> <input
										class="input" name="major" type="text" value=""></td>
								</tr>
								<tr>
									<td>手机号</td>
									<td><label class="label editLabel"></label> <input
										class="input iphone" name="iphone" type="text" value=""></td>
								</tr>
								<tr>
									<td>QQ号</td>
									<td><label class="label editLabel"></label> <input
										class="input" name="QQ" type="text" value=""></td>
								</tr>
								<tr>
									<td>微信</td>
									<td><label class="label editLabel"></label> <input
										class="input" name="wchat" type="text" value=""></td>
								</tr>
							</table>
							<div>
								<input id="editBtn" class="btn" type="button" value="编辑" style="display: block">
							    <input id="submitBtn" class="btn" type="button" value="完成" style="display: none">
							    <input id="cancleBtn" class="btn" type="button" value="取消" style="display: none">
							</div>
						</form>
					</div>
					<div class="nav-bar-container account-safety" style="display: none">
						<h5>账号安全</h5>
						<ul>
							<li>密码长度太短，复杂度太低，建议修改！<input class="btn alert-pwd-btn"
								type="button" value="修改密码"></li>
							<li></li>
							<li></li>
						</ul>
					</div>
					<div class="nav-bar-container" style="display: none"></div>
				</div>
			</div>
			<div class="nav-container course" style="display: none">
				<h5>我的课表</h5>
				<ul class="courseshow">
				</ul>
			</div>
			<div class="nav-container attendance-record " style="display: none">
				<h5>考勤记录</h5>
				<div>
					<table id="attendance-record-content" cellpadding="0"
						cellspacing="0">
					</table>
				</div>
				<ul id="paging-wrapper">
				</ul>
			</div>
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
	<script src="javascripts/jquery-3.2.1.min.js"></script>
	<script src="javascripts/JqueryPaging-1.0.js"></script>
	<script>
    (function () {
        var timeout = null;  //计时器
        
        /*通用方法 start*/
        var ajax = function (option, fn) {
            $.ajax({
                type: "post",
                url: 'api.php',
                dataType: 'json',
                data: option.data,
                success: function (data) {
                    fn(data)
                },
                error: function () {
                   console.log("error")
                }
            })
        }
        
        //自动判断当前课程是否是处于签到时间段 课前20分钟
        var autoJudgeIsCheckIn = function(currentindex,courses,courseli){
                var coursesindex = currentindex,
                    courseliindex = parseInt(currentindex)
                          
      	        timeout = setInterval(function(){
     	        	  console.log(courses)
      	        	var date = new Date(),
        	            currenttime = parseInt(date.getHours()),  //当前时间
    	                temp = courses[coursesindex].coursestime,
    	                checkInTime = parseInt(temp.substring(0,temp.indexOf(":")))  //课程规定签到时间 
                       
                        //该课程已经超过规定签到时间，设为只能点击迟到或请假按钮
    	                if(currenttime >= checkInTime ){
        	                //清除计时器
    	                    clearInterval(timeout) 
    	                    $($($(courseli[courseliindex]).children()[1]).children()[0]).removeClass("on").addClass("off").off()
        	                }

          	        },1000*60)
           }

        
        var setInputValue = function (labels, inputs) {
            var j = 0;
            for (var i = 0; i < labels.length; i++) {
               
                if (i === 3) {
                    var temp = (labels[i]).innerText
                    if (temp !== "未填") {
                        //截取用户填写的样式
                        var first = temp.indexOf("-"),
                                last = temp.lastIndexOf("-"),
                                length = temp.length;

                        $(inputs[j++]).val(temp.substring(0, first));
                        $(inputs[j++]).val(temp.substring(first + 1, last));
                        $(inputs[j]).val(temp.substring(last + 1, length));
                    } else {
                        j += 2
                    }
                } else if (i === 4) {
                    var temp = (labels[i]).innerText,
                            first = temp.indexOf("市") || temp.indexOf("省"),
                            length = temp.length
                    if (temp !== "未填") {
                        $(inputs[j++]).val(temp.substring(0, first + 1));
                        $(inputs[j]).val(temp.substring(first + 1, length));
                    } else {
                        j += 1
                    }

                } else {
                   
                    $(inputs[j]).val($(labels[i]).text())
                }

                j++;
            }
        }

        var setLabelText = function (labels, inputs) {
            var j = 0;
            for (var i = 0; i < labels.length; i++) {
                if (i === 3) {
                    var str = ""
                    str += $(inputs[j++]).val()
                    var temp = $(inputs[j++]).val()
                    str += parseInt(temp) < 10 && temp.indexOf("0") !== 0 ? "-0" + temp : "-" + temp
                    temp = $(inputs[j]).val()
                    str += parseInt(temp) < 10 && temp.indexOf("0") !== 0 ? "-0" + temp : "-" + temp
                    $(labels[i]).text(str)
                    $(".birthdateHidden").val(str)
                } else if (i === 4) {
                    var str = ""
                    str += $(inputs[j++]).val()
                    str += $(inputs[j]).val()
                    $(labels[i]).text(str)
                    $(".adressHidden").val(str)
                } else {
                	var text = $(inputs[j]).val();
                    if(i == 1){
                        if(text !== "未填"){
                    	text = text.substring(0,7)+"********"    
                        }                 
                    }
                    $(labels[i]).text(text)
                }
                j++;
            }
        }
        /*通用方法 end*/

        var nav = $(".nav"),  //个人信息，我的课表，考情记录按钮
                navContainer = $('.nav-container'),  //与个人信息，我的课表，考情记录按钮相对应的显示内容的容器
                navLast = nav[0],  //储存上一个被点击的元素,并初始化上一个为个人信息
                bBlur = ["url(images/self-info-hui.png)", "url(images/kecheng-info-hui.png)", "url(images/kaoqing-info-hui.png)"],  
                bFocus = ["url(images/self-info.png)", "url(images/kecheng-info.png)", "url(images/kaoqing-info.png)"]

        //个人信息，我的课表，考情记录按钮绑定事件
        nav.on("click", function (e) {
            var b = $(this).children()[0],
                    bLast = $(navLast).children()[0],
                    index = $(this).index(),
                    indexLast = $(navLast).index()

            $(bLast).css("background-image", bBlur[indexLast])
            $(b).css("background-image", bFocus[index])
            //将当前点击的元素保存在记录上一次被点击元素的变量里
            navLast = this
            navContainer[indexLast].style.display = "none"
            if (index === 0) {
                //个人信息界面
                navContainer[index].style.display = "block"
                var navBar = $(".nav-bar"),  //个人资料，账号安全，我的消息按钮
                        navBarContainer = $(".nav-bar-container"), //与个人资料，账号安全，我的消息按钮相对应的显示内容的容器
                        navBarLast = navBar[0]
                //个人资料，账号安全，我的消息按钮绑定事件
                navBar.on("click", function () {
                    var index = $(this).index(),
                            indexLast = $(navBarLast).index()
                    $(navBarLast).removeClass("nav-bar-focus")
                    $(this).addClass("nav-bar-focus")
                    //将当前点击的元素保存在记录上一次被点击元素的变量里
                    navBarLast = this
                    navBarContainer[indexLast].style.display = "none"
                    if (index === 0) {
                        var flag = false
                        //个人资料界面
                        navBarContainer[index].style.display = "block"

                        //获取数据，加载个人资料的信息
                        ajax({data: {status: "select", type: "user"}}, function (data) {
                            var label = $(".label")
                            var i = 0
                            $.each(data, function (key, value) {
                                if (i > 2) {
                                	if(i == 4){ 
                                    	if(value !== "未填")
                                 		   value = value.substring(0,7)+"********"
                                    	}
                                    $(label[i - 3]).text(value)
                                    
                                }
                                i++;
                            })
                            $(".account").text("账 号：" + data['account'])
                            $("#nickname").text(data['nickname'])
                            $(".head-portrait img").attr("src",data['headimg'])

                        })


                        var inputs = $(".input"),
                                labels = $(".editLabel")
                                
                        //个人资料 编辑，完成，取消按钮绑定事件
                        $("#editBtn").on("click", function () {
                            //编辑按钮
                            $(inputs).css("display", "inline-block")
                            setInputValue(labels, inputs)
                            $(labels).css("display", "none")
                            //判断姓名是否能被编辑
                            if($(labels[0]).text() !== "未填"){
                            	$(labels[0]).css("display","block")
                            	$(inputs[0]).css("display","none")
                                }else{
                                    $(inputs[0]).attr("name","name")
                                    }
                            //判断身份证是否能被编辑
                            if($(labels[1]).text() !== "未填"){
                            	$(labels[1]).css("display","block")
                            	$(inputs[1]).css("display","none")
                                }else{
                                	$(inputs[1]).attr("name","idcard")
                                    }
                            $(this).css("display", "none")
                            $("#submitBtn").css("display", "inline-block")
                            $("#cancleBtn").css("display", "inline-block")
                        })
                        $("#submitBtn").on("click", function () {
                            //完成按钮
                            $(this).css("display", "none")
                            $("#cancleBtn").css("display", "none")
                            $("#editBtn").css("display", "inline-block")
                            $(labels).css("display", "inline-block")
                            setLabelText(labels, inputs)
                            $(inputs).css("display", "none")
                            //将修改后的信息传给后端
                            ajax({data: "status=update&type=userall&" + $("#self-info-form").serialize()}, function (data) {
                                if (data['status'] === 1) {
                                    console.log(true)
                                }
                            })
                        })
                        $("#cancleBtn").on("click", function () {
                            //取消按钮
                            $(this).css("display", "none")
                            $("#submitBtn").css("display", "none")
                            $("#editBtn").css("display", "inline-block")
                            $(labels).css("display", "inline-block")
                            $(inputs).css("display", "none")
                        })
                    } else if (index === 1) {  //账号安全界面
                        navBarContainer[index].style.display = "block"
                        $(".alert-pwd-btn").on("click",function(){
                            $("#alter-pwd-form").css("display","block")
                            var _flag = false
                            
                            $(".pwdRep-form").on("blur",function(){
                            	if($($(".pwd")[0]).val() === $($(".pwd")[1]).val()){
                          		      _flag = true
                            		    $(".tooltips").css("color","#68ba56").text("两次密码相同")
                                	}else{
                                    	$(".tooltips").css("color","red").text("两次密码不对")
                                    	}
                                })
                                 
                                 $(".pwd-btn").on("click",function(){
                                    if($(this).val() === "确定"){
                                        if(_flag){  
                                            var pwd = $($(".pwd")[0]).val()
                                             ajax({data:{status:"update",type:"pwd",pwd:pwd}},function(data){
                                           	          if(data['status'] === 1){
                                           	        	  window.location.href = "login.html"
                                               	          }
                                                 })
                                                 }
                                        }else if($(this).val() === "取消"){
                                        	$("#alter-pwd-form").css("display","none")
                                            }
                                })
                           
                           
                            })
                        } else if (index === 2) {  //我的消息界面
                        navBarContainer[index].style.display = "block"
                    }

                })
                navBarLast.click()

            } else if (index === 1) {
                //我的课表界面
            	var courses = {}, //课程对象
         	        currentindex = -1,  //当前可以签到课程的索引
         	               
            	_self = this
            	
                navContainer[index].style.display = "block"
                var week = new Date().getDay()
                //获取当天的课表和课程状态表
                ajax({data:{status:"select",type:"course",week:week}},function(data){
                    if(!data[0]){
                        alert("请在个人资料界面填写正确的专业")
                        }
                    var html = "",
                        num = 0
                        //遍历课程表中的数据
                    $.each(data[0],function(key,value){                      
                            if(value !== ""){
                            	var first = value.indexOf("|"),
                                last = value.lastIndexOf("|"),
                                length = value.length
                            	courses[num++] = {coursesname:(value.substring(0,first)),
                            		              coursestime:(value.substring(first+1,last)),
                            		              coursesadress:(value.substring(last+1,length)),
                            		              coursesstate: null  //0:代表当前课程已经正常签到; 1:代表当前课程是可点击状态(迟到|请假）;  2:代表当前课程是全新的状态;3:代表还没到签到时间
                          		                      }
                                }                      
                    })
                                                        
                   //遍历课程状态表中的数据
                    if(data[1].length !== 0){
                            for(var i = 0;i < data[1].length;i ++){
                                for(var index in courses){
                                	if(data[1][i]['course'] === courses[index].coursesname){
                                		courses[index].coursesstate = parseInt(data[1][i]['state'])
                                    	} 
                                    }
                                }
                    }
                   //遍历修改当天课程表的状态
                   for(var index in courses){
               	          if(courses[index].coursesstate === null){
                  	           var date = new Date(),
                    	           currenttime = parseInt(date.getHours()),  //当前时间
                  	               temp = courses[index].coursestime,
                  	               checkInTime = parseInt(temp.substring(0,temp.indexOf(":")))  //课程规定签到时间
                  	               console.log(checkInTime)
                     	             if(currenttime > checkInTime -1){  //已经错过签到的时间
                    	            	 courses[index].coursesstate = 1
                        	             }else if(currenttime < checkInTime - 1){  //还没到签到时间
             	                              courses[index].coursesstate = 3            	                           
    	                                   }else if(currenttime = checkInTime - 1){  //是否处于可以签到的时间点
        	                                   var minutes = date.getMinutes()  
    	                                	   if(minutes >= 39 && minutes <= 59){
    	                                		   courses[index].coursesstate = 2
        	                                	   }else{
        	                                		   courses[index].coursesstate = 3
            	                                	   }
        	                                   }
                   	          }
                       }

                   for(var index in courses){
                	   html += "<li class='courseli'><div><span>课程："+courses[index].coursesname+"</span><span>时间："+courses[index].coursestime+"</span><span>地点："+courses[index].coursesadress+"</span>"                 	 
                  	   switch(courses[index].coursesstate){
                   	       case 0 : html += "</div><div><input class='coursebtn off' type='button' value='签到'><input class='coursebtn off' type='button' value='迟到'><input class='coursebtn off' type='button' value='请假'></div></li>";break;
                   	       case 1 : html += "</div><div><input class='coursebtn off' type='button' value='签到'><input class='coursebtn on' type='button' value='迟到'><input class='coursebtn on' type='button' value='请假'></div></li>";break;
                   	       case 2 : html += "</div><div><input class='coursebtn on' type='button' value='签到'><input class='coursebtn on' type='button' value='迟到'><input class='coursebtn on' type='button' value='请假'></div></li>";break;
                   	       case 3 : html += "</div><div><input class='coursebtn off' type='button' value='签到'><input class='coursebtn off' type='button' value='迟到'><input class='coursebtn off' type='button' value='请假'></div></li>";break;
                      	   }
                       }
                   //将此html加载页面中
                   $(".courseshow").html(html)
                    
                   var courseli = $(".courseli")
                   
                   //绑定事件
                   for(var index in courses){
                	   var _index = parseInt(index)
                	   if(courses[index].coursesstate === 1){  //已经过了签到时间          		         
               		         //绑定事件
           		             (function(selfindex){
            		            	$($($(courseli[selfindex]).children()[1]).children()).on("click",function(){ 
                    		        	$($($(courseli[selfindex]).children()[1]).children()[1]).removeClass("on").addClass("off").off()
                    		        	$($($(courseli[selfindex]).children()[1]).children()[2]).removeClass("on").addClass("off").off()
                    		        	ajax({data:{status:"insert",type:"coursestate",course:courses[selfindex].coursesname,state:0}},function(data){
                        		        	
                        		        	})
                        		        var state = 0
                        		        switch($(this).val()){
                            		        case "迟到" : state = 2;break;
                            		        case "请假" : state = 3;break;
                        		        }
                     		        	ajax({data:{status:"insert",type:"kaoqing",adress:courses[selfindex].coursesadress,state:state,coursesname:courses[selfindex].coursesname}},function(data){
                     		        	    
                         		        	})
                       		         })                   		         
                       		         //取消此元素的所有事件
                       		     $($($(courseli[selfindex]).children()[1]).children()[0]).off()
               		             })(_index)
               		         
                    	   }else if(courses[index].coursesstate === 2){ //可以签到状态
                        	   
                    		       autoJudgeIsCheckIn(index,courses,courseli);
                    		   
                    			   (function(selfindex){
                    				   $($($(courseli[selfindex]).children()[1]).children()).on("click",function(){
                            			   $($($(courseli[selfindex]).children()[1]).children()).removeClass("on").addClass("off").off()
                            			   
                            			   //清除计时器
                            			   clearInterval(timeout)
                            			   ajax({data:{status:"insert",type:"coursestate",course:courses[selfindex].coursesname,state:0}},function(data){
                        		        	
                        		        	})
                        		        	var state = 0
                            		        switch($(this).val()){
                            		            case "签到" : state = 1;break;
                                		        case "迟到" : state = 2;break;
                                		        case "请假" : state = 3;break;
                            		        }
                         		        	ajax({data:{status:"insert",type:"kaoqing",adress:courses[selfindex].coursesadress,state:state,course:courses[selfindex].coursesname}},function(data){
                         		        	    
                             		        	})
                            			   })
                     		             })(_index)	   
                        	   }
                       }                                                        
                })
                
               
                
            } else if (index === 2) {
                //考勤记录界面
                navContainer[index].style.display = "block"

                //获取数据
                ajax({data: {status: "select", type: "attendancerecord", currentPage: 1}}, function (data) {
                    var html = "<tr><td>时间</td><td>地点</td><td>状态</td><td>查看</td></tr>",
                            pages = data.length
                    for (var i = 0; i < pages - 1; i++) {
                        var state = data[i]['state']
                        html += "<tr><td>" + data[i]['time'] + "</td><td>" + data[i]['adress'] + "</td>"
                        if (state === "1") {
                            html += "<td class='normal'>正常"
                        } else if (state === "2") {
                            html += "<td class='late'>迟到"
                        } else if (state === "3") {
                            html += "<td class='leave'>请假"
                        }
                        html +=  "</td><td>查看详情</td></tr>"
                    }
                    $("#attendance-record-content").html(html)
                    
                

                    //配置数据
                    var option = {
                        id: '#paging-wrapper',
                        pages: Math.ceil(data[pages - 1] / 8), //总页数
                        displayPage: 4, //只显示多少页
                    }
                    //调用分页插件
                    new Paging(option)

                })

            }


        })
        navLast.click()

        $("#alter-name-btn").on("click",function(){
            $("#alter-name-form").css("display","block")
            $("#alter-name-submit").on("click",function(){
                var value  = $("#name-form").val()
                $("#nickname").text(value)
                ajax({data:{status:"update",type:"nickname",data:value}},function(data){

                })
                $("#alter-name-form").css("display","none")
            })
            $("#alter-name-cancel").on("click",function(){
                $("#alter-name-form").css("display","none")
            })
        })

       $(".head-portrait-uploading").on("click",function(){
            
            $(".head-portrait-wrapper").css("display","block");
            
            $(".head-portrait-wrapper li").on("click",function(){
                $(".head-portrait").html($(this).html())
                var headimg = $(this).children()[0].src;
                console.log(headimg)
                
                ajax({data:{headimgsrc:headimg,status:"update",type:"headimg"}},function(data){
                    if(data['status'] === 1){
                        alert("修改成功")
                        }
                    })

                
                $(".head-portrait-wrapper").css("display","none");
                })
            
            })

            $(".logoutBtn").on("click",function(){

                ajax({data:{status:"update",type:"logout"}},function(data){
                    if(data['status'] === 1){
                        window.location.href = "login.html";
                        }
                    })
                
                }) 
        
    })()


</script>
</body>
</html>