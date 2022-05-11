<div class="container">
    <div class="container__wrapper">
        <?php
            if (isset($_GET['action'])) {
                $temp = $_GET['action'];          
            }
            else {
                $temp = ''; 
            }
            if (isset($_GET['query'])) { 
                $query = $_GET['query'];            
            }
            else { 
                $query = '';
            }
            if ($temp == 'quanlysanpham' && $query == '') {
                include("manageProducts/show.php");
            }  
            else if ($temp == 'quanlysanpham' && $query == 'sua') {
                include("manageProducts/edit.php");
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
                include("manageProducts/show.php");
            }
        ?>
    </div> 
</div>