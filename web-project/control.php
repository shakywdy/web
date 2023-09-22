<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:26:54
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-22 13:05:59
 * @FilePath: \web-project\control.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */

//  database connection
function loadingdb() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $db = new mysqli($servername, $username, $password, $dbname);
    if ($db->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $db;
}

// 

function studentreg($name, $id, $year, $programe, $password, $db)
{
    // 将学生信息插入学生表
    $sql = "INSERT INTO students (name, id, year, programe, password) 
    VALUES ('$name', '$id', '$year', '$programe', '$password')";
    
    if ($db->query($sql) === TRUE) {
        // 获取刚插入的学生ID
        $id = $db->insert_id;
        
        // 将学生的学号和密码插入用户表
        $type = 'student';
        $userSql = "INSERT INTO users (id, password, type) 
        VALUES ('$id', '$password', '$type')";
        
        if ($db->query($userSql) === TRUE) {
            $db->close(); // 关闭数据库连接
            exit();
        } else {
            // 处理用户表插入失败的情况
        }
    } else {
        // 处理学生表插入失败的情况
    }
}

function checkpassword($id, $password)
{
    $db = loadingdb();

    
    // users list use id:name
    $query = "SELECT * FROM users WHERE id = '$id' AND password = '$password'";

    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $type = $row['type'];

        if ($type == 'student') {
            // 学生账号登录
            echo "学生账号登录";

            // 更新学生最后登录时间
            $currentTime = date('Y-m-d H:i:s');
            $insertQuery = "UPDATE students SET lastlogin = '$currentTime' WHERE id = '$id'";
            mysqli_query($db, $insertQuery);
        } 

        elseif ($type == 'teacher')
         {
     
            echo "老师账号登录";

           
        } 
        else
         {
            // 未知类型账号
            echo "未知类型账号！";
        }
    } 

    else {
        // 用户名和密码不匹配
        echo "用户名和密码不匹配！";
    }

    mysqli_close($db);
}
