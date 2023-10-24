<?php 
/*
 * @Author: shaky
 * @Date: 2023-10-23 22:01:31
 * @LastEditTime: 2023-10-23 22:28:25
 * @FilePath: /web-project/message.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
if (isset($_POST['userid']) && isset($_POST['username']) && isset($_POST['pyid']) && isset($_POST['pyname']) && isset($_POST['content'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $id = $_POST['pyname'];
    $content = $_POST['content'];
    $name = $_POST['username'];
    $type = 1;
    $userid = $_POST['userid'];
    $currentTime = date('Y-m-d');
    $db = mysqli_connect($servername, $username, $password, $dbname);

    $sql = "INSERT INTO message (studentid, content, name, type, userid, date) VALUES ('$id', '$content', '$name', '$type', '$userid', '$currentTime')";
    $db->query($sql);

    mysqli_close($db);
}
?>