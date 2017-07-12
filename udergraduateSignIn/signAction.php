<?php
$account = $_POST['account'];
$password = $_POST['password'];
$iphone = $_POST['iphone'];
@$identifyingCode = $_POST['identifyingCode'];
header("content-type:text/html;charset=utf-8");
$mysql = mysqli_connect("localhost","root","","web");
mysqli_set_charset($mysql, "utf8");
session_start();
if(@$identifyingCode !== $_SESSION['identifyingCode']){
    echo "<script>alert('验证码不对');window.location.href='sign.html';</script>";
}else{
    $sql = "insert into users(account,password,iphone) values('{$account}','{$password}','{$iphone}')";
    $sign = mysqli_query($mysql, $sql);
    mysqli_close($mysql);
    if(!$sign){
        echo "<script>alert('用户名已经存在');window.location.href='sign.html';</script>";
    }else{
        echo "<script>window.location.href='login.php';</script>";
    }
}
