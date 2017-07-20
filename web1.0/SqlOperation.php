<?php

class SqlOperation
{

    private $mysqli = NULL;

    function __construct($locahost, $account, $pwd, $datebase)
    {
        $mysqli = new mysqli($locahost, $account, $pwd, $datebase);
        $mysqli->set_charset("utf8");
        $this->mysqli = $mysqli;
    }
    
    //用于用户登录的验证和注册时的验证
    function verifyUser($sql){
        $result = $this->mysqli->query($sql);
        $array = $result->fetch_assoc();
        return $array;
    }
    
    //获取用户的全部信息
    function getUsersData($sql)
    {
        $result = $this->mysqli->query($sql);
        $array = $result->fetch_assoc();
        return $array;
    }
    
    //获取考勤记录的数据
    function getAttendancerecordData($sql){
        $arrayResult = array();
        $result = $this->mysqli->query($sql);
        while ($array = $result->fetch_assoc()){
           array_push($arrayResult,$array);
        }
        return $arrayResult;
    }
    
    //获取考勤记录的条数
    function getAttendancerecordRows($sql){
        $result = $this->mysqli->query($sql);
        $rows = $result->num_rows;
        return $rows;
    }
    
    //向靠清表中添加数据
    function insertAttendancerecord($sql){
        $result = $this->mysqli->query($sql);
        return $result;
        $this->mysqli->close;
    }
    
    //修改用户表中的信息
    function updateUsersData($sql){
        $result = $this->mysqli->query($sql);
        return $result;
    }
    
    //向用户表中添加信息
    function insertUsersData($sql){
        $result = $this->mysqli->query($sql);
        return $result;
        $this->mysqli->close;
    }
    
    //获取课程表中的信息
    function getCoursesData($sql){
        $result = $this->mysqli->query($sql);
        $array = $result->fetch_assoc();
        return $array;
    }
    
    //获取课程状态表中的数据
    function getCoursestateData($sql){
        $arrayResult = array();
        //$lastResults = array();
        $result = $this->mysqli->query($sql);
        if(!empty($result)){
            while ($array = $result->fetch_assoc()){
                array_push($arrayResult,$array);
            }
        }
     
        return $arrayResult;
    }
    
    //向课程状态表中添加数据
    function insertCoursestateData($sql){
        $result = $this->mysqli->query($sql);
        return $result;
    }
    
    //修改课程状态表中的数据
    function updateCoursestateData($sql){
        $result = $this->mysqli->query($sql);
        return $result;
    }
}
?>