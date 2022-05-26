<?php
    include("../.././config/config.php"); 
?>

<div class="return">
    <span onclick="comebackProduct()"><i class="fa-solid fa-arrow-left-long"></i> Return</span>
</div>

<div class="add-product-form">
    <form action="modules/manageProducts/handle.php" enctype="multipart/form-data" method='POST'>
        <!-- <table>
            <thead>
                <th>NEW PRODUCT</th>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="tensanpham" id="tensanpham" class="input"></td>
                </tr>
                
                <tr>
                    <td>Loại sản phẩm</td>
                    <td>  
                        <select  name="loaisanpham" id="" class="input">
                            <option value="1">Bàn phím</option>
                            <option value="2">Chuột</option>
                            <option value="3">Tai nghe</option>
                        </select>  
                    </td>
                </tr>

                <tr>
                    <td>Hãng</td>
                    <td><input type="text" name="hang" id="hang" class="input"></td>
                </tr>

                <tr>
                    <td>Hình ảnh</td>
                    <td><input type="file" name="hinhanh" id="hinhanh"></td>
                </tr>

                <tr>
                    <td>Giá</td>
                    <td><input type="number" name="giaban" id="giaban" class="input"></td>
                </tr>
            
                <tr>
                    <td>Số lượng</td>
                    <td><input type="number" name="soluong" id="soluong" class="input"></td>
                </tr>

                <tr>
                    <td>Trạng thái</td>
                    <td>  
                        <select  name="trangthai" id="" class="input">
                            <option value="1">Hiện</option> 
                            <option value="0">Ẩn</option>
                        </select>  
                    </td>
                </tr>
            </tbody>
        </table> -->
        <table class="products-table">
            <thead>
                <tr style="height: 50px"> 
                    <th rowspan='1' colspan='2' style='width:300px; min-width: 200px'>NEW PRODUCT</th> 
                </tr>
            </thead>
            <tbody id="table-body"> 
                <tr>
                    <td style='width:200px'>Name</td>
                    <td style='width:200px'><input type="text" name="tensanpham" id="tensanpham" class="input" required></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Category</td>
                    <td style='width:200px'>
                        <select  name="loaisanpham" id="" class="input" required>
                            <option value="1">Bàn phím</option>
                            <option value="2">Chuột</option>
                            <option value="3">Tai nghe</option>
                        </select>  
                    </td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Brand</td>
                    <td style='width:200px'><input type="text" name="hang" id="hang" class="input" required></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Image</td>
                    <td style='width:200px'><input type="file" name="hinhanh" id="hinhanh" required></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Price</td>
                    <td style='width:200px'><input type="number" name="giaban" id="giaban" class="input" required></td> 
                </tr>  
                <tr>
                    <td style='width:200px'>Amount</td>
                    <td style='width:200px'><input type="number" name="soluong" id="soluong" class="input" required></td> 
                </tr>    
                <tr>
                    <td colspan='2' style='width:200px'><input type="submit" name="themsanpham" class="input btn btn--pri" value="ADD PRODUCT"></td>
                </tr> 
            </tbody>
        </table>
    </form>
</div>