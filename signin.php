<?php
    session_start();
    if (isset($_SESSION['USERNAME'])) {
        header("Location: index.php");
        die();
    }

    include("admincp/config/config.php");

    $msgSent = '';
    $msgUsername = '';
    $msgPassword = '';

    if (isset($_GET["verification"])) {
        if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tb_account WHERE code='{$_GET['verification']}'")) > 0) {
            $sql = "UPDATE tb_account SET code= '' WHERE code='{$_GET['verification']}'";
            $query = mysqli_query($mysqli, $sql);
            if ($query) {
                // $row = mysqli_fetch_array($query);
                $msgSent = "<div class='msg-sent success' style='margin-bottom:10px'><span>Xác thực tài khoản thành công!</span><i style='float: right; font-size: 30px; line-height: 40px; color: var(--primary);' class='fa-solid fa-circle-check'></i></div>";  
            }
        }
        else {
            header('Location: signin.php');
        }
    }

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        $sql = "SELECT * FROM tb_account WHERE username='{$username}'";
        $query = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($query) === 1) {  
            $sql = "SELECT * FROM tb_account WHERE username='{$username}' AND password='{$password}'";
            $query = mysqli_query($mysqli, $sql);
    
            if (mysqli_num_rows($query) === 1) {
                $row = mysqli_fetch_array($query);
    
                if (empty($row["code"])) {
                    $_SESSION['USERNAME'] = $username;
                    if (isset($_GET['thanhtoan'])) {
                        header("Location: index.php?thanhtoan");
                    }
                    else {
                        header("Location: index.php");
                    }
                }
                else {
                    $msgSent = "<div class='msg-sent error' style='margin-bottom:10px'><span>Tài khoản chưa được xác thực!</span><i style='float: right; font-size: 30px; line-height: 40px; color: var(--primary);' class='fa-solid fa-circle-exclamation'></i></div>";  
                }
            } 
            else {
                $msgPassword = "<span class='error-message'>Sai mật khẩu!</span>";  
            }
        }
        else {
            $msgUsername = "<span class='error-message'>Tài khoản không tồn tại!</span>";  
        }
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
    
    <title>ĐĂNG NHẬP</title>
</head>
<body class="validate-page"> 
    <div class="mymodal active" id="modal">
        <div class="modal__overlay"></div> 
        <div class="modal__body">
        <div class="auth-form auth-form__signin active" id="sign-in">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐĂNG NHẬP TÀI KHOẢN</h3>
                        <span class="auth-form__switch-btn auth-form__switch-btn-signup" id="switch-sign-up">ĐĂNG KÝ</span>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="auth-form__form">
                            <div class="auth-form__group" style="position: relative;">
                                <input type="text" name="username" class="input auth-form__input" placeholder="Tên đăng nhập" value="<?php if (isset($_POST['submit'])) { echo $_POST["username"]; } ?>">
                                <?php echo $msgUsername; ?>
                            </div> 
                            <div class="auth-form__group" style="position: relative;">
                                <input type="password" name="password" class="input auth-form__input" placeholder="Mật khẩu">
                                <?php
                                    echo $msgPassword;
                                ?>
                            </div> 
                        </div> 
                        
                        <div class="auth-form__controls" style="justify-content:flex-end">
                            <input type="button" id="quitbutton" class="quit btn btn--sec" name="quit" value="TRỞ LẠI">     
                            <input type="submit" name="submit" class="btn btn--pri btn__login_web" value="ĐĂNG NHẬP"></input>
                        </div> 
                    </form>

                    <div class="auth-form__aside">
                        <div class="auth-form__links">
                            <span>Bạn quên mật khẩu?</span>
                            <a href="forgotPassword.php" class="auth-form__link"> Khôi phục ngay!</a>
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
