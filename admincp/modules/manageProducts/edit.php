<?php
    include("../.././config/config.php");
 
    $sql_sanpham = "SELECT * FROM tb_product WHERE id = ".$_GET['id'];
    $query_sanpham = mysqli_query($mysqli, $sql_sanpham);

    session_start();
    $_SESSION['page-pre'] = $_GET['page']; 
?>

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">

<div class="return">
    <span onclick="comebackProduct()"><i class="fa-solid fa-arrow-left-long"></i> Return</span>
</div>
<div class="add-product-form">
    <form action="modules/manageProducts/handle.php?idsanpham=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" method='POST'>
        <table class="products-table">
            <thead>
                <tr style="height: 50px"> 
                    <th rowspan='1' colspan='2' style='width:300px; min-width: 200px'>EDIT PRODUCT</th> 
                </tr>
            </thead>
            <tbody id="table-body"> 
                <?php 
                    while ($row = mysqli_fetch_array($query_sanpham)) {
                ?>
                <tr>
                    <td style='width:200px'>Name</td>
                    <td style='width:200px'><input type="text" name="tensanpham" id="tensanpham" class="input" value="<?php echo $row["name"]; ?>"></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Category</td>
                    <td style='width:200px'>
                        <select  name="loaisanpham" id="" class="input" required>
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
                    <td style='width:200px'>Brand</td>
                    <td style='width:200px'><input type="text" name="hang" id="hang" class="input" value="<?php echo $row["brand"]; ?>"></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Image</td>
                    <td style='width:200px'>
                        <img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm" style="display:block; height: 70px; margin-bottom:10px">
                        <input type="file" name="hinhanh" id="hinhanh">
                    </td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Normal price</td>
                    <td style='width:200px'>
                        <input type="number" name="giaban" id="giaban" class="input" value="<?php echo $row["normal_price"]; ?>">
                    </td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Sale price</td>
                    <td style='width:200px'>
                        <input type="number" name="giakhuyenmai" id="giakhuyenmai" class="input" value="<?php echo $row["sale_price"]; ?>">
                    </td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Amount</td>
                    <td style='width:200px'><input type="number" name="soluong" id="soluong" class="input" value="<?php echo $row["quantity"]; ?>"></td> 
                </tr> 
                <tr>
                    <td style='width:200px'>Sold</td>
                    <td style='width:200px'><input type="number" name="daban" id="daban" class="input" value="<?php echo $row["sold"]; ?>"></td> 
                </tr>   
                <tr>
                    <td style='width:200px'>Create at</td>
                    <td style='width:200px'><input type="date" name="ngaytao" id="ngaytao" class="input" value="<?php echo $row["date"]; ?>"></td> 
                </tr> 
                <tr>
                    <td style='width:200px'>Last update</td>
                    <td style='width:200px'><input type="date" name="ngaycapnhat" id="ngaycapnhat" class="input" value="<?php echo $row["update_date"]; ?>"></td> 
                </tr>    
                <tr>
                    <td style='width:200px'>Status</td>
                    <td style='width:200px'>
                        <?php
                            if ($row["status"] == 1) {
                        ?>
                        <select  name="trangthai" id="" class="input">
                            <option value="0">Ẩn</option>
                            <option value="1" selected='selected'>Hiện</option> 
                        </select>  
                        <?php
                            }
                            else {
                        ?>
                        <select  name="trangthai" id="" class="input">
                            <option value="0" selected='selected'>Ẩn</option>
                            <option value="1">Hiện</option> 
                        </select>  
                        <?php
                            } 
                        ?>
                    </td> 
                </tr>    
                <tr>
                    <td colspan='2' style='width:200px'><input type="submit" name="suasanpham" class="input btn btn--pri" value="UPDATE PRODUCT"></td>
                </tr> 
                <?php
                    }
                ?>
            </tbody>
        </table>
    </form>
</div>
