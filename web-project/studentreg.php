<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:56:26
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-22 13:02:16
 * @FilePath: \web-project\studentreg.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */
require_once 'control.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_POST['name'];
    $id = $_POST['id'];
    $year = $_POST['year'];
    $programe = $_POST['programe'];
    $password = $_POST['password'];
    studentreg($name, $id, $year, $programe, $password);
}

?>


<form method="POST" >
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">
    
    <label for="id">Student ID:</label>
    <input type="text" name="id" id="id">
    
    <label for="year">Year:</label>
    <input type="text" name="year" id="year">
    
    <label for="programe">Programme:</label>
    <input type="text" name="programe" id="programe">

    <label for="password">Programme:</label>
    <input type="password" name="password" id="password">
    
    <input type="submit" value="Submit">
</form>