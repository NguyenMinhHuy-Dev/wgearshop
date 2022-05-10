<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">  
    <link rel="icon" href="./img/Logo/Icon.png" type="image/png" />
    <script src="https://kit.fontawesome.com/0591fa8989.js" crossorigin="anonymous"></script>
    <title>W-Gear</title>
</head>
<body class="sale-page" >
    <div class="main"> 
        <?php 
            include("pages/header.php");
            include("pages/main.php");
            include("pages/footer.php");
        ?> 
    </div>

    <div class="modal" id="modal">
        <div class="modal__overlay"></div>

        <div class="modal__body">
             <!--Sign up form  -->
            <div class="auth-form auth-form__signup" id="sign-up">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐĂNG KÝ</h3>
                        <span class="auth-form__switch-btn auth-form__switch-btn-signin">ĐĂNG NHẬP</span>
                    </div>
                        
                    <div class="auth-form__form">
                        <div class="auth-form__group" style="position: relative;">
                            <input type="text" class="input auth-form__input" placeholder="Email hoặc số điện thoại">
                            <span style="font-size: 25px; color: #e74c3c; position: absolute; top: 35%; right: -15px; cursor: default;">*</span>
                        </div>
                        <div class="auth-form__group" style="position: relative;">
                            <input type="text" class="input auth-form__input" placeholder="Tên đăng nhập">
                            <span style="font-size: 25px; color: #e74c3c; position: absolute; top: 35%; right: -15px; cursor: default;">*</span>
                        </div>
                        <div class="auth-form__group" style="position: relative;">
                            <input type="password" class="input auth-form__input" placeholder="Mật khẩu">
                            <span style="font-size: 25px; color: #e74c3c; position: absolute; top: 35%; right: -15px; cursor: default;">*</span>
                        </div>
                        <div class="auth-form__group" style="position: relative;">
                            <input type="password" class="input auth-form__input" placeholder="Nhập lại mật khẩu">
                            <span style="font-size: 25px; color: #e74c3c; position: absolute; top: 35%; right: -15px; cursor: default;">*</span>
                        </div>
                    </div>
                    
                    <div class="auth-form__others">
                        <span>Hoặc đăng ký bằng</span>
                        <div class="auth-form__other">
                            <a href="#"><i class="icon fa-brands fa-facebook-square"></i></a>
                            <a href="#"><i class="icon fa-brands fa-twitter-square"></i></a>
                            <a href="#"><i class="icon fa-brands fa-instagram-square"></i></a>
                        </div>
                    </div>

                    <div class="auth-form__controls">
                        <button class="btn btn--sec btn__quit">TRỞ LẠI</button>
                        <button class="btn btn--pri">ĐĂNG KÝ</button>
                    </div>
                </div>
            </div> 

            <!-- Sign in form -->
            <div class="auth-form auth-form__signin" id="sign-in">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐĂNG NHẬP</h3>
                        <span class="auth-form__switch-btn auth-form__switch-btn-signup">ĐĂNG KÝ</span>
                    </div>
                        
                    <div class="auth-form__form">
                        <div class="auth-form__group">
                            <input type="text" class="input auth-form__input" placeholder="Tên đăng nhập, email hoặc số điện thoại">
                        </div> 
                        <div class="auth-form__group">
                            <input type="password" class="input auth-form__input" placeholder="Mật khẩu">
                        </div> 
                    </div>

                    <div class="auth-form__aside">
                        <div class="auth-form__links">
                            <span>Bạn quên mật khẩu?</span>
                            <a href="" class="auth-form__link"> Khôi phục ngay!</a>
                        </div>
                    </div>

                    <div class="auth-form__others">
                        <span>Hoặc đăng nhập bằng</span>
                        <div class="auth-form__other">
                            <a href="#"><i class="icon fa-brands fa-facebook-square"></i></a>
                            <a href="#"><i class="icon fa-brands fa-twitter-square"></i></a>
                            <a href="#"><i class="icon fa-brands fa-instagram-square"></i></a>
                        </div>
                    </div>
                    
                    <div class="auth-form__controls">
                        <button class="btn btn--sec btn__quit">TRỞ LẠI</button>
                        <button class="btn btn--pri btn__login_web">ĐĂNG NHẬP</button>
                    </div>
                </div>
            </div> 
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
</body>
</html>