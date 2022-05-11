<?php 
    include("./config/config.php");

    $id = $_GET['idsanpham'];
    $sql_sanpham = "SELECT * FROM tb_product WHERE id = ".$id;
    $query_sanpham = mysqli_query($mysqli, $sql_sanpham);
?>

<div class="detail-form__product-body"> 
    <div class="detail-form__product-configuration"> 
        <div class="detail-form__product-configuration-table">
        <form enctype="multipart/form-data" method="POST" action="modules/manageProducts/handle.php" id="edit_product_form">
            <table width="100%">
                <tr align="center">
                    <th colspan="2">
                        <div class="detail-form__product-configuration-heading">
                            <h4>SỬA SẢN PHẨM</h4>
                        </div>
                    </th>
                </tr>
                <?php 
                    while ($row = mysqli_fetch_array($query_sanpham)) {
                ?>
                <tr>
                    <td align="center">Tên sản phẩm</td>
                    <td align="center">
                        <input type="text" name="tensanpham" id="tensanpham" class="input" value="<?php echo $row["name"]; ?>">
                    </td>
                </tr>

                <tr>
                    <td align="center">Loại sản phẩm</td>
                    <td align="center">  
                        <select  name="loaisanpham" id="" class="input">
                            <?php
                                $sql_loai = "SELECT * FROM tb_category";
                                $query_loai = mysqli_query($mysqli, $sql_loai);
                                while ($row2 = mysqli_fetch_array($query_loai)) {
                                    if ($row2["id"] == $row["id_category"]) {
                                        echo "<option selected='selected' value='".$row2["id"]."'>".$row2["name"]."</option>"; 
                                    }
                                    else {
                                        echo "<option value='".$row2["id"]."'>".$row2["name"]."</option>";
                                    }
                                }
                            ?>
                        </select>  
                    </td>
                </tr>

                <tr>
                    <td align="center">Hãng</td>
                    <td align="center"><input type="text" name="hang" id="hang" class="input" value="<?php echo $row["brand"]; ?>"></td>
                </tr>

                <tr>
                    <td align="center">Hình ảnh</td>
                    <td align="center">
                        <img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm" style="display:block; width: 150px">
                        <input type="file" name="hinhanh" id="hinhanh">
                    </td>
                </tr>

                <tr>
                    <td align="center">Giá</td>
                    <td align="center"><input type="number" name="giaban" id="giaban" class="input" value="<?php echo $row["sale_price"]; ?>"></td>
                </tr>
            
                <tr>
                    <td align="center">Số lượng</td>
                    <td align="center"><input type="number" name="soluong" id="soluong" class="input" value="<?php echo $row["quantity"]; ?>"></td>
                </tr>

                <tr>
                    <td align="center">Trạng thái</td>
                    <td align="center">  
                        <?php
                            if ($row["status"] == 1) {
                        ?>
                        <select  name="trangthai" id="" class="input">
                            <option value="1">Hiện</option> 
                            <option value="0">Ẩn</option>
                        </select>  
                        <?php
                            }
                            else {
                        ?>
                        <select  name="trangthai" id="" class="input">
                            <option value="0">Ẩn</option>
                            <option value="1">Hiện</option> 
                        </select>  
                        <?php
                            } 
                        ?>
                    </td>
                </tr>

                <tr align="center">
                    <td colspan="2"><input type="submit" name="them" class="input btn btn--sec" value="Sửa"></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </form>
        </div>
    </div> 
</div>
