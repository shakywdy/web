const messageButton = document.querySelector('.message-button');
const messageBox = document.querySelector('.message-box');
const hideButton = document.querySelector('.close-button');

messageButton.addEventListener('click', function() {
  const buttonRect = messageButton.getBoundingClientRect();
  const buttonTop = buttonRect.top;
  const buttonLeft = buttonRect.left;
  const buttonWidth = buttonRect.width;
  
  const verticalOffset = 200; 
  messageBox.style.top = `${buttonTop + buttonRect.height + verticalOffset}px`;
  messageBox.style.left = `${buttonLeft + buttonWidth / 2}px`;

  messageBox.style.display = 'flex';
});

hideButton.addEventListener('click', function() {
  messageBox.style.display = 'none';
});