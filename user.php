<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User State Form</title>
    <link rel="stylesheet" href="styles.css">
 
    <style>
        body {
          background-color: rgb(243, 238, 235);
          font-family: Noto Serif TC;
        }

        h2, #gmail, #password, #gmail2, #password2, #confirm_password, #gmail3, #password3 {
          width: 300px;
          height: 35px;
          margin: 20px;
          color: #645753;
        }

        h2 {
          font-size: 30px;
          text-align: center;
          margin: 50px;
        }

        h5 {
          font-size: 12px;
          position: absolute;
          right: 0;
          top: 250px;
          margin: 55px;
          color: #a29a98;
        }
        h5:hover {
          color: black;
        }

        h6 {
          font-size: 12px;
          text-align: center;
          color: #645753;
          margin: 1px;
        }
        h6:hover {
          color: #645753;
        }

        #container1, #container2, #container3 {
          margin: 50px;
          padding: 10px;
          width: 400px;
          height: 600px;
          background-color: white;
          border-radius: 80px;  /*圓角*/
          border-top: 20px solid #645753;  /*定位對齊*/
          position: relative;
          margin: auto;
          top: 100px;
          text-align: center;
        }

        #container2, #container3 {
          visibility: hidden;
          height: 600px;
        }

        .submit {
          font-size: 15px;
          color: rgb(70, 60, 56);  
          background: #dec9c3;
          width: 200px;
          height: 40px;
          margin: 70px;
          padding: 10px;
          border-radius: 8px;
        }
        .submit:hover {
          color: rgb(247, 249, 249);
          background: #645753;
        }

        input {
          font-size: 12px;
          padding: 5px;
          border: none; 
          border: solid 1px #ccc;
          border-radius: 5px;
        }

        .modal {
          display: none;
          position: fixed;
          z-index: 1;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgb(0,0,0);
          background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
          background-color: #fefefe;
          margin: 15% auto;
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
          max-width: 300px;
          text-align: center;
          border-radius: 10px;
        }
        .close {
          color: #aaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: black;
          text-decoration: none;
          cursor: pointer;
        }
    </style>

    <script>
      function show_hide() {
        var login = document.getElementById("container1");
        var signup = document.getElementById("container2");

        if (login.style.display === "none") {
          login.style.display = "block";
          document.getElementById("gmail").value = "";
          document.getElementById("password").value = "";
          signup.style.display = "none";
        } else {
          login.style.display = "none";
          signup.style.display = "block";
          signup.style.visibility = "visible";
          document.getElementById("gmail2").value = "";
          document.getElementById("password2").value = "";
          document.getElementById("confirm_password").value = "";
        }
      }

      function show_forgetpassword() {
        var forgetpassword = document.getElementById("container3");
        var login = document.getElementById("container1");
        var signup = document.getElementById("container2");

        if (forgetpassword.style.visibility === "hidden" || forgetpassword.style.visibility === "") {
          forgetpassword.style.visibility = "visible";
          login.style.display = "none";
          signup.style.display = "none";
        } else {
          forgetpassword.style.visibility = "hidden";
          login.style.display = "block";
          signup.style.display = "none";
        }
      }

      function show_login() {
        var forgetpassword = document.getElementById("container3");
        var login = document.getElementById("container1");

        if (forgetpassword.style.visibility === "visible") {
          forgetpassword.style.visibility = "hidden";
          login.style.display = "block";
        }
      }
    </script>

</head>
<body>

  <div class="login_page">
    <div id="container1">

      <div class="login">  
        <h2>登入</h2>

        <form action="usermanagement.php" method="POST" onsubmit="handleSubmit(event, 'login')">
          <input type="email" id="gmail" name="gmail" placeholder="電子郵件" required>
          <div class="tab"></div>
          <input type="password" id="password" name="password" placeholder="密碼" required>
          <div class="tab"></div>
          <input type="submit" name="login_submit" value="送出" class="submit" > 
        </form>  

        <h6 href="#" onclick="show_hide()">還沒有帳號？<u>註冊</u></h6>
        <h5 href="#" onclick="show_forgetpassword()"><u>忘記密碼</u>?</h5>

      </div><!-- login end-->
    </div><!-- container1 end-->
  </div><!-- login_page end-->
    
  <div class="signup_page">
    <div id="container2">

      <div class="signup">  
        <h2>註冊</h2>

        <form action="statemanagement.php" method="POST" onsubmit="handleSubmit(event, 'signup')">
          <input type="email" id="gmail2" name="gmail" placeholder="電子郵件" required>
          <div class="tab"></div>
          <input type="password" id="password2" name="password" placeholder="密碼(至少一個英文字母和數字，長度超過5)" required>
          <div class="tab"></div>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="確認密碼" required>
          <div class="tab"></div>            
          <input type="submit" name="signup_submit" value="送出" class="submit">
        </form>  

        <h6 href="#" onclick="show_hide()">已經有帳號？<u>登入</u></h6>
        
      </div><!-- signup end-->
    </div><!-- container2 end-->
  </div><!-- signup_page end--> 
  
  <div class="forgetpassword_page">
    <div id="container3">

      <div class="forgetpassword">  
        <h2>忘記密碼？</h2>

        <form action="resetpassword.php" method = "POST" onsubmit="handleSubmit(event, 'reset')">
          <input type="email" id="gmail3" name="gmail" placeholder="電子郵件" required>
          <div class="tab"></div>
          <input type="password" id="password3" name="password" placeholder="重設密碼(至少一個英文字母和數字，長度超過5)" required>
          <div class="tab"></div>
          <input type="submit" name="reset_submit" value="送出" class="submit" >  
        </form>

        <h6 href="#" onclick="show_login()">返回<u>登入</u></h6>
      </div><!-- forgetpassword end-->
    </div><!-- container3 end-->
  </div><!-- forgetpassword_page end-->

  
  <div id="myModal" class="modal">
    <div class="modal-content" id="modal-content">
      <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
    </div>
  </div>

  
</body>
</html>