<?php
/*
 * @Author: shaky
 * @Date: 2023-09-27 15:56:31
 * @LastEditTime: 2023-09-28 12:06:27
 * @FilePath: /web-project/date-control.php
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
    $user_id = $_SESSION['user_id'];
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $deleteQuery = "DELETE FROM message WHERE id = '$employeeId'";
    // del database message
    mysqli_query($db, $deleteQuery);
    mysqli_close($db);
}
?>