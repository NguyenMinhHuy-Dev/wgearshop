<?php
    session_start();
    if (isset($_GET['change'])) {
        unset($_SESSION['USERNAME']);
    }

    if (isset($_SESSION['USERNAME'])) {
        header("Location: index.php");
        die();
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception; 
    
    require 'vendor/autoload.php';

    $msgContact = '';
    $msgSent = '';
    $isValid = 1;

    include("admincp/config/config.php");

    if (isset($_POST["submit"])) {
        $contact = $_POST["contact"];
        $code = md5(rand());

        if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $msgContact = "<span class='error-message' style>Email hoặc số điện thoại không hợp lệ!</span>";
            $isValid = 0;
        } 
        else {
            $msgContact = "<span class='success-message'> Email hoặc số điện thoại hợp lệ!</span>"; 
            if ($isValid) {
                $sql = "UPDATE tb_account SET code='{$code}' WHERE contact='{$contact}'";
                $query = mysqli_query($mysqli, $sql);  
                if ($query) {
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                    
                        $mail->isSMTP();                                           
                        $mail->Host       = 'smtp.gmail.com';                    
                        $mail->SMTPAuth   = true;                                  
                        $mail->Username   = 'wgear.contact@gmail.com';           
                        $mail->Password   = '0938745593';                           
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       
                        $mail->Port       = 465;                         
    
                        //Recipients
                        $mail->setFrom('wgear.contact@gmail.com');
                        $mail->addAddress($contact);
    
                        //Content
                        $mail->isHTML(true);                                
                        $mail->Subject = 'VERIFICATION';
                        $mail->Body    = 'Bấm vào link để xác thực tài khoản <b><a href="http://localhost/W-Gear-PHP/newpassword.php?reset='.$code.'">http://localhost/W-Gear-PHP/newpassword.php?reset='.$code.'</a></b>';
    
                        $mail->send();
                        $msgSent = "<div class='msg-sent success'><span>Link xác thực đã được gửi tới email của bạn.</span> <i style='float: right; font-size: 30px; line-height: 40px; color: var(--primary);' class='fa-solid fa-circle-check'></i></div>";      
                                
                    } catch (Exception $e) {
                        $msgSent = "<div class='msg-sent error'><span>Đã xảy ra lỗi!!!</span></div>";  
                    }
                }
            }
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
    
    <title>ĐẶT LẠI MẬT KHẨU</title>
</head>
<body class="sale-page validate-page"> 
    <div class="mymodal active" id="modal">
        <div class="modal__overlay"></div> 
        <div class="modal__body">
        <div class="auth-form auth-form__signin active" id="sign-in">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐẶT LẠI MẬT KHẨU</h3>
                        <span class="auth-form__switch-btn auth-form__switch-btn-signin" id="switch-sign-in">ĐĂNG NHẬP</span>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="auth-form__form">
                            <div class="auth-form__group" style="position: relative;">
                                <input type="text" name="contact" class="input auth-form__input" placeholder="Nhập email hoặc số điện thoại" value="<?php if (isset($_POST['submit'])) { echo $_POST["contact"]; } ?>">
                                <?php echo $msgContact; ?>
                            </div> 
                        
                        <div class="auth-form__controls" style="justify-content:flex-end">
                            <input type="button" id="quitbutton" class="quit btn btn--sec" name="quit" value="TRỞ LẠI">
                            <input type="submit" name="submit" class="btn btn--pri btn__login_web" value="ĐỒNG Ý"></input>
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
        $('#switch-sign-in').click(function() {
            location.href = `signin.php`;
        }); 
        $('#quitbutton').click(function() {
            location.href = `index.php`;
        }); 

    });
</script>