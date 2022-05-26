<?php
    session_start();
    if (isset($_SESSION['USERNAME'])) {
        header("Location: index.php");
        die();
    }

    include("admincp/config/config.php");

    $msgSent = '';
    $msgPassword = '';
    $msgRepassword = '';

    if (isset($_GET["reset"])) {
        if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tb_account WHERE code='{$_GET['reset']}'")) > 0) {
            if (isset($_POST["submit"])) {
                $repassword = md5($_POST["password"]);
                $password = md5($_POST["repassword"]);
        
                if ($password != $repassword || $password == '' || $repassword == '') {
                    $msgRepassword = "<span class='error-message'>Mật khẩu không trùng khớp</span>"; 
                } 
                else {
                    $query = mysqli_query($mysqli, "UPDATE tb_account SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");
                    if ($query) { 
                        header('Location: signin.php');
                    }
                }
            } 
        }
        else {
            $msgSent = "<div class='msg-sent error'><span>Không tìm thấy mã xác thực!</span></div>"; 
        }
    }
    else {
        header('Location: forgotPassword.php');
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>"> 
    <link rel="stylesheet" href="./css/validate.css?v=<?php echo time(); ?>"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">  
    <link rel="icon" href="./img/Logo/Icon.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0591fa8989.js" crossorigin="anonymous"></script>
    
    <title>ĐẶT LẠI MẬT KHẨU</title>
</head>
<body class="validate-page"> 
    <div class="mymodal active" id="modal">
        <div class="modal__overlay"></div> 
        <div class="modal__body">
        <div class="auth-form auth-form__signin active" id="sign-in">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐẶT LẠI MẬT KHẨU</h3>
                        <!-- <span class="auth-form__switch-btn auth-form__switch-btn-signup" id="switch-sign-up">ĐĂNG KÝ</span> -->
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="auth-form__form">
                            <div class="auth-form__group" style="position: relative;">
                                <input type="password" name="password" class="input auth-form__input" placeholder="Mật khẩu mới">
                                <?php echo $msgPassword; ?>
                            </div> 
                            <div class="auth-form__group" style="position: relative;">
                                <input type="password" name="repassword" class="input auth-form__input" placeholder="Nhập lại mật khẩu mới">
                                <?php
                                    echo $msgRepassword;
                                ?>
                            </div> 
                        </div> 
                        
                        <div class="auth-form__controls" style="justify-content:flex-end">
                            <!-- <input type="button" id="quitbutton" class="quit btn btn--sec" name="quit" value="TRỞ LẠI">      -->
                            <input type="submit" name="submit" class="btn btn--pri btn__login_web" value="ĐẶT LẠI"></input>
                        </div> 
                    </form>  

                    <?php
                        echo $msgSent;
                    ?>
                </div>
            </div> 
        </div>
    </div>
</body>
</html> 

<script>
    $(document).ready(function() {
        $('#switch-sign-up').click(function() {
            location.href = `signup.php`;
        }); 
        $('#quitbutton').click(function() {
            location.href = `index.php`;
        }); 
    });
</script>
