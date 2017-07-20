<?php
require 'SqlOperation.php';
header('Content-type: application/json;charset=utf-8');
$sqlOperation = new SqlOperation("localhost", "root", "", "web");
date_default_timezone_set("Asia/Chongqing");
session_start();
if (! empty($_POST['status']) && $_POST['status'] === "select") {
    // 判断用户是否记住了密码
    if (! empty($_POST['type']) && $_POST['type'] === "rememberPwd") {
        if (! empty($_COOKIE['radioState'])) {  //如果cookie不为空表示用户选中了记住密码
            echo json_encode(array(
                "status" => 1,
                "account" => $_COOKIE['abc'],
                "password" => $_COOKIE['hasdf']
            ));
        }
    } else 
        if (! empty($_POST['type']) && $_POST['type'] === "login") { // 验证登录
            $sql = "select id,password,major from users where account = '{$_POST['account']}'";
            $temp = $sqlOperation->verifyUser($sql);
            if (! empty($temp)) { // 如果存在此帐号
                $passwordTemp = "";
                    if (!empty($_COOKIE['abc'])){  //判断用户是否是使用记住密码功能登录
                        //使用记住密码功能登录，则不需再次加密密码（记住密码功能使用的cookie里面存的密码已经是加密后的密码）
                        $passwordTemp = $_POST['password'];   
                    }else{
                        $passwordTemp = md5($_POST['password']); 
                    }
                if ($passwordTemp === $temp['password']) { // 登陆成功
                    //登陆成功后，用session保存用户的id（用于后期其他操作的调用做准备）；用session保存用户的专业（用于用户界面在我的课表界面使用）
                    $_SESSION['userId'] = $temp["id"];  
                    $_SESSION['major'] = $temp["major"];
                    //从数据库中获取上一次登陆时间
                    $sql = "select lasttime from users where id = {$_SESSION['userId']}"; 
                    $result = $sqlOperation->getUsersData($sql);
                    //获取当前时间
                    $nowtime = date("Y-m-d H:i:s",time());
                    if ($result['lasttime'] === NULL){ 
                        //$_SESSION['lasttime'] 用于暂存上次登录时间，在用户界面显示
                        //判断从数据库中获取的上次登陆时间，为NULL表示用户是第一次登录,则将当前时间赋给$_SESSION['lasttime']
                        $_SESSION['lasttime'] = $nowtime;
                    }else{
                        //进行到这里表示用户不是第一次登录，则需将从数据库中的获取的上一次登陆时间赋给$_SESSION['lasttime']
                        $_SESSION['lasttime'] = $result['lasttime'];
                    }
                    //将登录成功后的事件$nowtime存入到数据表总的上一次登录时间字段
                    $sql = "update users set lasttime = '{$nowtime}' where id = {$_SESSION['userId']}";
                    $sqlOperation->updateUsersData($sql);
                    $time = 0;
                    // 用户点击了记住密码
                    if ($_POST['radioState'] === "true") {
                        $time = time() + 3600; // 设置cookie
                    } else {
                        $time = time() - 3600; // 消除cookie
                    }
                    setcookie("radioState", true, $time);               
                    setcookie("abc", $_POST['account'], $time);
                    setcookie("hasdf", $passwordTemp, $time);
                    echo json_encode(array(
                        "status" => 3
                    )); // 登陆成功
                } else {
                    echo json_encode(array(
                        "status" => 1
                    )); // 表示密码不正确
                }
            } else {
                echo json_encode(array(
                    "status" => 0
                )); // 表示账户不正确
            }
        } else 
            if (! empty($_POST['type']) && $_POST['type'] === "user"){  //用戶个人界面用户的信息获取
            $sql = "select account,nickname,headimg,name,idcard,sex,birthdate,address,school,institute,major,iphone,QQ,wchat from users where id = {$_SESSION['userId']}";
            $result = $sqlOperation->getUsersData($sql);
            array($result);
            echo json_encode($result);
        }else 
            if (! empty($_POST['type']) && $_POST['type'] === "attendancerecord") { // 进行考勤记录的获取
                $array = array();
                if (empty($_SESSION['status'])) { // 判断是否是第一次请求考勤记录的数据
                    $sql = "select * from attendancerecord where id = {$_SESSION['userId']} order by time desc";
                    // 将考情记录数据储存在session里面
                    $_SESSION['AttendancerecordData'] = $sqlOperation->getAttendancerecordData($sql);
                    // 储存考勤记录的条数
                    $_SESSION['rows'] = $sqlOperation->getAttendancerecordRows($sql);
                }
                // 储存当前请求记录的行数
                $_SESSION['currentRow'] = (intval($_POST['currentPage']) - 1) * 8;
                if ($_SESSION['currentRow'] + 8 <= $_SESSION['rows']) { // 当请求的记录数不超过总的记录数
                    for ($i = 0; $i < 8; $i ++) {
                        $array[$i] = $_SESSION['AttendancerecordData'][$_SESSION['currentRow'] ++];
                    }
                } else { // 当请求的记录数超过总的记录数
                         // 计算最后还剩多少条
                    $num = $_SESSION['rows'] - $_SESSION['currentRow'];
                    for ($i = 0; $i < $num; $i ++) {
                        $array[$i] = $_SESSION['AttendancerecordData'][$_SESSION['currentRow'] ++];
                    }
                }
                // 请求一次后将$_SESSION['status']设为ok 防止下次请求 再从数据库里面读数据
                //$_SESSION['status'] = "ok";
                array_push($array, $_SESSION['rows']);
                echo json_encode($array);
            } else 
                if (! empty($_POST['type']) && $_POST['type'] === "sign") {  //注册
                    $sql = "select password from users where account = '{$_POST['account']}'";
                    $temp = $sqlOperation->verifyUser($sql);
                    if (! empty($temp)) {
                        echo json_encode(array(
                            "status" => 0
                        ));
                    } else {
                        echo json_encode(array(
                            "status" => 1
                        ));
                    }
                } else 
                    if (! empty($_POST['type']) && $_POST['type'] === "identifyingCode") {  //二维码
                        if ($_POST['identifyingCode'] === $_SESSION['identifyingCode']) {
                            echo json_encode(array(
                                "status" => 1
                            ));
                        } else {
                            echo json_encode(array(
                                "status" => 0
                            ));
                        }
                    }else if(! empty($_POST['type']) && $_POST['type'] === "course"){  //课程表
                        $week = intval($_POST['week']);
                        $sql = "select  course1,course2,course3,course4 from courses where major = '{$_SESSION['major']}' and week = {$week} ";
                        $temp1 = $sqlOperation->getCoursesData($sql);
                        $dateTime = date("Y-m-d",time());
                        $sql = "select course,state from coursestate where id = {$_SESSION['userId']} and dateTime = '{$dateTime}'";
                        $temp2 = $sqlOperation->getCoursestateData($sql);
                        $array = array();
                        array_push($array, $temp1);
                        array_push($array, $temp2);
                        echo json_encode($array);
                    }
}else if(! empty($_POST['status']) && $_POST['status'] === "insert"){
      if(! empty($_POST['type']) && $_POST['type'] === "sign"){  //用户注册
          $password = md5($_POST['password']);
          $sql = "insert into users(account,password,iphone) values('{$_POST['account']}','{$password}','{$_POST['iphone']}')";
          if($sqlOperation->insertUsersData($sql)){
              echo json_encode(array(
                  "status" => 1
              ));
          }else{
              echo json_encode(array(
                  "status" => 0
              ));
          }
      }else if(! empty($_POST['type']) && $_POST['type'] === "kaoqing"){ //向考勤记录表添加数据
          $kaoqingtime = date("Y-m-d H:i:s",time());
          $sql = "insert into attendancerecord values({$_SESSION['userId']},'{$kaoqingtime}','{$_POST['adress']}',{$_POST['state']},'{$_POST['coursesname']}') ";
          if($sqlOperation->insertAttendancerecord($sql)){
              echo json_encode(array(
                  "status" => 1
              ));
          }else{
              echo json_encode(array(
                  "status" => 0
              ));
          }
          
      }else if(! empty($_POST['type']) && $_POST['type'] === "coursestate"){  //向课程状态表添加数据
          $time = date("Y-m-d",time());
              echo json_encode(array(
                  "status" => 1
              ));
          }else{
              echo json_encode(array(
                  "status" => 0
              ));
          }
}else if(! empty($_POST['status']) && $_POST['status'] === "update"){
    //用户个人资料的修改
    if(! empty($_POST['type']) && $_POST['type'] === "userall"){
        $sql = "update users set";
        if(!empty($_POST['name'])){  //如果修改了名字就修改名字
            $sql .=" name = '{$_POST['name']}',";   
        }
        if(!empty($_POST['idcard'])){  //如果修改了身份证就修改身份证
            $sql .=" idcard = '{$_POST['idcard']}',";
        }
        $_SESSION['major'] = $_POST['major'];
        $sql .= " sex = '{$_POST['sex']}',birthdate = '{$_POST['birthdate']}',address = '{$_POST['adress']}',school = '{$_POST['school']}',institute = '{$_POST['institute']}',major = '{$_POST['major']}',iphone = '{$_POST['iphone']}',QQ = '{$_POST['QQ']}',wchat = '{$_POST['wchat']}'  where id = {$_SESSION['userId']} ";
       if($sqlOperation->updateUsersData($sql)){
            echo json_encode(array("status"=>1));
        }else{
            echo json_encode(array("status"=>0));
        }
    }else if(! empty($_POST['type']) && $_POST['type'] === "nickname"){ //修改昵称
        $sql = "update users set nickname = '{$_POST['data']}' where id = {$_SESSION['userId']}";
        if($sqlOperation->updateUsersData($sql)){
            echo json_encode(array("status"=>1));
        }else{
            echo json_encode(array("status"=>0));
        }
    }else if(! empty($_POST['type']) && $_POST['type'] === "coursestate"){  //修改课程状态表
        $time = date("Y-m-d",time());
        $sql = "update coursestate set state = {$_POST['state']} where id = {$_SESSION['userId']} and dateTime = '{$time}'";
        if($sqlOperation->updateCoursestateData($sql)){
            echo json_encode(array(
                "status" => 1
            ));
        }else{
            echo json_encode(array(
                "status" => 0
            ));
        }
    }else if(! empty($_POST['type']) && $_POST['type'] === "headimg"){    //修改头像 
        $sql = "update users set headimg = '{$_POST['headimgsrc']}' where id = {$_SESSION['userId']}";
        if($sqlOperation->updateCoursestateData($sql)){
            echo json_encode(array(
                "status" => 1
            ));
        }else{
            echo json_encode(array(
                "status" => 0
            ));
        }
    }else if(! empty($_POST['type']) && $_POST['type'] === "logout"){  //注销
        $_SESSION['userId'] = "";
        $_SESSION['major'] = "";
        echo json_encode(array(
            "status" => 1
        ));
    }else if(! empty($_POST['type']) && $_POST['type'] === "pwd"){  //修改密码
        $password = md5($_POST['pwd']);
        $sql = "update users set password = '{$password}' where id = {$_SESSION['userId']}";
        if($sqlOperation->updateCoursestateData($sql)){
            $_SESSION['userId'] = "";
            $_SESSION['major'] = "";
            if (!empty($_COOKIE['radioState'])) {
                $time = time() - 3600; // 设置cookie
                setcookie("radioState", true, $time);
                setcookie("abc", " ", $time);
                setcookie("hasdf", "", $time);
            }
           
            echo json_encode(array(
                "status" => 1
            ));
        }else{
            echo json_encode(array(
                "status" => 0
            ));
        }
    }
}
?>