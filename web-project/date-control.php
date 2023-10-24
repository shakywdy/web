<?php
/*
 * @Author: shaky
 * @Date: 2023-09-27 15:56:31
 * @LastEditTime: 2023-10-23 22:27:20
 * @FilePath: /web-project/date-control.php
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
// delete.php
//del message
if(isset($_POST['employeeId'])){
    $employeeId = $_POST['employeeId'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $deleteQuery = "DELETE FROM message WHERE id = '$employeeId'";
    // del database message
    mysqli_query($db, $deleteQuery);
    mysqli_close($db);
}
//send fd message
if (isset($_POST['messageid']) && isset($_POST['messagename'])&& isset($_POST['userid'])) {
   
    $id= $_POST['messageid'];
    $send= $_POST['messagename'];   
    $userid=$_POST['userid'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $content = "Hello, this is $send. I want to be friends with you.";
    $type = 1;
    //臨時 發送好友申請o.0
    $sql = "INSERT INTO temp (studentid, friendid) VALUES ('$userid', '$id')";
    $db->query($sql);
    //推送消息
    frirequest($id,$content,$send,$type,$userid);
    mysqli_close($db);
}
function frirequest($id,$content,$name,$type,$userid){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";

    $currentTime = date('Y-m-d');
    $db = mysqli_connect($servername, $username, $password, $dbname);
     
    $sql = "INSERT INTO message (studentid, content, name, type,userid,date) VALUES ('$id', '$content', '$name', '$type', '$userid', '$currentTime')";
    $db->query($sql);
  
    mysqli_close($db);
}

//confrim fd
if(isset($_POST['userid'])&& isset($_POST['fdid'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $studentId = $_POST['userid'];
    $friendid = $_POST['fdid'];

    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "INSERT INTO friends (studentid, friendid) VALUES ('$studentId', '$friendid')";   
    $db->query($sql);

    $sql3 = "INSERT INTO friends (studentid, friendid) VALUES ( '$friendid', '$studentId')";   
    $db->query($sql3);
    
    $sql2 = "DELETE FROM temp WHERE (studentid='$studentId' OR friendid='$studentId') AND (friendid='$friendid' OR studentid='$friendid')";
    $result2 = mysqli_query($db, $sql2);


    
    mysqli_close($db);
}

if(isset($_POST['tempid'])&& isset($_POST['tempfdid'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $studentId = $_POST['tempid'];
    $friendid = $_POST['tempfdid'];
    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql2 = "DELETE FROM temp WHERE (studentid='$studentId' OR friendid='$studentId') AND (friendid='$friendid' OR studentid='$friendid')";
    $result2 = mysqli_query($db, $sql2);

    
    mysqli_close($db);
}
// read $messageid
if(isset($_POST['number'])){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $studentId = $_POST['number'];

    $db = mysqli_connect($servername, $username, $password, $dbname);
    $sql = "UPDATE message SET readme = 1 WHERE studentid = '$studentId'";
    $result2 = mysqli_query($db, $sql);

    
    mysqli_close($db);
}

// discussion
if (isset($_POST['userid']) && isset($_POST['username']) && isset($_POST['content'])) {
    $userid = $_POST['userid'];
    $name = $_POST['username'];
    $content = $_POST['content'];
    $currentTime = date('Y-m-d H:i:s');
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mydatabase";
    $db = mysqli_connect($servername, $username, $password, $dbname);

    if (isset($_POST['fileName']) && isset($_POST['fileType']) && isset($_POST['fileSize'])) {
        $filename = $_POST['fileName'];
        $filetype = $_POST['fileType'];
        $filesize = $_POST['fileSize'];
        $link = $filename . '.'.$filetype;
        $type = "1";
        
        $sql = "INSERT INTO discussion (content, name, id, date, type, filename, filetype, filesize, link) VALUES ('$content','$name', '$userid', '$currentTime','$type','$filename','$filetype','$filesize','$link')";
    } else {
        $sql = "INSERT INTO discussion (content, name, id, date) VALUES ('$content','$name', '$userid', '$currentTime')";
    }
    
    $db->query($sql);
    mysqli_close($db);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = 'file/'; 
    $targetFile = $targetDirectory . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
      echo 'ok';
    } else {
      echo 'error';
    }
  }
?>
