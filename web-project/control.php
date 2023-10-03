<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:26:54
 * @LastEditors: Please set LastEditors
 * @LastEditTime: 2023-10-01 02:03:40
 * @FilePath: /web-project/control.php
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

    return new mysqli($servername, $username, $password, $dbname);
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
            var alertText = document.getElementById("alerttext");
            if (alertText) {
              alertText.textContent = "Your account already exists";
            }
            errorMessage.style.display = "block";
            errorMessage.style.backgroundColor = "#f8d7da";
            errorMessage.style.border = "1px solid #f5c6cb";
            errorMessage.style.color = "#721c24";
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
                var alertText = document.getElementById("alerttext");
                if (alertText) {
                  alertText.textContent = "You can go and log in";
                }
                var alert=document.querySelector(".alert");
                alert.style.backgroundColor = "#d1ffb7";
                alert.style.border = "1px solid #ffffff";
                alert.style.color= "#000000";
                errorMessage.style.display = "block";
                errorMessage.style.backgroundColor = "#d1ffb7";
                errorMessage.style.border = "1px solid #ffffff";
                errorMessage.style.color = "#000000";
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
    
        // update students last login
        $currentTime = date('Y-m-d H:i:s');
        $insertQuery = "UPDATE students SET lastlogin = '$currentTime' WHERE id = '$id'";
        mysqli_query($db, $insertQuery);
        //xml
        $xml = simplexml_load_file("student.xml");
    
        $idExists = false;
        foreach ($xml->student as $student) {
            //if have student
            if ((string) $student->id === $id) {
            //    update new time
                $student->lastlogin = $currentTime;
                $idExists = true;
                break;
            }
        }
    
        if (!$idExists) {
            // 如果 ID 不存在，创建新的 student 元素
            $newStudent = $xml->addChild('student');
            $newStudent->addChild('id', $id);
    
            // 查询学生姓名并添加到 XML 中
            $nameQuery = "SELECT name FROM students WHERE id = '$id'";
            $nameResult = mysqli_query($db, $nameQuery);
    
            if ($nameResult && mysqli_num_rows($nameResult) > 0) {
                $nameRow = mysqli_fetch_assoc($nameResult);
                $newStudent->addChild('name', $nameRow['name']);
            }
    
            $newStudent->addChild('lastlogin', $currentTime);
        }
    
        // 将 XML 数据保存到 student.xml 文件
        $xml->asXML("student.xml");
        header("Location: student-index.php");
    } 
    elseif ($type == 'staff') 
    {
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