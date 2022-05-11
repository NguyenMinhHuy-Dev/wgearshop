<?php
    include("../../config/config.php");
 
    if (isset($_POST["themsanpham"]) || isset($_POST["suasanpham"])) { 
        $tensanpham = $_POST["tensanpham"];
        $loaisanpham = $_POST["loaisanpham"];
        $hang = $_POST["hang"];
        $loaisanpham = $_POST["loaisanpham"]; 
        $giaban = $_POST["giaban"];
        $soluong = $_POST["soluong"];
        $trangthai = $_POST["trangthai"];
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
    }
    
    if (isset($_POST["themsanpham"])) {   
        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);

        $sql_them = "INSERT INTO tb_product(id_category, name, brand, image, sale_price, normal_price, sold, quantity, date, status) VALUES (".$loaisanpham.", N'".$tensanpham."', N'".$hang."', N'".$hinhanh."',".$giaban.","."0".",0,".$soluong.", CURRENT_DATE(), ".$trangthai.")";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?action=quanlysanpham');  
            // echo $sql_them; 
    }
    else if (isset($_POST["suasanpham"])){
        if ($hinhanh != '') {
            $hinhanh = time().'_'.$hinhanh;
            move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);
            $sql = "SELECT * FROM tb_product WHERE id=".$_GET["idsanpham"];
            $query = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($query)) {
                unlink('uploads/'.$row["image"]);
            }

            $sql_capnhat = "UPDATE tb_product SET id_category=".$loaisanpham.",name='".$tensanpham."',brand='".$hang."',image='".$hinhanh."',sale_price=".$giaban.",quantity=".$soluong.",status=".$trangthai." WHERE id=".$_GET['idsanpham'];
        }
        else {
            $sql_capnhat = "UPDATE tb_product SET id_category=".$loaisanpham.",name='".$tensanpham."',brand='".$hang."',sale_price=".$giaban.",quantity=".$soluong.",status=".$trangthai." WHERE id=".$_GET['idsanpham'];
        }
        // echo $sql_capnhat;
        mysqli_query($mysqli, $sql_capnhat);
        header('Location:../../index.php?action=quanlysanpham');  
    }
    else {
        $sql = "SELECT * FROM tb_product WHERE id=".$_GET["idsanpham"]." LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/'.$row["image"]);
        }
        $sql_xoa = "DELETE FROM tb_product WHERE id=".$_GET["idsanpham"];
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?action=quanlysanpham');  
    }
?>