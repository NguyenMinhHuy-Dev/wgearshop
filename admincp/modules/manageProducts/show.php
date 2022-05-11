<?php
    include("./config/config.php");
    include("modules/manageProducts/add.php"); 

    $sql_lietke = "SELECT * FROM tb_product";
    $query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="grid container__wrapper-products">
    <!-- <ul class="container__wrapper-products-list active"> -->  
        <div class="detail-form__product-configuration-heading" style="margin-bottom:0">
            <h4 style="color:#d277f7">DANH SÁCH SẢN PHẨM</h4>
        </div>
        <div class="list-product"> 
            <table width="100%" class="show-table input-form" style="min-width: 800px">
                <tr style="height: 50px">
                    <th>STT</th>
                    <th width="400px">TÊN SẢN PHẨM</th>
                    <th>LOẠI SẢN PHẨM</th>
                    <th>HÌNH ẢNH</th>
                    <th>SỐ LƯỢNG</th>
                    <th>GIÁ</th>
                    <th>TRẠNG THÁI</th>
                    <th>TÙY CHỈNH</th>
                </tr>
                <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($query_lietke)) {
                        $i++;
                ?>
                <tr align="center">
                    <td style="font-weight:bold"><?php echo $i; ?></td>
                    <td style="font-weight:bold" align="left"><?php echo $row["name"]; ?></td>
                    <td >
                        <?php 
                            $sql_loai = "SELECT * FROM tb_category";
                            $query_loai = mysqli_query($mysqli, $sql_loai);
                            while ($row2 = mysqli_fetch_array($query_loai)) {
                                if ($row2["id"] == $row["id_category"]) {
                                    echo $row2["name"];
                                    break;
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm" style="display:block; width: 50px">
                    </td>
                    <td ><?php echo $row["quantity"]; ?></td>
                    <td align="right"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></td> 
                    <td>
                        <?php
                            if ($row["status"] == 1) {
                                echo "<span style='font-size: 19px; color: #2ecc71'>Hiện</span>";
                            }
                            else {
                                echo "<span style='font-size: 19px; color: #e74c3c'>Ẩn</span>";
                            }
                        ?>
                    </td>
                    <td>
                        <a href="modules/manageProducts/handle.php?idsanpham=<?php echo $row["id"] ?>" class="btn btn--sec" style="display: inline-block; width: 70px">XÓA</a>
                        <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row["id"] ?>" class="btn btn--pri" style="display: inline-block; width: 100px">CẬP NHẬT</a>
                    </td>
                </tr> 
                <?php
                    }
                ?>
            </table>
        </div>
        <div class="add-product">
            <button class="btn btn--sec container__wrapper-product-see" id="button-add">THÊM SẢN PHẨM</button>
        </div>    
    <!-- </ul> -->
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
