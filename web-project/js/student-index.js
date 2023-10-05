/*
 * @Author: shaky
 * @Date: 2023-09-26 23:45:57
 * @LastEditTime: 2023-09-28 11:48:22
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
  
  const verticalOffset = 250; 
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
      // success
      $('#message-list li[data-id="' + employeeId + '"]').remove();
      var liCount = $('#message-list li').length;
      if (liCount === 0) {
        console.log(liCount);
        $('#message-list').after('<p>You didn\'t get the notification</p>');
      }
    },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });
}