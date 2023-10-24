/*
 * @Author: shaky
 * @Date: 2023-09-26 23:45:57
 * @LastEditTime: 2023-10-23 01:14:29
 * @FilePath: /web-project/js/student-index.js
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */

const messageButton = document.querySelector('.message-button');
const messageBox = document.querySelector('.message-box');
const hideButton = document.querySelector('.close-button');

messageButton.addEventListener('click', function() {
  const buttonRect = messageButton.getBoundingClientRect();
  const buttonTop = buttonRect.top;
  const buttonLeft = buttonRect.left;
  const buttonWidth = buttonRect.width;
  
  const verticalOffset = 280; 
  messageBox.style.top = `${buttonTop + buttonRect.height + verticalOffset}px`;
  messageBox.style.left = `${buttonLeft + buttonWidth / 2}px`;

  messageBox.style.display = 'flex';
});

hideButton.addEventListener('click', function() {
  messageBox.style.display = 'none';
});
///del message
function delthis(employeeId) {
  $.ajax({
    url: "./date-control.php",
    type: "POST",
    data: {
      employeeId: employeeId
    },
    success: function (response) {
      $('#message-box-content').load(location.href + ' #message-box-content > *', function() {
     var remoteContent = $('#message-box-content').html();
     $('#message-box-content').html(remoteContent);
   })
     },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });
}


function addfd(userid,fdid) {

  $.ajax({
    url: "./date-control.php",
    type: "POST",
    data: {
      userid: userid,
      fdid:fdid
    },
    success: function (response) {
      $('#frame').load(location.href + ' #frame > *', function() {
     var remoteContent = $('#frame').html();
     $('#frame').html(remoteContent);
   })
     },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });


}
function deltemp(tempid,tempfdid) {

  $.ajax({
    url: "./date-control.php",
    type: "POST",
    data: {
      tempid: tempid,
      tempfdid:tempfdid
    },
    success: function (response) {
      $('#frame').load(location.href + ' #frame > *', function() {
     var remoteContent = $('#frame').html();
     $('#frame').html(remoteContent);
   })
     },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });


}
function setRead(number){

  $.ajax({
    url: "./date-control.php",
    type: "POST",
    data: {
      number:number
    },
    success: function (response) {
      $('#mebutton').load(location.href + ' #mebutton > *', function() {
     var remoteContent = $('#mebutton').html();
     $('#mebutton').html(remoteContent);
   })
     },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });
}