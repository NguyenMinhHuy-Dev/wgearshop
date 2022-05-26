<div class="container">
    <div class="container__wrapper">
        <?php
            include("admincp/config/config.php");
            $sql = 'SELECT * FROM tb_page WHERE date=CURRENT_DATE()';
            $query = mysqli_query($mysqli, $sql);
    
            if (mysqli_num_rows($query) == 0) {
                $sql = 'INSERT INTO tb_page(view, date) VALUES(1, CURRENT_DATE())';
                $query = mysqli_query($mysqli, $sql);
            }
            else {
                $sql = "UPDATE tb_page SET view=view + 1 WHERE date=CURRENT_DATE()";
                $query = mysqli_query($mysqli, $sql);
            }


            
            $temp = '';
            if (isset($_GET['danhmuc'])) {
                $temp = $_GET['danhmuc'];
            }
            else if (isset($_GET['chitietsanpham'])) {
                $temp = $_GET['chitietsanpham']; 
            }
            if ($temp == 'banphim' || $temp == 'chuot' || $temp == 'tainghe' || $temp == 'sanpham') {
                include("main/product.php");
            }  
            else if ($temp == 'khuyenmai') {
                include("main/promotion.php");
                echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Khuyến mãi W-Gear';</script>";
            }
            else if (isset($_GET['chitietsanpham'])) {
                include("main/detailProduct.php");
                echo "<script>document.getElementsByTagName('title')[0].innerHTML = '".$_GET['chitietsanpham']."';</script>";
            }
            else if (isset($_GET['giohang'])) {
                include("main/cart.php");
                echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Giỏ hàng W-Gear';</script>";
            }
            else if (isset($_GET['taikhoan'])) {
                include("main/account.php");
                echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Tài khoản ".$_SESSION['USERNAME']."';</script>";
            }
            else if (isset($_GET['thanhtoan'])) {
                include("main/checkOut.php");
                echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Thanh toán giỏ hàng';</script>";
            }
            else {
                include("main/index.php");
            }
        ?>
    </div> 
</div>