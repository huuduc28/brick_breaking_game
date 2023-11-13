<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Sign Up</title>
  <style>
    body{
      background-image: url("images/background.jpg");
      background-color:grey;
    }
    .main{
      width: 400px;
      height: 520px;
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
        border: 1px solid black;
    }
    button{
      margin-top: 20px;
      width: 200px;
      height: 50px;
    }
    label{
      margin-right: 180px;
    }
    #pass{
      margin-right: 220px;
    }
    img{
      width: 200px;
      height: 200px;
      margin-left: 100px;
    }
    #login{
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="main">
    <img src="images/logo.jpg">
    <form method="post" action="SignUp.php">
      <div>
        <label>Tên đăng nhập</label><br>
        <input name="username">
      </div>
      <div>
        <label id="pass">Mật khẩu</label><br>
        <input name="password" type="password">
      </div>
      <div>
        <label style="margin-right:200px ;">Tên hiển thị</label><br>
        <input name="displayName">
      </div>
      <div id="login">
        Bạn đã có tài khoản?
      <a href="Login.php">Đăng nhập ngay</a>
      </div>
      <div>
        <button name='signup' class="btn btn-primary">Đăng kí</button><br>
      </div>
    </form>
  </div>
</body>
</html>
<?php
  if (isset($_POST['signup'])) {
      require_once('connection.php');
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
      $displayname = trim($_POST['displayName']);
      if($username==""||$password==""||$displayname==""){
        echo '<script>alert("Vui lòng nhập đủ thông tin")</script>';
        die();
      }
      $sql = "SELECT * FROM account WHERE username = '$username' ";
      $result = $conn -> query ($sql);
      if (mysqli_num_rows($result) == 0) { 
        $sql = 'INSERT INTO account(username,password,displayName) VALUES(?,?,?)';
        try{
          $stmt = $conn->prepare($sql);
          $stmt->execute(array($username ,$password, $displayname));
          echo'Them thanh cong';
          header("Location:Login.php");
        }catch(PDOException $ex){
            die(json_encode(array('status' => false,'data'=>$ex->getMessage())));
        }
      }
      else {
        echo '<script>alert("Tên đăng nhập đã tồn tại ")</script>';
      }
  }
?>