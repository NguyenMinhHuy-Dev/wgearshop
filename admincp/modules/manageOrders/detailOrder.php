<?php 
    include("../.././config/config.php"); 
    $sql = "SELECT * FROM tb_cart WHERE id={$_GET['id']}";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

    $sql_detail = "SELECT * FROM tb_cart_detail WHERE id_cart={$row['id']}";
    $query_detail = mysqli_query($mysqli, $sql_detail);
?>

<link rel="stylesheet" href="./css/detailOrder.css">

<div class="check-out-page">
    
    <div class="cart-form">
        <div class="detail-form__product-configuration-heading" style="margin-bottom:30px; margin-top: 0">
            <h4>ĐƠN HÀNG <?php echo "WG-".$row['id']; ?></h4>
        </div> 
        <table class="cart-form-inner">
            <tr>
                <th align='left'>Sản phẩm</th>
                <th align='right'>Tạm tính</th>
            </tr>
            <?php  
                while ($row_detail = mysqli_fetch_array($query_detail)) {
                    $sql_product = "SELECT * FROM tb_product WHERE id={$row_detail['id_product']}";
                    $query_product = mysqli_query($mysqli, $sql_product);
                    $row_product = mysqli_fetch_array($query_product);
            ?>
                    <tr>
                        <td><?php echo $row_product['name']; ?><b> x </b><?php echo $row_detail['amount']; ?></td>
                        <td><?php echo number_format(ceil($row_detail['amount'] * $row_product['sale_price']), 0, ".", ",")."đ"; ?></td>
                    </tr>
            <?php
                }
            ?>
            <tr>
                <td><strong>Phí giao hàng</strong></td>
                <td>Miễn phí</td>
            </tr>
            <tr>
                <td align='left'><b>TỔNG TIỀN: </b></td>
                <td><?php echo number_format($row['total'], 0, ".", ",")."đ"; ?></td>
            </tr>
        </table>
    </div>
    <div class="check-out-form">
        <!-- <div class="detail-form__product-configuration-heading" style="margin-bottom:20px; margin-top: 0">
            <h4 style="color:#d277f7">THÔNG TIN THANH TOÁN</h4>
        </div>  -->
        <form action="pages/main/pay.php?total=" method="POST" id="check-out-info-form">
            <div class="check-out-info small-check-out-info"> 
                <div class="check-out-info check-out-name">
                    <label for="name">Họ và tên: </label>
                    <input disabled type="text" name="name" id="name" class="input" placeholder="Họ tên" value="<?php echo $row['name_customer']; ?>">
                </div> 
                <div class="check-out-info check-out-phone">
                    <label for="phone">Số điện thoại: </label>
                    <input disabled type="text" name="phone" id="phone" class="input" placeholder="Số điện thoại"  value="<?php echo $row['phone_customer']; ?>">
                </div>
            </div>
            <div class="check-out-info check-out-address">
                <label for="address">Địa chỉ: </label>
                <input disabled type="text" name="address" id="address" class="input" placeholder="Địa chỉ giao hàng" value="<?php echo $row['address_customer']; ?>" >
            </div>
            <div class="check-out-info check-out-email">
                <label for="email">Email: </label>
                <input disabled type="text" name="email" id="email" class="input" placeholder="Email" value="<?php echo $row['email_customer']; ?>" >
            </div>
            <div class="check-out-info check-out-method">
                <div class="all-method"> 
                    <div class="method" id="method">
                        <label for="method">Phương thức thanh toán: </label>
                        <div class="method1">
                            <input disabled type="radio" <?php if ($row['method_payment'] == 0) echo "checked"; ?> name="method" id="method1" class="input" value="" >
                            <label for="method1">Thanh toán khi nhận hàng</label>
                            
                        </div>

                        <div class="method2">
                            <input disabled type="radio" <?php if ($row['method_payment'] == 1) echo "checked"; ?> name="method" id="method2" class="input" value="1">
                            <label for="method2">Chuyển khoản ngân hàng</label>
                        </div>
                            
                    </div>
                    <div class="method" id="method-recieve">
                        <label for="method-recieve">Phương thức giao hàng: </label>
                        <div class="method1">
                            <input disabled type="radio" <?php if ($row['method_recieve'] == 0) echo "checked"; ?> name="method-Re" id="method-Re1" class="input" value="0" required>
                            <label for="method-Re1">Giao hàng tận nơi</label> 
                        </div>

                        <div class="method2">
                            <input disabled type="radio" <?php if ($row['method_recieve'] == 1) echo "checked"; ?> name="method-Re" id="method-Re2" class="input" value="1">
                            <label for="method-Re2">Giao hàng tại quầy</label>
                        </div>
                            
                    </div> 
                </div>
                <!-- <div class="info-method-1" id="info-method-1" >
                    <span>Lưu ý: Khách hàng vui lòng liên hệ W-Gear trước khi chuyển khoản</span>
                    <p>
                        <b>NGÂN HÀNG QUÂN ĐỘI MB BANK - Chi nhánh thành phố Hồ Chí Minh</b><br>
                        Số tài khoản: XXXXXXXXXXX<br>
                        Chủ tài khoản: CÔNG TY TNHH W-GEAR
                    </p>
                    <br>
                    <p>
                        <b>NGÂN HÀNG TMCP KỸ THƯƠNG VIỆT NAM – TECHCOMBANK – Chi nhánh ĐÔNG SÀI GÒN</b><br>
                        Số tài khoản: XXXXXXXXXXXX<br>
                        Chủ tài khoản: CÔNG TY TNHH W-GEAR
                    </p>
                </div> -->
            </div>
            <div class="check-out-info check-out-message">
                <label for="message">Lời nhắn: </label>
                <textarea disabled name="message" id="message" class="input" cols="30" rows="10" placeholder="Lời nhắn về đơn hàng (Ngày giờ giao hàng, chi tiết địa chỉ giao hàng,...)"><?php echo $row['message']; ?></textarea>
                <!-- <input type="text" name="message" id="message" class="input" placeholder="Lời nhắn" required> -->
            </div> 
        </form>
    </div>
</div> 