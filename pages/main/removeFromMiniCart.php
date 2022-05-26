<?php
    session_start();
    
    // session_destroy();
    // die();
    include('../../admincp/config/config.php');
    if (isset($_GET['id'])) {
        for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
            if ($_SESSION['cart'][$i]['id'] == $_GET['id']) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;    
            }
        } 
?> 
<a href="index.php?giohang" class="header__user-cart--link">
    <i class="icon fa-solid fa-basket-shopping"></i>
    <span id="amount-number"class="header__user-cart--quality">
    <?php 
        if (isset($_SESSION['cart'])) {
            $count = 0;
            for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
                $count += $_SESSION['cart'][$i]['amount'];
            }
            echo $count;
        }
        else { 
            echo 0;
        }
    ?>
    </span>
</a>

<!-- Empty: header__user-cart-list--empty -->
<?php
    if (!isset($_SESSION['cart']) || sizeof($_SESSION['cart']) == 0) {
?>
        <div class="header__user-cart-list header__user-cart-list--empty">
            <img src="./img/Cart/cart-list-empty.jpg" alt="" class="header__user-cart-empty-img">
            <div class="header__car onclick="openCart()"t-list-see">
                <!-- <a href="#"> -->
                    <button onclick="openCart()" class="btn btn--pri header__cart-list-see-button">XEM GIỎ HÀNG</button>
                <!-- </a> -->
            </div>
        </div>
<?php
    }
    else {
?>
        <div class="header__user-cart-list ">
            <img src="./img/Cart/cart-list-empty.jpg" alt="" class="header__user-cart-empty-img">

            <h4 class="header__cart-list--heading">Danh sách sản phẩm</h4>
            <ul class="header__cart-list-items" id="cart-list">
                <?php 
                    for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {  
                ?>
                        <li class="header__cart-list-item">
                            <img src="admincp/modules/manageProducts/uploads/<?php echo $_SESSION['cart'][$i]['image']; ?>" alt="Sản phẩm" class="header__cart-list-item-igm">

                            <div class="header__cart-list-item-info"> 
                                <div class="header__cart-list-item-name-box">
                                    <a href="index.php?chitietsanpham=<?php echo $_SESSION['cart'][$i]['name']; ?>" class="header__cart-list-item-name"><?php echo $_SESSION['cart'][$i]['name']; ?></a>
                                </div>
                                <span class="header__cart-list-item-price product-price-sale"><?php echo number_format($_SESSION['cart'][$i]['sale_price'], 0, ".", ",")."đ"; ?></span>
                                <div class="header__cart-list-item-detail">
                                    <span class="header__cart-list-item-detail-heading">Số lượng:</span>
                                    <span class="header__cart-list-item-quality"><?php echo $_SESSION['cart'][$i]['amount']; ?></span>
                                </div>
                            </div>

                            <button type="button" onclick="removeFromMiniCart(<?php echo $_SESSION['cart'][$i]['id']; ?>)" class="btn btn--pri header__cart-list-item-remove">XÓA</button>
                        </li> 
                <?php
                    }
                ?>
            </ul>

            <div class="header__cart-list-see">
                <!-- <a href="./pages/main/cart.php"> -->
                    <button onclick="openCart()" class="btn btn--pri header__cart-list-see-button">XEM GIỎ HÀNG</button>
                <!-- </a> -->
            </div>
        </div>
<?php
        }
    }
?>
