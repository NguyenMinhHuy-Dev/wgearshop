<?php
    include("../../config/config.php");
 
    if (isset($_POST["themsanpham"]) || isset($_POST["suasanpham"])) { 
        $tensanpham = $_POST["tensanpham"];
        $loaisanpham = $_POST["loaisanpham"];
        $hang = trim($_POST["hang"]);
        $loaisanpham = $_POST["loaisanpham"]; 
        $giaban = $_POST["giaban"];
        // $giakhuyenmai = $_POST["giakhuyenmai"];
        $soluong = $_POST["soluong"];
        // $daban = $_POST["daban"];
        // $ngaytao = $_POST["ngaytao"]; 
        $ngaycapnhat = "CURRENT_DATE()";
        // $trangthai = $_POST["trangthai"];
        $hinhanh = $_FILES["hinhanh"]["name"];
        $hinhanh_tmp = $_FILES["hinhanh"]["tmp_name"];
    }
    
    if (isset($_POST["themsanpham"])) {   
        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);

        $sql_them = "INSERT INTO tb_product(id_category, name, brand, image, sale_price, normal_price, sold, quantity, date, status) VALUES (".$loaisanpham.", N'".$tensanpham."', N'".$hang."', N'".$hinhanh."',".$giaban.",".$giaban.",0,".$soluong.", CURRENT_DATE(), 1)";
        mysqli_query($mysqli, $sql_them);
        header('Location:../../index.php?products');   
    }
    if (isset($_POST["suasanpham"])){
        $giakhuyenmai = $_POST["giakhuyenmai"];
        $daban = $_POST["daban"];
        $ngaytao = $_POST["ngaytao"]; 
        $trangthai = $_POST["trangthai"];
        if ($hinhanh != '') {
            $hinhanh = time().'_'.$hinhanh;
            move_uploaded_file($hinhanh_tmp, 'uploads/'.$hinhanh);
            $sql = "SELECT * FROM tb_product WHERE id=".$_GET["idsanpham"];
            $query = mysqli_query($mysqli, $sql);
            while ($row = mysqli_fetch_array($query)) {
                unlink('uploads/'.$row["image"]);
            }

            $sql_capnhat = "UPDATE tb_product SET id_category=".$loaisanpham.",name='".$tensanpham."',brand='".$hang."',image='".$hinhanh."',sale_price=".$giakhuyenmai.", normal_price=".$giaban.",quantity=".$soluong.", sold=".$daban." ,date='".$ngaytao."', update_date=".$ngaycapnhat.",status=".$trangthai." WHERE id=".$_GET['idsanpham'];
        }
        else {
            $sql_capnhat = "UPDATE tb_product SET id_category=".$loaisanpham.",name='".$tensanpham."',brand='".$hang."',sale_price=".$giakhuyenmai.", normal_price=".$giaban.",quantity=".$soluong.", sold=".$daban." ,date='".$ngaytao."', update_date=".$ngaycapnhat.",status=".$trangthai." WHERE id=".$_GET['idsanpham'];
        }
        // echo $sql_capnhat;
        mysqli_query($mysqli, $sql_capnhat);
        header('Location:../../index.php?products');  
    }
    else { 
        $sql = "SELECT * FROM tb_product WHERE id=".$_GET["idsanpham"]." LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/'.$row["image"]);
        }
        $sql_xoa = "DELETE FROM tb_product WHERE id=".$_GET["idsanpham"];
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?products');  
    }
?>