<?php
    include("../../config/config.php");
 
    $tensanpham = $_POST["tensanpham"];
    $loaisanpham = $_POST["loaisanpham"];
    $hang = $_POST["hang"];
    $loaisanpham = $_POST["loaisanpham"]; 
    $giaban = $_POST["giaban"];
    $soluong = $_POST["soluong"];
    $trangthai = $_POST["trangthai"];
    
    if (isset($_FILES["hinhanh"]["name"])) {
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);

        $sql_them = "INSERT INTO tb_product(id_category, name, brand, image, sale_price, normal_price, sold, quantity, date, status) VALUES (".$loaisanpham.", N'".$tensanpham."', N'".$hang."', N'".$hinhanh."',".$giaban.","."0".",0,".$soluong.", CURRENT_DATE(), ".$trangthai.")";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlysanpham');  
        // echo $sql_them;
    }
    else {
        echo "Heelo";
    }
?>