<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:26:54
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-26 14:52:46
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
    if ($db->error) {
        die("Connection failed: " . $db->error);
    }
    return $db;
}

// 

function studentreg($id, $name, $year, $programe, $password)
{
    $db = loadingdb();

    // 检查是否存在相同的学生ID
    $checkSql = "SELECT id FROM students WHERE id = '$id'";
    $result = $db->query($checkSql);

    if ($result->num_rows > 0) {
        // 存在相同的学生ID，处理失败情况
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var errorMessage = document.querySelector(".error-message");
            errorMessage.style.display = "block";
        });
        </script>';

        return;
    }

    // 将学生信息插入学生表
    $sql = "INSERT INTO students (id, name, year, programe, password) 
    VALUES ('$id', '$name', '$year', '$programe', '$password')";
    if ($db->query($sql) === TRUE) {
        // 获取刚插入的学生ID
        $id = $db->insert_id;
        
        // 将学生的学号和密码插入用户表
        $type = 'student';
        $userSql = "INSERT INTO users (id, password, type) 
        VALUES ('$id', '$password', '$type')";
      
        if ($db->query($userSql) === TRUE) {

            $db->close(); 
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var errorMessage = document.querySelector(".error-message");
                errorMessage.style.display = "block";
            });
        </script>';

         
        } 
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
    elseif ($type == 'staff'){
        session_start();
        $_SESSION['user_id'] = $id;
        header("Location: staff-index.php");

    }

    mysqli_close($db);
}
function studentchecklogin()
{
    session_start();
    if (!isset($_SESSION['user_id'])) {
   
        header("Location: home.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];

    $db = loadingdb();
    $query = "SELECT type FROM users WHERE id = '$user_id'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
   
    if ($row['type'] !== 'student') {
        header("Location: home.php"); 
        exit();
    }
}