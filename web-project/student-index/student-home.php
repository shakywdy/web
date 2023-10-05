<?php
require_once '../control.php';
studentchecklogin();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $db = loadingdb();
  $sql = "SELECT programe FROM students WHERE id = $user_id";
  $result = mysqli_query($db, $sql);
  // get now student program
  $row = mysqli_fetch_assoc($result);
  $userProgram = $row['programe'];

  // search  same thing program student
  $sql = "SELECT name FROM students WHERE programe = '$userProgram' AND id != '$user_id'";
  $result = mysqli_query($db, $sql);

  //html  output
  $nameList = '';
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $nameList .= "<li>$name</li>";
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

        <div class="right-card">

        </div>
   

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
</html>