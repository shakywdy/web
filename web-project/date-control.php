<?php
/*
 * @Author: shaky
 * @Date: 2023-09-27 15:56:31
 * @LastEditTime: 2023-10-07 16:13:20
 * @FilePath: \web-project\date-control.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
// delete.php
//del message
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
//send fd message
if (isset($_POST['messageid']) && isset($_POST['messagename'])&& isset($_POST['userid'])) {
    $id = $_POST['messageid'];
    $user_name = $_POST['messagename'];
    $userid=$_POST['userid'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);

    $studentId = $id;
    $content = 1;
    $type = 1;
    //臨時 發送好友申請o.0
    $sql = "INSERT INTO temp (studentid, friendid) VALUES ('$userid', '$id')";
    $db->query($sql);
    //推送消息
    $sql = "INSERT INTO message (studentid, content, name, type,userid) VALUES ('$studentId', '$content', '$user_name', '$type', '$userid')";
    $db->query($sql);
  
    mysqli_close($db);
}

//confrim fd
if(isset($_POST['userid'])&& isset($_POST['fdid'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $studentId = $_POST['userid'];
    $friendid = $_POST['fdid'];

    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO friends (studentid, friendid) VALUES ('$studentId', '$friendid')";   
    $db->query($sql);

    $sql3 = "INSERT INTO friends (studentid, friendid) VALUES ( '$friendid'), '$studentId'";   
    $db->query($sql3);
    
    $sql2 = "DELETE FROM temp WHERE (studentid='$studentId' OR friendid='$studentId') AND (friendid='$friendid' OR studentid='$friendid')";
    $result2 = mysqli_query($db, $sql2);


    
    mysqli_close($db);
}
?>