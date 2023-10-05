<!--
/*
 * @Author: shaky
 * @Date: 2023-09-26 23:45:57
 * @LastEditTime: 2023-10-05 14:51:38
 * @FilePath: /web-project/student-index.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
 
-->

<!-- // require_once 'control.php';
// studentchecklogin() -->
<?php
require_once 'control.php';
studentchecklogin();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];

  $db = loadingdb();
  // get name
  $query = "SELECT name FROM students WHERE id = '$user_id'";
  $result = mysqli_query($db, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $studentName = $row['name'];
    // content
    $queryContent = "SELECT id,content,name FROM message WHERE studentid = '$user_id'";
    $resultContent = mysqli_query($db, $queryContent);

  }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
     <!-- bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="css/student-index.css">
	</head>
	<body>

    <!-- header -->
    <div class="top">
      <!-- green -->
       <div class="top-left"></div>
        <!-- green end-->

        <!-- yellow -->
       <div class="top-right">
       <button class="message-button" >
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
        </svg>
        </button>
      <!-- yellow end-->

        <!-- message-box -->
        <div class="message-box" >
          <div class="message-box-header">
           <p>Notification</p> 
           <button class="close-button">X</button>
          </div>
          <div class="message-box-content">
            
              <!-- li list -->
              <?php
              if (mysqli_num_rows($resultContent) > 0) {
                while ($row = mysqli_fetch_assoc($resultContent)) {
                  echo '<ul id="message-list"><li data-id="' . $row['id'] . '">
                  <div>
                 <span>Be from:' . $row['name'] . '</span>
                ' . $row['content'] . '
                 </div> <button onClick="delthis(' . $row['id'] . ')" class="delete-button">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                 <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                 <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                 </svg></button></li>  </ul>';
                }
              } 
              else 
              {
                echo '<p>You didn\'t get the notification</p>';
              }
              ?>
          
          </div>
        </div>
        
        <!-- message-box end-->

        <!-- info setting -->
        <div class="btn-group">
          <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $studentName . ' ' . $user_id; ?>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log out</a></li>
          </ul>
        </div>
         <!-- info setting end-->
       </div>
      <!-- yellow end-->

    </div>
    <!-- header end -->

    <!-- this is a left list -->
    <div class="left-box">
    <div class="left">
      <div class="leftheader">    
      <img src="hsu-photo/hsulogo.png" >
     </div>
      <div class="left-list">
      <button>
      <a href="">HOME</a>
        </button>  
        <button>
        <a href="">CALENDAR</a>
        </button>
        <button>
        <a href="">LEARNING</a>
        </button>
        <button>
        <a href="">PARTNER</a>
        </button>
      </div>
      <button class="lgb">
        <a href="">Log out</a>
        </button>
    </div> 
    </div>
	 <div class="right">
      <div class="right-main">
        <iframe src="student-index/student-home.php"></iframe>
      </div>

     </div> 
        <!-- this is a left list end -->
	</body>
  <script src="js/student-index.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>

