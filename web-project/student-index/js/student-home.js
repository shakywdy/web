const textcontainer= document.getElementById('text-area');  
const textarea = document.getElementById('text-input');

// auto high 
textarea.addEventListener('input', function() {
textarea.style.height = '22px';
textarea.style.height = textarea.scrollHeight + 'px';
});

// auto high  end

// file 
var fileName;
var fileSize;
var fileType;
var emailBoxContainer = document.getElementById('email-box');
var textInput = document.getElementById('text-input');
const fileButton = document.getElementById('file-button');
const delfileButton = document.getElementById('del-file-button');
const sendButton = document.getElementById('me-send-button');
const sendfilebt = document.getElementById('file-me-send-button');
const fileInput = document.getElementById('file-input');
const email = document.getElementById('email-textarea')
const emailsned = document.getElementById('email-send')
//input button
textInput.addEventListener('input', function() {
if (textInput.value.trim() !== "") {
  sendButton.style.background="#32d674"
  sendfilebt.style.background="#32d674"
}
else{
  sendButton.style.background="#32d6745c"
  sendfilebt.style.background="#32d6745c"
}
});
//email send button
email.addEventListener('input', function() {
    if (email.value.trim() !== "") {
      emailsned.style.background="#32d674"
    }
    else{
      emailsned.style.background="#32d6745c"
    }
    });
//send email
function sendsl(userid,username,pyid,pyname){
const content =email.value;
console.log(userid,username,pyid,pyname,content)
if (content !== "") {
    $.ajax({
      url: "../message.php",
      type: "POST",
      data: {
        userid: userid,
        username: username,
        pyid:pyid,
        pyname:pyname,
        content: content
      },
      success: function(response) {
        $(
            closechat()
        );
      },
      error: function(xhr, status, error) {
        console.log(error)
      }
    });
  }
}
//send email end
function formatFileSize(fileSize) {
  if (fileSize < 1024) {
    return fileSize + ' B';
  } else if (fileSize < 1024 * 1024) {
    const kbSize = Math.floor(fileSize / 1024);
    return kbSize + ' KB';
  } else {
    const mbSize = Math.floor(fileSize / (1024 * 1024));
    return mbSize + ' MB';
  }
}
function sendechat(pyid,pynm){
  
  var id =document.getElementById('toid')
  var name =document.getElementById('toname')
  id.innerHTML="("+pyid+")";
  name.innerHTML=pynm;
  emailBoxContainer.style.display = 'flex';
  emailBoxContainer.classList.add('open');
  emailBoxContainer.classList.remove('closed');
}
function closechat(){
  emailBoxContainer.style.display = 'none';
  const email = document.getElementById('email-textarea')
  email.value="";
}
function chancelfile() {
  var elements = document.querySelectorAll('.udfile');
  elements.forEach(function(element) {
    element.remove();
  });
  sendButton.style.display = "flex";
  sendfilebt.style.display = "none";
  delfileButton.style.display ="none";
  fileButton.style.display = "flex";
  fileInput.value='';
}

fileButton.addEventListener('click', function() {
fileInput.click();
});

fileInput.addEventListener('change', function() {
  var file = fileInput.files[0];
  var reader = new FileReader();
  var newDiv = document.createElement('div');
  newDiv.classList.add('udfile');

  fileSize = file.size;
  let index = file.name.lastIndexOf('.');
  fileName =  file.name.substring(0, index);
  fileType = file.name.substring(index + 1);
  const fileSizeFormatted = formatFileSize(fileSize);//Formatting

  newDiv.innerHTML = 
  `
  <div class="file-icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
      <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
      <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
    </svg>
  </div>
  
  <div class="file-info">
    <div class="file-name">
    ${fileName} 
    </div>
    <div class="file-type">
      <span>${fileType} — <span>${fileSizeFormatted}</span></span>
    </div>
  </div>
  `;
  sendButton.style.display = "none";
  sendfilebt.style.display ="flex";
  delfileButton.style.display ="flex";
  fileButton.style.display = "none";
  textcontainer.appendChild(newDiv);
  
});

  function sendfile(userid,username)
 {
  //file
  var fileInput = document.getElementById('file-input');
  var file = fileInput.files[0];
  const fileSizeFormatted = formatFileSize(fileSize);//Formatting
 
  // get content 
  var content = textInput.value;
  //ajax
  $.ajax({
  url: "../date-control.php",
  type: "POST",
  data: {
  userid:userid,
  username:username,
  content:content,
  fileName:fileName,
  fileType:fileType,
  fileSize:fileSizeFormatted
 },
 success: function (response) {
  $('#lef-top-left-content').load(location.href + ' #lef-top-left-content > *', function() {
  var remoteContent = $('#lef-top-left-content').html();
  $('#lef-top-left-content').html(remoteContent);
  textInput.value = '';
  textarea.style.height = '22px';
  // update file
  if (file) 
  {
        var formData = new FormData();
        formData.append('file', file);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../date-control.php', true);
        xhr.onload = function() {
          if (xhr.status === 200) {
            console.log('ok');
          } else {
            console.log('error');
          }
        };
        xhr.send(formData);
  } 
  //Default bottom
  var leftTopLeftContent = document.querySelector('.left-top-left-content');
  leftTopLeftContent.scrollTop = leftTopLeftContent.scrollHeight;
  //remove button
  textarea.style.height = '22px';
  var elements = document.querySelectorAll('.udfile');
  elements.forEach(function(element) {
    element.remove();
  });
  sendButton.style.display = "flex";
  sendfilebt.style.display = "none";
  delfileButton.style.display ="none";
  fileButton.style.display = "flex";
  fileInput.value='';
   //remove button end
})
  },
  error: function (xhr, status, error) 
  {
  console.log(error)
  }
});
  }

