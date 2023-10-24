<?php
/*
 * @Author: shaky
 * @Date: 2023-09-19 15:30:55
 * @LastEditTime: 2023-10-09 21:42:20
 * @FilePath: /web-project/home.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
 //924 add check id max six o.0
//  帳號密碼錯誤 提示/註冊id重複提示 o.0
require_once 'control.php';
    if(isset($_POST['loginsubmit'])){
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
        // psw and id error alert
        echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            var errorMessage = document.querySelector(".error-message");
            var alertText = document.getElementById("alerttext");
            if (alertText) {
              alertText.textContent = "Your id and password don\'t match";
            }
            errorMessage.style.backgroundColor = "#f8d7da";
            errorMessage.style.border = "1px solid #f5c6cb";
            errorMessage.style.color = "#721c24";
            errorMessage.style.display = "block";
        });
    </script>';
        mysqli_close($db);
        // 登录成功关闭 SQL 连接在 control.php
    }
    }
    elseif (isset($_POST['regsubmit'])) {   
        $id = $_POST['regid'];
        $name = $_POST['regname'];
        $year = $_POST['regyear'];
        $programe = $_POST['regprograme'];
        $password = $_POST['regpassword'];
        studentreg($id, $name,$year, $programe, $password);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Document</title>
</head>
<body>
    <!-- alert  -->
    <div class="error-message">
      <div class="alert" role="alert"> 
    <strong>Reminders</strong>
    <div id="alerttext">
       
    </div>
    <button type="button" class="btn-close" onclick="hideErrorMessage()" aria-label="Close"></button>
  </div>
  </div>

  <div class="container">
        <div class="form-box">

        
            <!-- register  -->
             <div class="register-box hidden">
                <h1>register</h1>
                <form method="POST" onsubmit="return validateForm()">
                <input type="text" name="regname" id="regname"placeholder="Name"  required>        
                <input type="text" name="regid" id="regid" placeholder="Student id" pattern="\d{6}" maxlength="6" required>
                <input type="password" name="regpassword" id="regpassword" placeholder="Password" required>
                <input type="password"name="regpassword2" id="regpassword2" placeholder="Confirm Password" required>
                <input type="text"name="regprograme" id="regprograme" placeholder="Programme" required>
                <select name="regyear" id="regyear"  required>
                    <option value="" selected disabled>Choose...</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                  </select>
                  <button type="submit"name="regsubmit">SUBMIT</button>
                </form>
            </div>

           <!-- login -->
            <div class="login-box">
                <h1>login</h1>
                <form method="POST">
                <input type="text" name="id" id="id" placeholder="Student id" required>
                <input type="password" name="password" id="password" placeholder="Password"required>    
                <button type="submit" name="loginsubmit" >SUBMIT</button>
            </form>
            </div>
        </div>

        <div class="con-box left">
        <h2>Welcome to <span>Hsu</span></h2>
        <p>Enter the <span>last six </span></p>
        <p>digits of your student ID</p>
        <img src="hsu-photo/hsulogo.png" alt="">
        <p>Already have an account?</p>
        <button id="login">Go to Log in</button>
        </div>

        <div class="con-box right">
            <h2>Welcome to <span>Hsu</span></h2>
            <p>Discover more <span>exciting</span></p>
            <br>
            <p>Student and Staff</p>
            <img src="hsu-photo/hsulogo.png" alt="">
            <p>Don't have an account?</p>
            <button id="reg">Go to Register</button>
            </div>

    </div>
  
</body>
<div id="liveAlertPlaceholder"></div>
<script src="js/home.js"></script>
</html>
