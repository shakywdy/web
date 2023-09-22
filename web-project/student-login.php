<!-- /*
 * @Author: shaky shaky
 * @Date: 2023-09-21 22:32:46
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-21 22:37:04
 * @FilePath: \web-project\student-login.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */ -->
 <?php
require_once 'control.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];
    checkpassword($id, $password);
}
?>

 <form method="POST">
    <label for="id">Student ID:</label>
    <input type="text" name="id" id="id">

    <label for="password">password:</label>
    <input type="password" name="password" id="password">
    
    <input type="submit" value="Submit">
</form>