<?php 
    session_start();
    // session_destroy();
    unset($_SESSION['USERNAME_ADMIN']); 

    header("Location: index.php");
?>