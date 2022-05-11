<script>
    $(document).ready(function(){
        $("#add_product_form").validate({
            rules: {
                tensanpham: {required: true}
                // txtColumns: {required: true, digits: true}
            },
            messages: {
                tensanpham: {required: "Phải nhập"}
                // txtColumns: {required: "Phải nhập", digits: "Nhập số nguyên"}
            }
        });
    });
</script>

<form enctype="multipart/form-data" method="POST" action="modules/manageProducts/handle.php" id="add_product_form" class="modal input_form">
    <div class="detail-form__product-body"> 
        <div class="detail-form__product-configuration"> 
            <div class="detail-form__product-configuration-table">
                <table width="100%">
                    <tr align="center">
                        <th colspan="2">
                            <div class="detail-form__product-configuration-heading" style="margin-top:0">
                                <h4 style="color:#d277f7">THÊM SẢN PHẨM</h4>
                            </div>
                        </th>
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
                        <td><input type="number" name="giaban" id="giaban" class="input"></td>
                    </tr>
                
                    <tr align="center">
                        <td>Số lượng</td>
                        <td><input type="number" name="soluong" id="soluong" class="input"></td>
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
                        <td colspan="2"><input type="submit" name="themsanpham" class="input btn btn--pri" value="Thêm"></td>
                    </tr>
                </table>
            </div>
        </div> 
    </div>
</form>