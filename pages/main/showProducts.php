<?php
    $mysqli = new mysqli("localhost","root","","wgear"); 
    // Check connection
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli->connect_error;
      exit();
    }


    if (isset($_GET['danhmuc'])) {
        $temp = $_GET['danhmuc'];
    }

    if ($temp == 'banphim') {
        $id_category = 1;
    }
    else if ($temp == 'chuot') { 
        $id_category = 2;
    }
    else if ($temp == 'tainghe') { 
        $id_category = 3;
    }

    if ($temp != 'sanpham') {
        if ($_GET["sapxep"] == "moinhat") {
            $sort = "date DESC";
        }
        else if ($_GET["sapxep"] == "banchay") {
            $sort = "sold DESC";
        }
        else if ($_GET["sapxep"] == "giamdan") {
            $sort = "sale_price DESC";
        }
        else if ($_GET["sapxep"] == "tangdan") {
            $sort = "sale_price ASC";
        }
        
        if (isset($_GET["tu"]) && isset($_GET["den"])) {
            if ($_GET["loc"] == "tatca") {
                $sql = "SELECT * FROM tb_product WHERE id_category=".$id_category." AND sale_price BETWEEN ".$_GET["tu"]." AND ".$_GET["den"]." ORDER BY ".$sort;
            }
            else {
                $sql = "SELECT * FROM tb_product WHERE id_category=".$id_category." AND brand='".$_GET["loc"]."' AND sale_price BETWEEN ".$_GET["tu"]." AND ".$_GET["den"]." ORDER BY ".$sort;
            }
        }
        else {
            if ($_GET["loc"] == "tatca") {
                $sql = "SELECT * FROM tb_product WHERE id_category=".$id_category." ORDER BY ".$sort;
            }
            else if ($_GET["loc"] == "others") {
                $sql_loc = "SELECT DISTINCT brand FROM tb_product WHERE id_category=".$id_category." ORDER BY brand ASC LIMIT 7";
                $query_loc = mysqli_query($mysqli, $sql_loc); 
                $num_rows = mysqli_num_rows($query_loc);
                
                $sql = "SELECT * FROM tb_product WHERE id_category=".$id_category." AND id NOT IN (SELECT id FROM tb_product WHERE ";
                $count = 0;
                $row;
                while ($row = mysqli_fetch_array($query_loc)) { 
                    $sql = $sql."brand='".$row["brand"]."' OR ";
                    $count++; 
                    if ($count == $num_rows)
                        break;
                } 
                $sql = $sql."brand='".$row["brand"]."' AND id_category=".$id_category;
                $sql = $sql.") ORDER BY ".$sort;
            }
            else {
                $sql = "SELECT * FROM tb_product WHERE id_category=".$id_category." AND brand='".$_GET["loc"]."' ORDER BY ".$sort;
            }
        }
    }
    if (isset($_GET["timkiem"])) {
        $sql = "SELECT * FROM tb_product WHERE name LIKE '%".$_GET["timkiem"]."%'";
    }  
?>

<div class="grid container__wrapper-products">  
    <ul class="container__wrapper-products-list Keyboards page">
<?php
    // echo $sql;
    $sql_tmp = $sql;
    $query = mysqli_query($mysqli, $sql);
    
    $total_records = mysqli_num_rows($query);
    $record_per_page = 10;
    $page = (int)$_GET["trang"];
    $start_from = ($page - 1)*$record_per_page; 

    $sql_tmp = $sql_tmp." LIMIT ".$start_from.", ".$record_per_page;
    // echo $page;
    $query = mysqli_query($mysqli, $sql_tmp);
    while ($row = mysqli_fetch_array($query)) {
        if ($row['status'] == 1) {
?>
        <li class="container__wrapper-product"> 
            <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>">
                <div class="container__wrapper-product-img" style="user-select:none">
                    <div class="container__wrapper-product-overlay" style="user-select:none"></div>
                    <div class="container__wrapper-product-button-see">
                        <button class="btn btn--sec container__wrapper-product-see">XEM CHI TIẾT</button>
                    </div>
                    <img src="admincp/modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm">
                </div>
            </a>
            <div class="container__wrapper-product-info">
                <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>"></a>
                <div class="container__wrapper-product-info-layout">
                    <!-- <a href=""></a> -->
                    <div class="container__wrapper-product-name">
                        <!-- <a href="">
                            <span></span>
                        </a> -->
                        <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>" class="header__cart-list-item-name"><?php echo $row["name"]; ?></a>
                    </div>
                    <div class="container__wrapper-product-prices">
                        <span class="container__wrapper-product-price-normal product-price-sale"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></span>
                        <span class="container__wrapper-product-price-normal">
                            <?php
                                if ($row["normal_price"] != $row['sale_price']) {
                                    echo number_format($row['normal_price'], 0, ".", ",")."đ";
                                }
                            ?>
                        </span>
                    </div>
                </div>
            </div>  
        </li>
<?php
        }
    }
?>
    </ul>
</div> 

<div class="grid container__page-numbers">
    <div class="page-numbers">
        <?php
            if ($_GET["trang"] != 1) {
                echo "<i id='1' class='icon arrow left-arrow pagination_link fa-solid fa-angles-left'></i>";
                echo "<i id='".($_GET['trang'] - 1)."' class='icon arrow left-arrow pagination_link fa-solid fa-angle-left'></i>";
            }
            else {
                echo "<i style='color:var(--input); user-select:none' class='icon arrow left-arrow fa-solid fa-angles-left'></i>";
                echo "<i style='color:var(--input); user-select:none' class='icon arrow left-arrow fa-solid fa-angle-left'></i>";
            }
        ?> 
        <ul>
            <?php 
                $total_pages = ceil($total_records/$record_per_page);
                $during_pages = ceil($total_pages/9);
                $x = 10; 
                while ($x <= $_GET['trang']) { 
                    $x += 9;
                }
                $i = $x - 9;
                // if ($i == 0) {
                //     $i = 1;
                // } 
                    for (; $i <= $total_pages ; $i++) { 
                        if ($i == $x) {
                            break;
                        }
            ?>
            
            <li style="user-select:none" class="pagination_link <?php if ($_GET["trang"] == $i) echo "active" ?>" id="<?php echo $i; ?>"><?php echo $i; ?></li>
            <!-- <li>2</li>
            <li><i class="fa-solid fa-ellipsis"></i></li>
            <li>15</li> -->
            <?php
                    }
                // }
            ?>
        </ul>

        <?php
            if ($_GET["trang"] != $total_pages) {
                echo "<i id='".($_GET["trang"] + 1)."' class='icon arrow right-arrow pagination_link fa-solid fa-angle-right'></i>";
                echo "<i id='{$total_pages}' class='icon arrow right-arrow pagination_link fa-solid fa-angles-right'></i>";
            }
            else {
                echo "<i style='color:var(--input); user-select:none' class='icon arrow right-arrow fa-solid fa-angle-right'></i>";
                echo "<i style='color:var(--input); user-select:none' class='icon arrow right-arrow fa-solid fa-angles-right'></i>";
            }
        ?> 
        
    </div>
</div>