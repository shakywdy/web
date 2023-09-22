 <?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 22:32:46
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-22 21:07:05
 * @FilePath: \web-project\login.php
 * @Description: 
 * 
 * Copyright (c) 2023 by $shakywdy@gmail ->, All Rights Reserved. 
 */
require_once 'control.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $password = $_POST['password'];
     // Execute verification password function ~)
     $db = loadingdb();

     // users list use id:name
     $query = "SELECT * FROM users WHERE id = '$id' AND password = '$password'";
     $result = mysqli_query($db, $query);
 
     if (mysqli_num_rows($result) == 1) {
         checktype($db, $result, $id);
        //   call control.php function
     } else {
      
        //  echo "error";
         mysqli_close($db);  
        //  登錄成功關閉sql在control.php
     }
 
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login</title>
</head>

<body>
<a href="studentreg.php"><h1>Sign in</h1></a>

<form method="POST">
    <label for="id">User Id:</label>
    <input type="text" name="id" id="id">

    <label for="password">password:</label>
    <input type="password" name="password" id="password">
    
    <input type="submit" value="Log in">
</form>
</body>
</html>
 
<script>

</script>