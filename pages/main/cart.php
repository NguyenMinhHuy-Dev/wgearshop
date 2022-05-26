<link rel="stylesheet" href="./css/cart.css">

<div class="grid">
    <div class="detail-form__product-configuration-heading" style="margin-bottom:0">
        <h4 style="color:#d277f7">GIỎ HÀNG</h4>
    </div>
    <div class="cart-table">
        <table>
            <thead>
                <tr>
                    <th>SẢN PHẨM</th>
                    <th>GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>TẠM TÍNH</th>
                    <th>XÓA</th>
                </tr>
            </thead>
            <tbody>
                <?php ;
                    $total = 0;
                    if (isset($_SESSION['cart']) && sizeof($_SESSION['cart']) != 0) {
                        for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
                            $total += ceil($_SESSION['cart'][$i]['amount'] * $_SESSION['cart'][$i]['sale_price']);
                ?>
                <tr>
                    <td>
                        <div class="image-product">
                            <img src="admincp/modules/manageProducts/uploads/<?php echo $_SESSION['cart'][$i]['image']; ?>" alt="Sản phẩm">
                            <span><?php echo $_SESSION['cart'][$i]['name']; ?></span>
                        </div>
                    </td>
                    <td>
                        <?php echo number_format($_SESSION['cart'][$i]['sale_price'], 0, ".", ",")."đ"; ?>
                    </td>
                    <td>
                        <?php 
                            include("admincp/config/config.php");
                            $sql = "SELECT * FROM tb_product WHERE id={$_SESSION['cart'][$i]['id']}";
                            $query = mysqli_query($mysqli, $sql);
                            $row = mysqli_fetch_array($query);
                            
                        ?>
                        <input id="<?php echo $_SESSION['cart'][$i]['id']; ?>" type="number" id="" min="1" max="<?php echo $row['quantity']; ?>" class="input amount" value="<?php echo $_SESSION['cart'][$i]['amount']; ?>"> 
                        <input type="button" onclick="updateAmount(<?php echo $_SESSION['cart'][$i]['id']; ?>)" class="btn btn--pri container__wrapper-product-see" id="" value="Cập nhật"></input>

                    </td>
                    <td>
                        <?php echo number_format(ceil($_SESSION['cart'][$i]['amount'] * $_SESSION['cart'][$i]['sale_price']), 0, ".", ",")."đ"; ?>
                    </td>
                    <td>
                        <i onclick="removeFromMainCart(<?php echo $_SESSION['cart'][$i]['id']; ?>)" class="icon fa-solid fa-trash"></i>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
                <tr>
                    <td colspan='3'>TỔNG TIỀN GIỎ HÀNG:</td>
                    <td colspan='2'><?php echo number_format($total, 0, ".", ",")."đ"; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="add-product">
        <input type="button" onclick="checkOut()" <?php if (!isset($_SESSION['cart']) || sizeof($_SESSION['cart']) == 0) echo "disabled"; ?> class="btn btn--pri container__wrapper-product-see" id="button-buy" value="THANH TOÁN"></input>
    </div>  
</div>

<script> 
    function removeFromMainCart(id) {
        location.href = `./pages/main/removeFromMainCart.php?id=${id}`;
    }
    function updateAmount(id) { 
        location.href = `./pages/main/updateToCart.php?id=${id}&soluong=${document.getElementById(`${id}`).value}`;
    }
    function checkOut() {
        location.href = `index.php?thanhtoan`;
    }
</script>