// discussion
// Default bottom
var leftTopLeftContent = document.querySelector('.left-top-left-content');
leftTopLeftContent.scrollTop = leftTopLeftContent.scrollHeight;
// Default bottom end
function sendchat(userid, username) {

  var content = textInput.value.trim(); 

  if (content !== "") {
    $.ajax({
      url: "../date-control.php",
      type: "POST",
      data: {
        userid: userid,
        username: username,
        content: content
      },
      success: function(response) {
        $('#lef-top-left-content').load(location.href + ' #lef-top-left-content > *', function() {
          var remoteContent = $('#lef-top-left-content').html();
          $('#lef-top-left-content').html(remoteContent);
          textInput.value = '';
          textarea.style.height = '22px';
          //Default bottom
          var leftTopLeftContent = document.querySelector('.left-top-left-content');
          leftTopLeftContent.scrollTop = leftTopLeftContent.scrollHeight;
        });
      },
      error: function(xhr, status, error) {
        console.log(error)
      }
    });
  }
}
// discussion end

// file fileButton
function sendthis(messageid,messagename,userid) 
  {
    
    $.ajax({
 
    url: "../date-control.php",
    type: "POST",
    data: {
      messageid:messageid,//friend id
      messagename:messagename,//user name
      userid:userid,//user id

    },
    success: function (response) {
     $('#right-top-content').load(location.href + ' #right-top-content > *', function() {
    var remoteContent = $('#right-top-content').html();
    $('#right-top-content').html(remoteContent);
  })
    },
    error: function (xhr, status, error) {
      console.log("error:" + error);
    }
  });
  }
  //down file
  function downloadFile(buttonId) {
      var fileUrl = '../file/' + buttonId ; 
      var a = document.createElement('a');
      a.href = fileUrl;
      a.download = buttonId;
      console.log(a.download)
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }

//search fd   bug ---no No judgment
function searchfd() {
  var input = document.getElementById("search-fd");
  var keyword = input.value.trim().toLowerCase();
  
  var divs = document.querySelectorAll(".left-top-right-card");
  
  for (var i = 0; i < divs.length; i++) {
    var div = divs[i];
    var text = div.innerText.toLowerCase();
    
    if (keyword === "") {
      div.style.display = "flex";
    } else if (text.includes(keyword)) {
      div.style.display = "flex";
    } else {
      div.style.display = "none";
    }
  }
}
// cardname
var cardNameElements = document.querySelectorAll('.card-name');
if (cardNameElements.length > 0) {
  cardNameElements.forEach(function(cardNameElement) {
    var cardNameValue = cardNameElement.textContent;
    var firstChar = cardNameValue.charAt(0);
    var lastChar = cardNameValue.charAt(cardNameValue.length - 1);

    var cardIconNameElement = cardNameElement.previousElementSibling;
    // color
    var colors = ['#FF0000', '#FFA500', '#0000FF', '#008000'];

    // random
    var randomColor = colors[Math.floor(Math.random() * colors.length)];
    cardIconNameElement.style.backgroundColor = randomColor;

    // text
    cardIconNameElement.textContent = firstChar + lastChar;
  });
}