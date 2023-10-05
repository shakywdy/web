<?php
/*
 * @Author: shaky
 * @Date: 2023-09-27 15:56:31
 * @LastEditTime: 2023-10-06 02:09:49
 * @FilePath: \web-project\date-control.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
// delete.php

if(isset($_POST['employeeId'])){
    $employeeId = $_POST['employeeId'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $deleteQuery = "DELETE FROM message WHERE id = '$employeeId'";
    // del database message
    mysqli_query($db, $deleteQuery);
    mysqli_close($db);
}
if (isset($_POST['messageid']) && isset($_POST['messagename'])) {
    $id = $_POST['messageid'];
    $user_name = $_POST['messagename'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $query = "SELECT MAX(id) AS max_id FROM message";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $newId = $row['max_id'] + 1;

    $studentId = $id;
    $content = 1;
    $type = 1;
 
    // 执行插入操作
    $sql = "INSERT INTO message (id, studentid, content, name, type) VALUES ('$newId', '$studentId', '$content', '$user_name', '$type')";
    if ($db->query($sql) === TRUE) {
        echo "插入数据成功";
    } else {
        echo "插入数据失败: " . $db->error;
    }

    mysqli_close($db);
}
?>