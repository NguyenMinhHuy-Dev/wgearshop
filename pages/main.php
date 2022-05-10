<div class="container">
    <div class="container__wrapper">
        <?php
            if (isset($_GET['danhmuc'])) {
                $temp = $_GET['danhmuc'];
            }
            else {
                $temp = '';
            }
            if ($temp == 'banphim' || $temp == 'chuot' || $temp == 'tainghe') {
                include("main/product.php");
            }  
            else if ($temp == 'khuyenmai') {
                include("main/promotion.php");
            }
            else {
                include("main/index.php");
            }
        ?>
    </div> 
</div>