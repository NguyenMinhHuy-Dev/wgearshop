<?php
    session_start();

    include("../../admincp/config/config.php");
    if (isset($_POST['submit'])) {
        $sql = "INSERT INTO tb_cart(name_customer, phone_customer, address_customer, email_customer, date, method_payment, method_recieve, message, total, status) VALUES ('{$_POST['name']}','{$_POST['phone']}','{$_POST['address']}','{$_POST['email']}', CURRENT_TIMESTAMP(),{$_POST['method']},{$_POST['method-Re']},'{$_POST['message']}',{$_GET['total']},0)";
        $query = mysqli_query($mysqli, $sql);
        
        
        if ($query) {
            $sql_max = "SELECT MAX(id) FROM tb_cart WHERE email_customer='{$_POST['email']}'";
            $query_max = mysqli_query($mysqli, $sql_max);
            $row = mysqli_fetch_array($query_max);  

            for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
                $sql_them = "INSERT INTO tb_cart_detail(id_cart, id_product, amount) VALUE({$row['MAX(id)']}, {$_SESSION['cart'][$i]['id']}, {$_SESSION['cart'][$i]['amount']})";
                $query_them = mysqli_query($mysqli, $sql_them);
                $sql_update = "UPDATE tb_product SET sold = sold + {$_SESSION['cart'][$i]['amount']}, quantity = quantity - {$_SESSION['cart'][$i]['amount']} WHERE id={$_SESSION['cart'][$i]['id']}";
                $query_update = mysqli_query($mysqli, $sql_update);
            }
        }
    }
    unset($_SESSION['cart']); 
    header("Location: ../../index.php");
?>