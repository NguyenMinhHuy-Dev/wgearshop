<?php
    include("./config/config.php");
    include("modules/manageProducts/add.php"); 

    $sql_lietke = "SELECT * FROM tb_product";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="grid container__wrapper-products">
    <ul class="container__wrapper-products-list active">
        <li class="container__wrapper-product plus-sign"> 
            <!-- <a href="#"> -->
                <div class="container__wrapper-product-img">
                    <div class="container__wrapper-product-overlay"></div>
                    <div class="container__wrapper-product-button-see">
                        <button class="btn btn--sec container__wrapper-product-see" id="button-add">THÊM SẢN PHẨM</button>
                    </div>
                </div>
            <!-- </a>  -->
        </li> 

        <?php
            while ($row = mysqli_fetch_array($query_lietke)) { 
        ?>
        <li class="container__wrapper-product" style="opacity:<?php if ($row["status"] == 1) echo 1; else echo 0.5; ?>"> 
            <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>">
                <div class="container__wrapper-product-img">
                    <div class="container__wrapper-product-overlay"></div>
                    <div class="container__wrapper-product-button-see">
                        <button class="btn btn--sec container__wrapper-product-see button-edit">SỬA</button>
                    </div>
                    <img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm">
                </div>
            </a>
            <div class="container__wrapper-product-info">
                <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>"></a>
                <div class="container__wrapper-product-info-layout">
                    <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>"></a>
                    <div class="container__wrapper-product-name">
                        <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>">
                            <span></span>
                        </a>
                    <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>" class="header__cart-list-item-name"><?php echo $row['name']; ?></a>
                    </div>
                    <div class="container__wrapper-product-prices">
                        <span class="container__wrapper-product-price-normal product-price-sale">
                            <?php 
                                echo number_format($row['sale_price'], 0, ".", ",")."đ"; 
                            ?>
                        </span>
                        <span class="container__wrapper-product-price-normal">
                            <?php
                                if ($row['normal_price'] != 0)
                                    echo number_format($row['normal_price'], 0, ".", ",")."đ";
                            ?>
                        </span>
                    </div>
                </div>
            </div>  
        </li>
        <?php
            }
        ?>
    </ul>
</div>

<script>
  $(document).ready(function(){
    $("#button-add").click(function(){
      $("#add_product_form").modal({
        // fadeDuration: 100
      });
    });
  });
</script>
