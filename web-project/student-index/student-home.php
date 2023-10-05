<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-10-05 19:46:42
 * @LastEditors: shaky shaky
 * @LastEditTime: 2023-10-06 02:29:05
 * @FilePath: \web-project\student-index\student-home.php
 * @Description: 
 * 
 * Copyright (c) 2023 by ${git_name_email}, All Rights Reserved. 
 */
require_once '../control.php';
studentchecklogin();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $db = loadingdb();
  $sql = "SELECT name,programe FROM students WHERE id = $user_id";
  $result = mysqli_query($db, $sql);
  // get now student program
  $row = mysqli_fetch_assoc($result);
  $userProgram = $row['programe'];
  $username=$row['name'];



  // search  same thing program student
  $sql = "SELECT name,id FROM students WHERE programe = '$userProgram' AND id != '$user_id'";
  $result = mysqli_query($db, $sql);

  //html  output
  $nameList = '';
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];

    $nameList .= '<div class="right-card">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
    </svg>
    <span>' . $name . '</span>
    <button onClick="sendthis(' . $row['id'] . ', \'' . $username . '\')" >
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
    </button>
</div>';
  }

  mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/student-home.css">
    <title>Document</title>
</head>
<body>
  <div class="container"> 
    <!-- left -->
    <div class="left">
     <div class="left-top">
      <div class="left-top-header">Calenda</div> 
     </div>
     <div class="left-end">

     </div>
    </div>
    <!-- left  end -->
    <!-- right -->
    <div class="right">
      <div class="right-top">
       <div class="right-top-header">Friend Suggest</div> 
      
       <div class="right-top-content">



       <?php echo $nameList; ?>
      
   
       </div>

      </div>

      <div class="right-end">
        <div class="right-end-header">Deadlines</div>
      </div>
    </div>
     <!-- right end -->
  </div>
  <footer>
   
   </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  function sendthis(messageid,messagename) {
    $.ajax({
    url: "../date-control.php",
    type: "POST",
    data: {
      messageid:messageid,
      messagename:messagename
    },
    success: function (response) {
      console.log("good");
      console.log(messagename);
    },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });
  }
  </script>
</html>