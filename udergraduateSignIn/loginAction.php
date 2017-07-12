<?php
$account = $_POST['account'];
$password = $_POST['password'];
@$checkbox = $_POST['checkbox'];
header("content-type:text/html;charset=utf-8");
$mysql = mysqli_connect("localhost", "root", "", "web");
mysqli_set_charset($mysql, "utf8");
$sql = "select * from users where account='{$account}' and password='{$password}'";
$result = mysqli_query($mysql, $sql);

if (mysqli_num_rows($result) > 0) {
    if ($checkbox) {
        $time = time() + 3600;
        setcookie("check", "checked", $time);
        setcookie("account", $account, $time);
        setcookie("password", $password, $time);
    } else {
        $time = time() - 3600;
        setcookie("check", "check", $time);
        setcookie("account", $account, $time );
        setcookie("password", $password, $time);
    }
    echo "<script>window.location.href='user.html';</script>";
} else {
    echo "<script>alert('用户名或密码错误');window.location.href='login.php';</script>";
}
mysqli_close($mysql);
