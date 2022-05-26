<?php
    session_start();  
    if (isset($_SESSION['USERNAME_ADMIN'])) {
        header('Location: ../admincp/index.php');
    }

    include('config/config.php');

    $msgSent = '';
    $msgUsername = '';
    $msgPassword = '';

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
                    if ($row['type'] == 1) {
                        $_SESSION['USERNAME_ADMIN'] = $username;
                        header("Location: index.php");
                    }
                    else {
                        $msgSent = "<span class='error-message'>Bạn không có quyền truy cập!</span>";  
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
    <!-- <link rel="stylesheet" href="./css/styleadmincp.css?v=<?php //echo time(); ?>">  -->
    <link rel="stylesheet" href="./css/validateadmincp.css?v=<?php echo time(); ?>"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">  
    <link rel="icon" href="./img/Logo/Icon.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" /> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0591fa8989.js" crossorigin="anonymous"></script>
    
    <title>ĐĂNG NHẬP ADMIN</title>
</head>
<body class="validate-page"> 
    <div class="container">
        <div class="login-wrapper">
            <h2 class="login-heading">ĐĂNG NHẬP ADMIN</h2>
            <form action="" method="POST" class="login-form">
                <div class="login-username">
                    <label for="username"><b>Tên đăng nhập:</b></label>
                    <input type="text" name="username" class="input" id="username" required>
                    <?php echo $msgUsername; ?>
                </div>
                <div class="login-password">
                    <label for="password"><b>Mật khẩu:</b></label>
                    <input type="password" name="password" class="input" id="password" required>
                    <?php echo $msgPassword; ?>
                </div>
                <?php
                    echo $msgSent;
                ?>
                <div class="login-submit">
                    <input type="submit" name="submit" class="button input" id="submit" value="ĐĂNG NHẬP">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 