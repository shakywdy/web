/*
 * @Author: shaky
 * @Date: 2023-10-03 18:38:27
 * @LastEditTime: 2023-10-03 18:38:30
 * @FilePath: /web-project/js/home.js
 * Intimat: jason
 * Copyright (c) 2023 by shakywdy@gmail.com All Rights Reserved. 
 */
  // slider form
  let login= document.getElementById('login');
  let reg= document.getElementById('reg');
  let form= document.getElementsByClassName('form-box')[0];
  let reg_box = document.getElementsByClassName('register-box')[0];
  let login_box = document.getElementsByClassName('login-box')[0];
  ('login-box')[0];
  reg.addEventListener('click',()=>{
      form.style.transform='translateX(80%)';
      login_box.classList.add('hidden');
      reg_box.classList.remove('hidden');
  })
  login.addEventListener('click',()=>{
      form.style.transform='translateX(0%)';
      reg_box.classList.add('hidden');
      login_box.classList.remove('hidden');
  })
  // slider form end 
  // close button --- display none
  function hideErrorMessage() {
    var errorMessage = document.querySelector(".error-message");
    errorMessage.style.display = "none";
  }
  // alert
  function validateForm() {
      var password1 = document.getElementById("regpassword").value;
      var password2 = document.getElementById("regpassword2").value;

      if (password1 !== password2) {
          var errorMessage = document.querySelector(".error-message");
      errorMessage.style.display = "block";
      return false;
      }

      return true; 
  }