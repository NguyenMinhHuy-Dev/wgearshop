<?php 
    session_start();
    // session_destroy();
    unset($_SESSION['USERNAME']); 

    header("Location: index.php");
?>