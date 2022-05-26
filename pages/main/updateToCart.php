<?php
    session_start();

    if (isset($_GET['id'])) {
        if (isset($_SESSION['cart'])) {
            for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
                if ($_SESSION['cart'][$i]['id'] == $_GET['id']) { 
                    $_SESSION['cart'][$i]['amount'] = $_GET['soluong']; 
                    break;
                }
            }
        }
    } 
    header('Location: ../../index.php?giohang');
?>