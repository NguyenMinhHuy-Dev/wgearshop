<?php
    include('admincp/config/config.php');

    
    if (!isset($_SESSION['USERNAME'])) {
?>
    <script>
        location.href = "signin.php?thanhtoan";
    </script>
<?php 
        die();
    }

    $name = '';
    $phone = '';
    $address = '';
    $email = ''; 
    
    if (!isset($_SESSION['cart'])) {
?>
        <script>
            location.href = "index.php";
        </script>
<?php 
    }

    if (isset($_SESSION['USERNAME'])) {
        $sql = "SELECT * FROM tb_account WHERE username='{$_SESSION['USERNAME']}'";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
        $name = $row['name'];
        $phone = $row['phone_number'];
        $address = $row['address'];
        $email = $row['contact'];
    } 
?>

<link rel="stylesheet" href="css/checkout.css?v=<?php echo time(); ?>">

<div class="grid check-out-page">
    
    <div class="cart-form">
        <div class="detail-form__product-configuration-heading" style="margin-bottom:30px; margin-top: 0">
            <h4>ĐƠN HÀNG CỦA BẠN</h4>
        </div> 
        <table class="cart-form-inner">
            <tr>
                <th align='left'>Sản phẩm</th>
                <th align='right'>Tạm tính</th>
            </tr>
            <?php
                $total = 0;
                for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
                    $total += ceil($_SESSION['cart'][$i]['amount'] * $_SESSION['cart'][$i]['sale_price']);
            ?>
            <tr>
                <td><?php echo $_SESSION['cart'][$i]['name']; ?><b> x <?php echo $_SESSION['cart'][$i]['amount']; ?></b></td>
                <td><?php echo number_format(ceil($_SESSION['cart'][$i]['amount'] * $_SESSION['cart'][$i]['sale_price']), 0, ".", ",")."đ"; ?></td>
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
                <td><?php echo number_format($total, 0, ".", ",")."đ"; ?></td>
            </tr>
        </table>
    </div>
    <div class="check-out-form">
        <div class="detail-form__product-configuration-heading" style="margin-bottom:20px; margin-top: 0">
            <h4 style="color:#d277f7">THÔNG TIN THANH TOÁN</h4>
        </div> 
        <form action="pages/main/pay.php?total=<?php echo $total; ?>" method="POST" id="check-out-info-form">
            <div class="check-out-info small-check-out-info"> 
                <div class="check-out-info check-out-name">
                    <label for="name">Họ và tên: </label>
                    <input type="text" name="name" id="name" class="input" placeholder="Họ tên" value="<?php echo $name; ?>" required>
                </div> 
                <div class="check-out-info check-out-phone">
                    <label for="phone">Số điện thoại: </label>
                    <input type="text" name="phone" id="phone" class="input" placeholder="Số điện thoại"  value="<?php echo $phone; ?>"required>
                </div>
            </div>
            <div class="check-out-info check-out-address">
                <label for="address">Địa chỉ: </label>
                <input type="text" name="address" id="address" class="input" placeholder="Địa chỉ giao hàng" value="<?php echo $address; ?>" required>
            </div>
            <div class="check-out-info check-out-email">
                <label for="email">Email: </label>
                <input type="text" name="email" id="email" class="input" placeholder="Email" value="<?php echo $email; ?>" required>
            </div>
            <div class="check-out-info check-out-method">
                <div class="all-method"> 
                    <div class="method" id="method">
                        <label for="method">Phương thức thanh toán: </label>
                        <div class="method1">
                            <input type="radio" checked name="method" id="method1" class="input" value="0" required>
                            <label for="method1">Thanh toán khi nhận hàng</label>
                            
                        </div>

                        <div class="method2">
                            <input type="radio" name="method" id="method2" class="input" value="1">
                            <label for="method2">Chuyển khoản ngân hàng</label>
                        </div>
                            
                    </div>
                    <div class="method" id="method-recieve">
                        <label for="method-recieve">Phương thức giao hàng: </label>
                        <div class="method1">
                            <input type="radio" checked name="method-Re" id="method-Re1" class="input" value="0" required>
                            <label for="method-Re1">Giao hàng tận nơi</label> 
                        </div>

                        <div class="method2">
                            <input type="radio" name="method-Re" id="method-Re2" class="input" value="1">
                            <label for="method-Re2">Giao hàng tại quầy</label>
                        </div>
                            
                    </div> 
                </div>
                <div class="info-method-1" id="info-method-1" >
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
                </div>
            </div>
            <div class="check-out-info check-out-message">
                <label for="message">Lời nhắn: </label>
                <textarea name="message" id="message" class="input" cols="30" rows="10" placeholder="Lời nhắn về đơn hàng (Ngày giờ giao hàng, chi tiết địa chỉ giao hàng,...)"></textarea>
                <!-- <input type="text" name="message" id="message" class="input" placeholder="Lời nhắn" required> -->
            </div>
            <div class="check-out-info check-out-accept"> 
                <input type="submit" name="submit" id="submit" class="input btn btn--pri" value="ĐẶT HÀNG" required>
            </div>
        </form>
    </div>
</div> 