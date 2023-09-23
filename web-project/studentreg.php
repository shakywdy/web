<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-09-21 20:56:26
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-09-23 14:12:31
 * @FilePath: \web-project\studentreg.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */
require_once 'control.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $name = $_POST['id'];
    $id = $_POST['name'];
    $year = $_POST['year'];
    $programe = $_POST['programe'];
    $password = $_POST['password'];
    studentreg($name, $id, $year, $programe, $password);
}

// 2023/923 remember add  bootstrap alret  for id =id
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
       <!-- bootstrap 5 end-->
       <link rel="stylesheet" type="text/css" href="css/studentreg.css">
    <title>Document</title>
</head>
<body>
<header>
<img src="hsu-photo/hsulogo.png" alt="">
</header>
    <div class="form-container">

    <form class="row g-5 needs-validation" method="POST" novalidate>
        
    <div class="tittle">Register</div>

  <div class="col-md-6 position-relative">
    <label for="name" class="form-label">Name</label>
    <input  type="text" name="name" id="name" class="form-control"  required>
    <div class="invalid-tooltip">
        Please choose a unique and valid username.
      </div>
  </div>
  
  <div class="col-md-6 position-relative">
  <label for="id" class="form-label">Student ID</label>
  <input type="text" name="id" id="id" class="form-control" pattern="\d{6}" maxlength="6" required>
  <div class="invalid-tooltip">
    Please enter a unique and valid student ID with six digits.
  </div>
  <div id="passwordHelpBlock" class="form-text">
    Please enter the last six digits of the student number.
  </div>
</div>
  
<div class="col-md-6 position-relative">
  <label for="password" class="form-label">Password</label>
  <input type="password" name="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" required>
  <div id="passwordMismatchTooltip" class="invalid-tooltip">
    The passwords do not match.
  </div>
  <div id="passwordHelpBlock" class="form-text">
    Your password must be 8-20 characters long.
  </div>
</div>

<div class="col-md-6 position-relative">
  <label for="password2" class="form-label">Confirm Password</label>
  <input type="password" name="password2" id="password2" class="form-control" aria-describedby="passwordHelpBlock" required>
  <div class="invalid-tooltip">
    The passwords do not match.
  </div>
</div>

  <div class="col-md-6 position-relative">
    <label for="programe" class="form-label">Programe</label>
    <input   type="text" name="programe" id="programe" class="form-control" aria-describedby="passwordHelpBlock" required>
    <div class="invalid-tooltip">
        Please choose a unique and valid username.
      </div>
      <div id="passwordHelpBlock" class="form-text">
      Please write down your college and subject. For example, BSC-AC
     </div>
  </div>

  <div class="col-md-6 position-relative">
  <label for="year" class="form-label">Select Year</label>
  <select name="year" id="year" class="form-select" required>
    <option value="" selected disabled>Choose...</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
  </select>
  <div class="invalid-tooltip">
    Please select a valid year.
  </div>
</div>


    <button class="btn btn-primary" type="submit" value="Submit">Submit form</button>

</form>
</div>
    
<!-- <form method="POST" >
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
</form> -->
</body>
</html>
<script>
  // 获取所有需要验证的表单元素
  const form = document.querySelector('.needs-validation');

// 添加提交表单时的事件监听器
form.addEventListener('submit', function(event) {
  if (!form.checkValidity() || !checkPasswordMatch()) {
    event.preventDefault(); // 阻止表单提交
    event.stopPropagation(); // 停止事件传播
  }

  form.classList.add('was-validated'); // 添加'was-validated'类，用于显示验证错误信息
}, false);

const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const passwordMismatchTooltip = document.getElementById('passwordMismatchTooltip');

password2.addEventListener('input', () => {
  checkPasswordMatch();
});

function checkPasswordMatch() {
  if (password.value !== password2.value) {
    password2.classList.add('is-invalid');
    passwordMismatchTooltip.style.display = 'block';
    return false;
  } else {
    password2.classList.remove('is-invalid');
    passwordMismatchTooltip.style.display = 'none';
    return true;
  }
}
</script>
<script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.bundle.min.js" ></script>