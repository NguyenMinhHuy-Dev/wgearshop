<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="./css/products.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">  
    <link rel="icon" href="./img/Logo/Icon.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0591fa8989.js" crossorigin="anonymous"></script>
    
    <title>W-Gear</title>
</head>
<body class="sale-page" id="sale-page">
    <div class="main"> 
        <?php 
            include("pages/header.php");
            include("pages/main.php");
            include("pages/footer.php");
        ?> 
    </div>

    <div class="mymodal" id="modal">
        <div class="modal__overlay" onclick="quitModal()"></div>

        <div class="modal__body">
             <!--Sign up form  -->  
            <!-- Sign in form -->
            <?php
                // include("pages/signin.php");
                // include("pages/signup.php");
            ?>
        </div>
    </div>

    <div class="chat-box" id="chat-box">
        <div class="chat-box__header">
            <h4 class="chat-box__header-title">Tư vấn online</h4>
            <div class="chat-box__header-close" id="chat-box-btn">
                <i class="icon down fa-solid fa-angle-down"></i>
                <i class="icon up fa-solid fa-angle-up"></i>
            </div>
        </div>
        <div class="chat-box-body">
            <div class="chat-container">
                
            </div>

            <div class="text-container">
                <textarea name="" id="text-box" cols="25" rows="2" placeholder="Nhập và gửi để được tư vấn"></textarea>
                <button class="btn btn--pri btn-send">Gửi</button>
            </div>
        </div>
    </div>

    <script src="./js/app.js"></script> 

    <script>
        $(document).ready(function() {
            $('#chat-box-btn').click(function() {
                this.classList.toggle('active');
                document.getElementById('chat-box').classList.toggle('active');
            }); 
        });
    </script>
    
    <script>
        function quitModal() {
            document.getElementById('modal').classList.remove('active');
            document.getElementById('sign-in').classList.remove('active');
            document.getElementById('sign-up').classList.remove('active');
        }
        
    </script>
</body>
</html>