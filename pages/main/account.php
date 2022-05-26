<?php
    
    if (!isset($_SESSION['USERNAME'])) {
?>
    <script>
        location.href = "signin.php";
    </script>
<?php
    }

    include('admincp/config/config.php');

    if (isset($_SESSION['USERNAME'])) {
        $sql = "SELECT * FROM tb_account WHERE username='".$_SESSION['USERNAME']."'";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query); 
    }

    $msgName = '';
    $msgEmail = '';
    $msgPhone = '';
    $msgAddress = '';
?>

<link rel="stylesheet" href="css/account.css?v=<?php echo time(); ?>">

<div class="grid container__wrapper-products">
    <div id="user-info-form" class="user-info-form" style="margin-bottom:100px">
        <div class="detail-form__product-configuration-heading" style="margin-bottom:20px; margin-top: 40px">
            <h4 id="account-info-header" style="color:#d277f7">THÔNG TIN TÀI KHOẢN</h4>
        </div>
        <div class="sign-in">  
            <div class="button-order">
                <button onclick="myOrder()" class="btn btn--sec order-button"><i class="icon fa-solid fa-cart-shopping"></i></button>
            </div>
            <form enctype="multipart/form-data" action="pages/main/updateAccount.php" method="POST">
                <div class="user-account-avatar">
                    <div class="avatar">
                        <img src="./admincp/modules/manageAccounts/uploads/<?php echo $row['avatar']; ?>" alt="" id="select_avatar" =class="">
                    </div>
                    <input type="file" name="avatar" id="input-avatar" >
                    
                    <span class="header__user-account-name"><?php echo $row['username']; ?></span>
                </div>
                <div class="user-table" id="user-table"> 
                    <table id="user-info-table">
                        <tr>
                            <td align='center' style="font-size: 20px; font-weight: bold">Họ tên:</td>
                            <td>
                                <input type="text" name="input-name" id="input-name" class="input" value="<?php echo $row['name']; ?>">
                                <?php echo $msgName; ?>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' style="font-size: 20px; font-weight: bold">Email:</td>
                            <td><input type="text" name="input-email" id="input-email" class="input" value="<?php echo $row['contact']; ?>" disabled></td>
                            <?php echo $msgEmail; ?>
                        </tr>
                        <tr>
                            <td align='center' style="font-size: 20px; font-weight: bold">Số điện thoại:</td>
                            <td>
                                <input type="text" name="input-phone_number" id="input-phone_number" class="input" value="<?php echo $row['phone_number']; ?>">
                                <?php echo $msgPhone; ?>
                            </td>
                        </tr> 
                        <tr>
                            <td align='center' style="font-size: 20px; font-weight: bold">Địa chỉ:</td>
                            <td><input type="text" name="input-address" id="input-address" class="input" value="<?php echo $row['address']; ?>"></td>
                            <?php echo $msgAddress; ?>
                        </tr> 
                        <tr>
                            <td align='center' style="font-size: 20px; font-weight: bold">Mật khẩu:</td>
                            <!-- <td><input type="text" name="input-password" id="input-password" class="input" placeholder="Nhập nếu đổi mật khẩu mới"></td> -->
                            <td colspan='2'>
                                <!-- <form action="" method="POST" id="password-form">         -->
                                    <input type="submit" for="password-form"  name="change-password" class="btn btn--sec container__wrapper-product-see" id="change-password" value="ĐỔI MẬT KHẨU"></input> 
                                <!-- </form> -->
                            </td>
                        </tr> 
                        <tr>
                            <td colspan='2'>
                                <button type="submit" name="submit" class="btn btn--pri container__wrapper-product-see" id="button-buy">CẬP NHẬT</button> 
                            </td>
                        </tr> 
                    </table> 
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#select_avatar").click(function(e){
       e.preventDefault();
       $("#input-avatar").trigger('click');
    });
    $("#change-password").click(function(e){
       e.preventDefault();
       <?php
            // unset($_SESSION['USERNAME']); 
       ?>
       location.href = 'forgotPassword.php?change';
    });
</script>

<script>
    function acceptOrder(id) {
        location.href = `pages/main/updateAccount.php?accept-order=${id}`;
    }

    function returnOrder(id) {
        location.href = `pages/main/updateAccount.php?return-order=${id}`;
    }
    
    function myOrder() { 
        document.getElementById('account-info-header').innerHTML = "ĐƠN HÀNG CỦA BẠN";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("user-table").innerHTML = this.responseText;
            } 
        };    
        var path = "pages/main/accountOrder.php";
        xhttp.open("GET", path, true);
        xhttp.send();
    }
</script>