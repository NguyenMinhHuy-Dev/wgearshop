<?php
    include('admincp/config/config.php');
?>

<link rel="stylesheet" href="css/promotion.css">

<div class="promotion-container">
    <?php 
        $sql = "SELECT * FROM tb_promotion";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
    ?>
    <div class="grid container__wrapper ">
        <img src="admincp/modules/managePromotion/uploads/<?php echo $row['image']; ?>" alt="">
    </div>
    <?php
        }
    ?>
    <!-- <div class="grid container__wrapper ">
        <img src="admincp/modules/managePromotion/uploads/keyboard-promote.jpg" alt="">
    </div>
    <div class="grid container__wrapper ">
        <img src="admincp/modules/managePromotion/uploads/mouse-promote.jpg" alt="">
    </div> -->
</div>