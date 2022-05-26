<?php
    session_start();
    
    // session_destroy();
    // die(); 

    if (isset($_GET['id'])) {
        for ($i = 0 ; $i < sizeof($_SESSION['cart']) ; $i++) {
            if ($_SESSION['cart'][$i]['id'] == $_GET['id']) {
                unset($_SESSION['cart'][$i]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                break;    
            }
        } 
    }
    header('Location: ../../index.php?giohang');
?> 