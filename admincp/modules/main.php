<section class="home-section">
    <?php
        
        include("modules/header.php");

        // if (isset($_GET['action'])) {
        //     $temp = $_GET['action'];          
        // }
        // else {
        //     $temp = ''; 
        // }
        // if (isset($_GET['query'])) { 
        //     $query = $_GET['query'];            
        // }
        // else { 
        //     $query = '';
        // }
        if (isset($_GET['products'])) {
            include("manageProducts/product.php");
        } 
        else if (isset($_GET['customers'])) {
            include("manageAccounts/customer.php");
        }
        else if (isset($_GET['orders'])) {
            include("manageOrders/order.php");
        }
        else if (isset($_GET['promotion'])) {
            include("managePromotion/promotion.php");
        }
        else if (isset($_GET['setting'])) {
            include("setting.php");
        }
        else if (isset($_GET['chart'])) {
            include("chart.php");
        }
        else if (isset($_GET['detailproduct'])) {
            include("manageProductDetail/productDetail.php");
        }
        else if (isset($_GET['editDetail'])) {
            include("manageProductDetail/edit.php");
        }
        // else if ($temp == 'quanlysanpham' && $query == 'sua') {
        //     include("manageProducts/edit.php");
        // }
        else {
            include("dashboard.php");
        }
    ?>
    
</section>