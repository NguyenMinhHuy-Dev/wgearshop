<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    session_start();
    if (isset($_SESSION['USERNAME'])) {
        header("Location: index.php");
        die();
    }

    require 'vendor/autoload.php';

    include("admincp/config/config.php");
    $isValid = 1;
    $msgContact = '';
    $msgUsername = '';
    $msgName = ''; 
    $msgRepassword = '';
    $msgSent = '';

    if (isset($_POST["submit"])) {
        $contact = $_POST["contact"];
        $username = $_POST["username"];
        $name = $_POST["name"];
        $password = md5($_POST["password"]);
        $repassword = md5($_POST["repassword"]);
        $code = md5(rand());

        if (!filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            $msgContact = "<span class='error-message' style>Email không hợp lệ!</span>";
            $isValid = 0;
        }
        else if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tb_account WHERE contact='{$contact}'")) > 0) {
            // $msg = "<div class='alert alert-danger'>{$contact} - This email address has been already exists.</div>";
            $msgContact = "<span class='error-message'>Email hoặc số điện thoại đã được sử dụng!</span>";
            $isValid = 0;
        }  
        else {
            $msgContact = "<span class='success-message'> Email hợp lệ!</span>";
            // $isValid = 1;
        }

        if (preg_match('/^[a-z\d_]{1,20}$/i', $username) == 0) {
            $msgUsername = "<span class='error-message'>Tên đăng nhập có ký tự không hợp lệ!</span>"; 
            $isValid = 0;
        }
        else if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM tb_account WHERE username='{$username}'")) > 0) {
            // $msg = "<div class='alert alert-danger'>{$contact} - This email address has been already exists.</div>";
            $msgUsername = "<span class='error-message'>Tên đăng nhập đã được sử dụng!</span>";
            $isValid = 0;
        }  
        else {
            $msgUsername = "<span class='success-message'>Tên đăng nhập hợp lệ!</span>";
            // $isValid = 1;
        }
        
        if (preg_match('/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i', $name) == 0) {
            $msgName = "<span class='error-message'>Tên có ký tự không hợp lệ!</span>";
            $isValid = 0;
        } 
        else {
            $msgName = "<span class='success-message'>Tên hợp lệ!</span>";
        }

        if ($password != $repassword || $password == '' || $repassword == '') {
            $msgRepassword = "<span class='error-message'>Mật khẩu không trùng khớp</span>";
            $isValid = 0;
        } 
        if ($isValid) {
            $sql = "INSERT INTO tb_account(contact, username, password, name, avatar, type, create_at, code) VALUES ('{$contact}','{$username}','{$password}','{$name}','default.jpg',0,CURRENT_DATE(),'{$code}')";
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
                    $mail->Body    = 'Bấm vào link để xác thực tài khoản <b><a href="http://localhost/W-Gear-PHP/signin.php?verification='.$code.'">http://localhost/W-Gear-PHP/signin.php?verification='.$code.'</a></b>';

                    $mail->send();
                    $msgSent = "<div class='msg-sent success'><span>Link xác thực đã được gửi tới email của bạn.</span> <i style='float: right; font-size: 30px; line-height: 40px; color: var(--primary);' class='fa-solid fa-circle-check'></i></div>";      
                            
                } catch (Exception $e) {
                    $msgSent = "<div class='msg-sent error'><span>Đã xảy ra lỗi!!!</span></div>";  
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
    
    <title>ĐĂNG KÝ</title>
</head>
<body class="sale-page validate-page"> 
    <div class="mymodal active" id="modal">
        <div class="modal__overlay"></div> 
        <div class="modal__body">
            <div class="auth-form auth-form__signup active" id="sign-up">
                <div class="auth-form__container">
                    <div class="auth-form__header">
                        <h3 class="auth-form__heading">ĐĂNG KÝ TÀI KHOẢN</h3>
                        <span class="auth-form__switch-btn auth-form__switch-btn-signin" id="switch-sign-in">ĐĂNG NHẬP</span>
                    </div> 
                    <form method="POST" id="regiration_form"> 
                        <!-- <fieldset style="border: none">   -->
                            <!-- <h3 class="auth-form__heading" style="color: var(--button); font-size:18px; margin-bottom: 10px; margin-left: 10px">BƯỚC 1: <h3 style="font-size:15px; font-weight:normal; margin-bottom: 10px; margin-left: 10px">NHẬP EMAIL HOẶC SỐ ĐIỆN THOẠI</h3></h3>  -->
                            <div class="auth-form__form">
                                <div class="auth-form__group" id="auth-form__group-mail" style="position: relative;">
                                    <input type="text" name="contact" id="input-email" class="input auth-form__input" placeholder="Email" value="<?php if (isset($_POST['submit'])) { echo $_POST["contact"]; } ?>" required> 
                                    <?php echo $msgContact; ?>
                                    <!-- <i  class="fa-solid fa-circle-check"></i>
                                    <i  class="fa-solid fa-circle-exclamation"></i> -->
                                    <!-- <span class="error-message">Email hoặc số điện thoại không hợp lệ!</span> -->
                                </div>
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group" id="auth-form__group-username" style="position: relative;">
                                    <input type="text" id="input-username" name="username" class="input auth-form__input" placeholder="Tên đăng nhập" value="<?php if (isset($_POST['submit'])) { echo $_POST["username"]; } ?>" required>
                                    <?php echo $msgUsername; ?>
                                    <!-- <i  class="fa-solid fa-circle-check"></i>
                                    <i  class="fa-solid fa-circle-exclamation"></i> -->
                                    <!-- <span class="error-message">Tên đăng nhập không hợp lệ!</span> -->
                                </div>
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group" id="auth-form__group-name" style="position: relative;">
                                    <input type="text" id="input-name" name="name" class="input auth-form__input" placeholder="Họ tên" value="<?php if (isset($_POST['submit'])) { echo $_POST["name"]; } ?>" required>
                                    <?php echo $msgName; ?>
                                    <!-- <i  class="fa-solid fa-circle-check"></i>
                                    <i  class="fa-solid fa-circle-exclamation"></i> -->
                                    <!-- <span class="error-message">Họ tên không hợp lệ!</span> -->
                                </div>
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group" id="auth-form__group-pass" style="position: relative;">
                                    <input type="password" id="input-pass" name="password" class="input auth-form__input" placeholder="Mật khẩu" required>
                                    <!-- <i  class="fa-solid fa-circle-check"></i>
                                    <i  class="fa-solid fa-circle-exclamation"></i> -->
                                    <!-- <span class="error-message">Mật khẩu cần trên 7 kí tự!</span> -->
                                </div>
                            </div>
                            <div class="auth-form__form">
                                <div class="auth-form__group" id="auth-form__group-pass-again" style="position: relative;">
                                    <input type="password" id="input-pass-again" name="repassword" class="input auth-form__input" placeholder="Xác nhận mật khẩu"  required>
                                    <?php echo $msgRepassword; ?>
                                    <!-- <i  class="fa-solid fa-circle-check"></i>
                                    <i  class="fa-solid fa-circle-exclamation"></i> -->
                                    <!-- <span class="error-message">Mật khẩu không trùng nhau!</span> -->
                                </div>
                            </div> 
                            <?php
                                echo $msgSent;
                            ?>
                            <div id="form-controls" class="auth-form__controls" style="justify-content:flex-end">
                                <!-- <input type="button" class="previous btn btn--pri" name="previous" value="TRỞ VỀ"> -->
                                <input type="button" id="quitbutton" class="quit btn btn--sec" name="quit" value="TRỞ LẠI"> 
                                <input type="submit" class="submit btn btn--pri" name="submit" value="ĐĂNG KÝ">
                            </div>  
                        <!-- </fieldset>    -->
                    </form> 
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