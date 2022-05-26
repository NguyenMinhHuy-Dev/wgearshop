<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    include("../../config/config.php");
     
    require("../../../vendor/autoload.php");
 
    if (isset($_POST["themkhuyenmai"])) { 
        $tenkhuyenmai = $_POST["tenkhuyenmai"];  
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];  

        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);

        $sql_them = "INSERT INTO tb_promotion(name, image) VALUES (N'".$tenkhuyenmai."', N'".$hinhanh."')";
        // echo $sql_them;
        // die();
        $query = mysqli_query($mysqli, $sql_them);

        if ($query) { 
            $sql_email = "SELECT * FROM tb_account";
            $query_email = mysqli_query($mysqli, $sql_email);
            while ($row_email = mysqli_fetch_array($query_email)) {
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
                    $mail->addAddress($row_email['contact']);
                    // $mail->addAddress("huy129a5@gmail.com");

                    //Content
                    $mail->isHTML(true);                                
                    $mail->Subject = 'KHUYẾN MÃI TƯNG BỪNG';
                    $mail->Body    = "<h2 style='color:pink'>Xin chào các bạn! Tại W-Gear đang có khuyến mãi lớn, hãy vào mua sắm ngay thôi nào ".$tenkhuyenmai."</h2><a href='http://localhost/W-Gear-PHP/index.php?danhmuc=khuyenmai'>http://localhost/W-Gear-PHP/index.php?danhmuc=khuyenmai'</a>";

                    $mail->send();
                            
                } catch (Exception $e) {
                    echo "Eror";
                }
            }
        }

        header('Location:../../index.php?promotion');   
    }
    else { 
        $sql = "SELECT * FROM tb_promotion WHERE id=".$_GET["idkhuyenmai"]." LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/'.$row["image"]);
        }
        $sql_xoa = "DELETE FROM tb_promotion WHERE id=".$_GET["idkhuyenmai"];
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?promotion');  
    }
?>