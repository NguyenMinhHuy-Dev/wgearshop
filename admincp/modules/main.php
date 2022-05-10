<div class="container">
    <div class="container__wrapper">
        <?php
            if (isset($_GET['action'])) {
                $temp = $_GET['action'];
            }
            else {
                $temp = '';
            }
            if ($temp == 'quanlysanpham') {
                include("manageProducts/show.php");
            }  
            // else if ($temp == 'quanlyslider') {
            //     include("main/promotion.php");
            // }
            // else if ($temp == 'quanlykhuyenmai') {
            //     include("main/promotion.php");
            // }
            // else if ($temp == 'quanlytaikhoan') {
            //     include("main/promotion.php");
            // }
            else {
                include("modules/dashboard.php");
            }
        ?>
    </div> 
</div>