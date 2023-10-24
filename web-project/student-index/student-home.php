<?php
/*
 * @Author: shaky shaky
 * @Date: 2023-10-05 19:46:42
 * @LastEditors: Please set LastEditors
 * @LastEditTime: 2023-10-24 00:03:39
 * @FilePath: /web-project/student-index/student-home.php
 * @Description: 
 * 
 * Copyright (c) 2023 by xxx, All Rights Reserved. 
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
  $sql = "SELECT name,id,programe FROM students WHERE programe = '$userProgram' AND id != '$user_id'";
  $result1 = mysqli_query($db, $sql);
  $row_first = mysqli_fetch_assoc($result1);
  $rowid = $row_first['id'];
  $rowpg = $row_first['programe'];

  //if friends
  $sql_second = "SELECT name, id
               FROM students
               WHERE programe = '$userProgram' AND id != '$user_id' AND id 
               NOT IN 
               (
                   SELECT friendid
                   FROM friends
                   WHERE studentid = '$user_id' AND friendid = '$rowid'
               )";
  $result = mysqli_query($db, $sql_second);
  //fd
 
  $fd ="SELECT friendid FROM friends WHERE studentid = '$user_id' ";
  $fdcount = mysqli_query($db, $fd);
  $fdcard = '';
  while ($fdrow = mysqli_fetch_assoc($fdcount)) 
  {
    $frid = $fdrow['friendid'];
    $fdname = "SELECT id,name FROM students WHERE id = '$frid'";
    $scu = mysqli_query($db, $fdname);
    $fddtrow = mysqli_fetch_assoc($scu);
    $pyid = $fddtrow['id'];
    $pynm = $fddtrow['name'];
    $fdds = "SELECT id, date, name, content,type,filename,filetype,filesize,link FROM discussion WHERE id='$frid'";
    $fdstext = mysqli_query($db, $fdds);
  while ($fdrow = mysqli_fetch_assoc($fdstext)) 
  {
    if($fdrow['type']== 0){
    $fddis .= ' <div class="fd-message">
               <span class="time-text">' . $fdrow['date'] . '</span>
              <span class="fd-message-span">' . $fdrow['name'] . '</span>
                <div class="fd-message-div">
                   <span class="fd-message-div-span">' . $fdrow['content'] . '</span>
               </div>
               </div>';
    } 
    else{
    $fddis .= ' <div class="fd-message">
     <span class ="time-text">' . $fdrow['date'] . '</span>
     <span class="fd-message-span">' . $fdrow['name'] . '</span>
     <div class="fd-message-div">
       <span class="fd-message-div-span">' . $fdrow['content'] . '
       <button class="down-file" id="' . $fdrow['link'] . '" onclick="downloadFile(this.id)">
      <div class="down-file-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
      <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
      <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
      </svg>
      </div>
      <div class="down-file-info">
      <div class="dont-file-info-name">
      <span>' . $fdrow['filename'] .'</span>
      </div>
      <div class="dont-file-info-for">
      <span>' . $fdrow['filetype'] .' </span>—<span>' . $fdrow['filesize'] .' </span> 
      </div>
      </div>
    </button>
    </span>
        </div>
    </div>';
  }
 }
   $fdcard .= '<button class="left-top-right-card" id="'.$pynm.'" onclick="sendechat('.$pyid.', \''.$pynm.'\')">
    <div class="card-icon-name"></div>           
    <div class="card-name">'.$pynm.'</div>
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-envelope-plus" viewBox="0 0 16 16">
     <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
     <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
     </svg>
   </button>';
  }
  if (empty($fdcard)) {
   $fdcard =' 
   <div class ="nofd">
    <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
    </svg>
    <span>Go ahead and add friends! </span>
    </div>
   ';
  }
  //dis
  $medis = '';
  $mds = "SELECT id, date, name, content,type,filename,filetype,filesize,link FROM discussion WHERE id='$user_id'";
  $mdstext = mysqli_query($db, $mds);
  
  while ($mdrow = mysqli_fetch_assoc($mdstext)) {
    if($mdrow['type']==0){
      $medis .= '  <div class="me-message">
      <span class="time-text">' . $mdrow['date'] . '</span>
      <span class="me-message-span">' . $mdrow['name'] . '</span>
      <div class="me-message-div">
      <span class="me-message-div-span"> ' . $mdrow['content'] . '</span>
      </div>
      </div>';
    } 
    else 
    {
     $medis .= ' <div class="me-message">
     <span class ="time-text">' . $mdrow['date'] . '</span>
     <span class="me-message-span">' . $mdrow['name'] . '</span>
     <div class="me-message-div">
       <span class="me-message-div-span">' . $mdrow['content'] . '
       <button class="down-file" id="' . $mdrow['link'] . '" onclick="downloadFile(this.id)">
      <div class="down-file-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
      <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
      <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
      </svg>
      </div>
      <div class="down-file-info">
      <div class="dont-file-info-name">
      <span>' . $mdrow['filename'] .'</span>
      </div>
      <div class="dont-file-info-for">
      <span>' . $mdrow['filetype'] .' </span>—<span>' . $mdrow['filesize'] .' </span> 
      </div>
      </div>
    </button>
    </span>
        </div>
    </div>';
   }  
  }
  //html  output
  $nameList = '';
  while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $friendid =$row['id'];
    $sql2 = "SELECT * FROM temp WHERE (studentid='$user_id'or friendid='$user_id') AND (friendid='$friendid' or studentid ='$friendid')";
    $result2 = mysqli_query($db, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    
    if (isset($row2) && isset($row2['friendid']) && ($friendid == $row2['friendid'] || $friendid == $row2['studentid'])) 
    {
      $nameList .= '<div class="wait-card">
      <svg class="right-card-svg"xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
      </svg>
      <div class="card-info"><a>' . $name . '</a>
<span>Wait for a response</span>
</div>
     <div class="sendbutton">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-hourglass" viewBox="0 0 16 16">
              <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702c0 .7-.478 1.235-1.011 1.491A3.5 3.5 0 0 0 4.5 13v1h7v-1a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351v-.702c0-.7.478-1.235 1.011-1.491A3.5 3.5 0 0 0 11.5 3V2h-7z" />
          </svg>      
      </div>
  </div>';
  }
    else{
      $nameList .= '<button class="right-card" onClick="sendthis(' . $friendid . ', \'' . $username . '\', \'' . $user_id . '\')">
      <svg class="right-card-svg"xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
      </svg>
      <div class="card-info"><a>' . $name . '</a>
    <span>From the: <span>' . $rowpg . '</span></span>
  </div>
 
  <div class="sendbutton" >
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
        </svg>
  </div>
       </button>';
  }
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
   <!-- send email -->
  <div class="email-box" id="email-box">
    <div class="email-box-container">
     <div class="to-box">
     <h4>Addressee:</h4><h3 id ="toname">123</h3><span id ="toid">123</span>
     </div>
     <textarea class="email-textarea" id="email-textarea"></textarea>
     <button class="email-chancel" onclick="closechat()">
      CHANCEL
     </button>
    <?php echo '<button class="email-send" id="email-send" onclick="sendsl('.$user_id.', \''.$username.'\', \''.$pynm.'\', \''.$pyid.'\')">SEND</button>';?>

     </button>
    </div>
  </div>

  <div class="container">
    <!-- left -->
<div class="top">
    <div class="left-top">
        <div class="left-top-right">
            <div class="left-top-right-hd">
                <span>Your Friends</span>
            </div>

            <div class="search-box">     
              <div class="search-container">
              <svg class="search-logo" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
              <input class="search-input"type="text" id="search-fd" oninput="searchfd()" placeholder="Search">
              <button class="del-search" id="del-search">
                X
                </button>
              </div>
            </div>
            
            <div class="left-top-right-content">
                <?php echo $fdcard; ?>
            </div>

        </div>

        <div class="left-top-left">
            <div class="left-top-header">Discussion room</div>
            <div class="left-top-left-content" id="lef-top-left-content">
                <?php echo $fddis; ?>
                <?php echo $medis; ?>  




 <!-- 下載button 按鈕 10/11              -->

      

 
            </div>
            <div class="left-top-left-input">
              <div class="input-area">
                <div class="text-area" id="text-area">              
              <textarea id="text-input"></textarea>    
            
                      
              </div>
              <!-- del file  -->
              <button class="del-file-button" id="del-file-button" onclick="chancelfile()">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="125" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
              <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
              <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
              </svg>
              </button>
              <!-- del file end -->
              
              <!-- add file -->
              <button class="file-button" id="file-button">
              <input type="file" id="file-input">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
              </svg>
             </button>
              <!-- add file  end-->
              <button class="me-send-button" id="me-send-button"  onclick="sendchat('<?php echo $user_id;  ?>', '<?php echo $username; ?>')">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
             <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
             </svg>
              </button>
             <!-- send file button -->
              <button class="file-me-send-button" id="file-me-send-button" onclick ="sendfile('<?php echo $user_id;  ?>', '<?php echo $username; ?>')">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
             <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
             </svg>
              </button>
             <!-- send file button -->
              </div>
            </div>
        </div>


        <div class="right-top">
            <div class="right-top-header">Friend Suggest</div>

            <div class="right-top-content" id="right-top-content">


                <?php echo $nameList; ?>



            </div>

        </div>

    </div>

</div>

</div>
  <footer>
   
   </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/student-home.js"></script>

</html>
