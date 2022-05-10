<?php
    if (isset($_GET['danhmuc'])) {
        $temp = $_GET['danhmuc'];
    }
    else {
        $temp = '';
    }

    if ($temp == 'banphim') {
        echo "<h1>Ban phim</h1>";
    }
    else if ($temp == 'chuot') {
        echo "<h1>Chuot</h1>";
    }
    else if ($temp == 'tainghe') {
        echo "<h1>Tai nghe</h1>";
    }
?>