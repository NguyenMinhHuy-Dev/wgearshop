<form enctype="multipart/form-data" method="POST" action="modules/manageProducts/handle.php" id="add_product_form" class="modal">
    <table border="1" width="100%">
        <tr align="center">
            <th colspan="2">THÊM SẢN PHẨM</th>
        </tr>

        <tr align="center">
            <td>Tên sản phẩm</td>
            <td><input type="text" name="tensanpham" id="tensanpham" class="input"></td>
        </tr>

        <tr align="center">
            <td>Loại sản phẩm</td>
            <td>  
                <select  name="loaisanpham" id="" class="input">
                    <option value="1">Bàn phím</option>
                    <option value="2">Chuột</option>
                    <option value="3">Tai nghe</option>
                </select>  
            </td>
        </tr>

        <tr align="center">
            <td>Hãng</td>
            <td><input type="text" name="hang" id="hang" class="input"></td>
        </tr>

        <tr align="center">
            <td>Hình ảnh</td>
            <td><input type="file" name="hinhanh" id="hinhanh"></td>
        </tr>

        <tr align="center">
            <td>Giá</td>
            <td><input type="text" name="giaban" id="giaban" class="input"></td>
        </tr>
       
        <tr align="center">
            <td>Số lượng</td>
            <td><input type="text" name="soluong" id="soluong" class="input"></td>
        </tr>

        <tr align="center">
            <td>Trạng thái</td>
            <td>  
                <select  name="trangthai" id="" class="input">
                    <option value="1">Hiện</option> 
                    <option value="0">Ẩn</option>
                </select>  
            </td>
        </tr>

        <tr align="center">
            <td colspan="2"><input type="submit" name="them" class="input" value="Thêm"></td>
        </tr>
    </table>
</form>