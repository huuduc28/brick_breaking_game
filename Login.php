<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Login</title>
  <style>
    body{
      background-image: url("images/background.jpg");
      background-color:Grey;
    }
    .main{
      width: 400px;
      min-height: 450px;
      background-color: white;
      margin: auto;
      margin-top: 100px;
      align-items: center;
      border-radius: 10px;
      background-color:rgb(247, 243, 240);
    }
    form{
      text-align: center;
      background-color:rgb(247, 243, 240);
    }
    input{
      width: 300px;
      height: 40px;
      border-radius: 10px;
      background-color:rgb(247, 243, 240);
      border: 1px solid black;
    }
    button{
      margin-top: 20px;
      width: 200px;
      height: 50px;
    }
    label{
      margin-right: 200px;
    }
    #pass{
      margin-right: 240px;
    }
    img{
      width: 200px;
      height: 200px;
      margin-left: 100px;
    }
    #signup{
      margin-top: 10px;
    }
    #error{
      color: red;
    }
  </style>
</head>
<body>
  <div class="main">
    <img src="images/logo.jpg">
    <form method="post" action="login.php">
      <div>
        <label>Tên đăng nhập</label><br>
        <input name="username">
      </div>
      <div>
        <label id="pass">Mật khẩu</label><br>
        <input type="password" name="password">
      </div>
      <div id="signup">
        Bạn chưa có tài khoản?
      <a href="SignUp.php">Đăng kí</a>
      </div>
      <div>
        <button name ='login' class="btn btn-primary">Đăng nhập</button>
      </div>
    </form>
  </div>
</body>
</html>
<?php
  if (isset($_POST['login'])) {
      session_start ();
      require_once('connection.php');
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $sql = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
      $result = $conn -> query ($sql);
          if (mysqli_num_rows($result) == 0) { 
            echo '<script>alert("Sai tên đăng nhập hoặc mật khẩu")</script>';
          }
          else {
            while($row = $result->fetch_assoc()){
              $displayName = $row['displayname'];
              $_SESSION['username'] =  $displayName;
              header('location:Home.php');
            }
          }
  }
?>