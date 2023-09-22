<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:26:54
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-22 20:43:15
 * @FilePath: \web-project\control.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */

//  database connection

function loadingdb() 
{
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

function studentreg($name, $id, $year, $programe, $password)
{
    $db = loadingdb();

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
            $db->close(); 
            header("Location: login.php");
            exit();
        } else {
            // 处理用户表插入失败的情况
        }
    } else {
        // 处理学生表插入失败的情况
    }
}



function checktype($db, $result, $id)
{
    $row = mysqli_fetch_assoc($result);
    $type = $row['type'];

    if ($type == 'student') {
      
        //session ----- checklogin
        session_start();
        $_SESSION['user_id'] = $id;
        // echo "student";
        // update students last login
        $currentTime = date('Y-m-d H:i:s');
        $insertQuery = "UPDATE students SET lastlogin = '$currentTime' WHERE id = '$id'";
        mysqli_query($db, $insertQuery);


        header("Location: student-index.php");
      
    }

    mysqli_close($db);
}
function studentchecklogin()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
   
        header("Location: login.php");
        exit();
    }
    session_destroy();
}