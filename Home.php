<?php
    session_start();
    $displayUser = "Login";
    $hrefLog = "login.php";
    $username = "Khách";
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
        $displayUser = "Logout";
        $hrefLog = "logout.php";
        $username = $_SESSION['username'];
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Game HandMade</title>
    <style>
        canvas{
            border: 1px solid black;
            margin-left: 230px;
            background-color:rgb(247, 243, 240);
        }
        body{
            
            align-items: center;
            background-image: url("images/background.jpg");
            background-color:Grey;
        }
        a{
            margin: auto;
        }
        img{
            width: 80px;
            height: 80px;
        }
        #gamePlay{
            margin-left: 230px;
        }
        #user{
            width: 200px;
            margin-left: 50px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id= 'user'>
        <img src = 'images/avata.jpg'>
        <label style ='color:white'><?php echo $username ?></label><br>
        <label style ='color:white'>Điểm của bạn:</label>
        <span style ='color:white' id="score" name = 'score'>0</span><br>
        <a href="<?= $hrefLog ?>" class="btn btn-primary"><?php echo $displayUser?></a>
    </div>
    <canvas id="game" width="1000" height="500"></canvas><br>
    <div id = 'gamePlay'>
        <input type="button" value="Play Game" id="gameplay"/>
        <input type="button" value="Pause Game" id="gamepause"/>
    </div>
    <script src ="js/gamePlay.js"></script>
</body>
</html>
