    var canvas = document.getElementById('game');
    var context = canvas.getContext("2d");
    var ball = {
        x : 400, 
        y : 400,
        dx : 2, 
        dy : 2,
        radius :10
    }
    var paddle = {
        width : 120,
        height : 10,
        x : 450,
        y : canvas.height - 20,
        speed :5,
        isMovingLeft : false,
        isMovingRigth : false
    };
    var bricks = {
        offsetX: 25,
        offsetY: 25,
        margin: 10,
        width : 50,
        height: 13,
        toltalRow : 4,
        toltalCell : 16
    }

    var BricksList = [];
    var isGameOver = false; 
    var isGameWin = false;
    var isGamePause = true; 
    var UserScore = 0;
    var MaxScore = bricks.toltalCell * bricks.toltalRow;    

    for(var i = 0 ; i < bricks.toltalRow ; i++){
        for(var j = 0 ; j < bricks.toltalCell ; j ++){
            BricksList.push({
                x : bricks.offsetX + j * (bricks.width + bricks.margin),
                y : bricks.offsetY + i * (bricks.height + bricks.margin),
                isBroken: false
            })
        }
    }
    //Hàm sử lý sự kiện nhấn nút
    document.addEventListener('keyup', function(event){
        console.log('KEY UP');
        console.log(event);
        if(event.keyCode == 37){
            paddle.isMovingLeft = false;
        }else if(event.keyCode == 39){
            paddle.isMovingRigth = false;
        }
    })

    document.addEventListener('keydown' , function(event){
        console.log('KEY DOWN');
        console.log(event);
        if(event.keyCode == 37){
            paddle.isMovingLeft = true;
        }else if(event.keyCode == 39){
            paddle.isMovingRigth = true;
        }
    })

    //Hàm vẽ bóng
    function drawBall(){
        context.beginPath();
        context.arc(ball.x, ball.y, ball.radius,0, Math.PI*2);
        context.fillStyle = 'grey';
        context.fill();
        context.closePath();
    }
    //hàm vẽ thanh chắn
    function drawPaddle(){
        context.beginPath();
        context.rect(paddle.x , paddle.y , paddle.width , paddle.height);
        context.fillStyle = 'red';
        context.fill();
        context.closePath();
    }

    //hàm vẽ những viên gạch
    function drawBricks(){
        BricksList.forEach(function(b){
            if(!b.isBroken){
                context.beginPath();
                context.rect(b.x, b.y, bricks.width , bricks.height);
                context.fillStyle = 'green';
                context.fill();
                context.closePath();
            }
        
        })
    }

    //Hàm sử lý va chạm với đường viền
    function ballFrameCollision(){
        if(ball.x < ball.radius || ball.x > canvas.width - ball.radius){
            ball.dx = - ball.dx;
        }
        if(ball.y < ball.radius ){
            ball.dy = - ball.dy;    
        }
    }

    //Hàm đổi chiều chuyển động của bóng khi chạm vào thanh chắn
    function ballCollidePaddle(){
        if(ball.x + ball.radius >= paddle.x && ball.x + ball.radius <= paddle.x + paddle.width && 
            ball.y + ball.radius >= canvas.height - paddle.height - 10){
            ball.dy = -ball.dy;
        }
    }

    //Hàm đổi chiều của bóng khi va chạm vào các viên gạch và tính điểm
    function destroyBricks(){
        BricksList.forEach(function(b){
            if(!b.isBroken){
                if(ball.x >= b.x && ball.x <= b.x + bricks.width && 
                    ball.y + ball.radius >= b.y && ball.y - ball.radius <= b.y + bricks.height){
                    ball.dy = - ball.dy;
                    b.isBroken = true;
                    UserScore +=1;
                    document.getElementById('score').innerHTML = UserScore;
                    if(UserScore >= MaxScore){
                        isGameOver = true;
                        isGameWin = true;
                    }
                }
            }
        })
    }

    //hàm chuyển động của trái bóng
    function updateBallPosition(){
        ball.x +=  ball.dx;
        ball.y +=  ball.dy;
    }

    //Hàm đổi chiều chuyển động của thanh chắn
    function updatePaddlePosition(){
        if(paddle.isMovingLeft){
            paddle.x -= paddle.speed;
        }else if(paddle.isMovingRigth){
            paddle.x += paddle.speed;
        }

        if(paddle.x < 0 ){
            paddle.x = 0;
        }else if(paddle.x > canvas.width - paddle.width){
            paddle.x = canvas.width - paddle.width;
        }
    }

    function checkGameOver(){
        if(ball.y > canvas.height - ball.radius){
            isGameOver = true;
        }
    }

    function gameOverOrWin(){
        if(isGameWin){
            alert('YOU WIN')
            console.log('YOU WIN');
        }else{
            alert('YOU LOSE')
            console.log('Game over');
        }
    }

    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    var pausegame = document.getElementById('gamepause');
    pausegame.onclick = function(){
        isGamePause = true;
    };

    var playgame = document.getElementById('gameplay');
    playgame.onclick = function(){
        isGamePause = false;
    };

    async function positionGamePlay(){
        if(isGamePause == true){
            await sleep(9000000);
            updateBallPosition();
            updatePaddlePosition();
        }else{
            updateBallPosition();
            updatePaddlePosition();
        }
    }
    function gamePlay(){
        if(!isGameOver){
            context.clearRect(0, 0, canvas.width , canvas.height);

            drawBall();
            drawPaddle();
            drawBricks();

            ballFrameCollision();
            ballCollidePaddle();
            destroyBricks();

            positionGamePlay();
            checkGameOver();
            
            requestAnimationFrame(gamePlay);
        }else{
            gameOverOrWin();
        }
        
    }
    gamePlay();
