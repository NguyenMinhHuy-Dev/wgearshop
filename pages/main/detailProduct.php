<?php
    include("admincp/config/config.php");

    if (isset($_GET["chitietsanpham"])) {
        $sql = "SELECT * FROM tb_product WHERE name='{$_GET['chitietsanpham']}'";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
    
?>

<div class="grid detail-form__product Keyboards" id="detail-form"> 
    <!-- <form action=""> -->
        <div class="detail-form__product-heading">
            <!--Product image -->
            <div class="detail-form__product-img">
                <img src="admincp/modules/manageProducts/uploads/<?php echo $row['image']; ?>" alt="Sản phẩm">
            </div>

            <div class="detail-form__product-present">
                <div class="detail-form__product-name">
                    <span><?php echo $row['name']; ?></span>
                </div>
                
                <div class="detail-form__product-prices">
                    <span>Giá:</span>
                    <span class="detail-form__product-price-normal product-price-sale"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></span>
                    <span class="detail-form__product-price-normal">
                        <?php 
                            if ($row["normal_price"] != $row['sale_price']) {
                                echo number_format($row['normal_price'], 0, ".", ",")."đ";
                            }
                        ?>
                    </span>
                </div>

                <div class="detail-form__product-rate">
                    <span>Đánh giá:</span>
                    <div class="detail-form__product-raing">
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>

                <div class="detail-form__product-promotion">
                    <span>Ưu đãi</span>
                    <ul>
                        <li>Giảm giá sốc khi mua cùng các sản phẩm khác</li>
                        <li><b>Freeship</b> toàn quốc khiđặt hàng tại W-Gear</li>
                        <li>Miễn phí vệ sinh laptop, bàn phím</li>
                        <li>Bảo hành 24 tháng</li>
                    </ul>
                </div>
                
                <?php
                    if ($row["quantity"] != 0) {
                ?>
                <div class="detail-form__product-status stocking">
                    <span>Tình trạng:</span>
                    <span>Còn hàng</span>
                </div>
                <?php
                    }
                    else {
                ?>
                <div class="detail-form__product-status">
                    <span>Tình trạng:</span>
                    <span>Hết hàng</span>
                </div>
                <?php
                    }
                ?> 

                <div class="detail-form__product-quantity">
                    <span>Số lượng:</span>
                    <input type="number" min="0" max="<?php echo $row["quantity"]; ?>" name="" class="input" id="quantity-product" placeholder="<?php echo $row["quantity"]; ?>" value="">
                </div>
                
                <div class="detail-form__product-button">
                    <button type="button" <?php if ($row["quantity"] == 0) echo "disabled"; ?> onclick="addToCart()" class="btn btn--sec detail-form__product-button-favourite">THÊM VÀO GIỎ</button>
                    <button  onclick='buynow()' <?php if ($row["quantity"] == 0) echo "disabled"; ?> class="btn btn--pri detail-form__product-button-add-cart">MUA NGAY</button>
                </div>
                
                <script>
                    function addToCart() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                // document.getElementById("amount-number").innerHTML = this.responseText;
                                document.getElementById("header__user-cart").innerHTML = this.responseText;
                            }  
                        };    
                        const soluong = document.getElementById('quantity-product').value; 
                        if (soluong > 0 && soluong <= <?php echo $row["quantity"]; ?>) {
                            // var nhan = parseInt(document.getElementById('amount-number').innerHTML); 
                            // document.getElementById('amount-number').innerHTML = nhan + parseInt(soluong);
                            var path = `pages/main/addToMiniCart.php?id=<?php echo $row['id'] ?>&soluong=${soluong}`;  
                            xhttp.open("GET", path, true);
                            xhttp.send(); 
                        }
                    } 
                    function buynow() {
                        const soluong = document.getElementById('quantity-product').value; 
                        if (soluong > 0 && soluong <= <?php echo $row["quantity"]; ?>) {
                            addToCart();
                            location.href = `index.php?thanhtoan`;
                        }
                    }
                </script>
            </div>
        </div>
        <div class="detail-form__product-body">
                    <!-- Thông tin cấu hình -->
                    <div class="detail-form__product-configuration">
                        <div class="detail-form__product-configuration-heading">
                            <h4>THÔNG SỐ KỸ THUẬT</h4>
                        </div>
                        <div class="detail-form__product-configuration-table">
                            <!-- <table>
                                <tr>
                                    <td>Thương hiệu</td>
                                    <td>iKBC</td>
                                </tr>
                                <tr>
                                    <td>Series / Model</td>
                                    <td>CD108</td>
                                </tr>
                                <tr>
                                    <td>Bảo hành</td>
                                    <td>24 tháng</td>
                                </tr>
                                <tr>
                                    <td>Kết nối</td>
                                    <td>Có dây (1,8 m)</td>
                                </tr>
                                <tr>
                                    <td>Màu sắc</td>
                                    <td>Đen</td>
                                </tr>
                                <tr>
                                    <td>Cân nặng</td>
                                    <td>1,8 kg</td>
                                </tr> 
                                <tr>
                                    <td>Kích thước</td>
                                    <td>470 x 200 x 50 mm </td>
                                </tr>
                                <tr>
                                    <td>Layout</td>
                                    <td>Fullsize 108 phím</td>
                                </tr>
                                <tr>
                                    <td>Keycaps</td>
                                    <td>PBT Doulbeshot Cherry profile</td>
                                </tr>
                                <tr>
                                    <td>Switch</td>
                                    <td>Cherry MX Blue/Brown/Red</td>
                                </tr>
                                <tr>
                                    <td>Đèn LED</td>
                                    <td>None</td>
                                </tr>
                                <tr>
                                    <td>Tặng kèm</td>
                                    <td>1x Keyboard cover, 1x Key puller, 1x Bộ Keycaps Ruby</td>
                                </tr>
                                
                            </table> -->
                            <?php 
                                echo $row['config'];
                            ?>
                        </div>
                    </div>
                    <!-- Thông tin cấu hình -->
                    <div class="detail-form__product-blog">
                        <div class="detail-form__product-configuration-heading detail-form__product-blog-heading">
                            <h4>ĐÁNH GIÁ CHI TIẾT</h4>
                        </div>
                        <div class="detail-form__product-blog-body">
                            <?php 
                                echo $row['content'];
                            ?>
                            <!-- <h3>Khi mà sự tối giản và chất lượng lên tiếng</h3>
                            <p>
                                Phải công tâm khi nhận định rằng mẫu bàn phím của <b>iKBC CD108 PD</b> chính là một mẫu bàn phím mà sự tối giản và chất lượng là điểm thu hút người sử dụng. Chúng ta có một chiếc bàn phím được tạo nên từ keycaps PBT Doubleshot dày dặn, đảm bảo quá trình sử dụng lâu dài bền bỉ và không phai màu. Switch chất lượng cực tốt từ Cherry Swich nổi tiếng. Bạn sẽ thấy hứng thú khi gõ văn bản hay làm việc trên chiếc bàn phím này, một cảm giác sung sướng khi việc gõ của bạn giờ đây thật thoải mái.  
                            </p>
                            <div class="detail-form__product-blog-img">
                                <img src="./img/Produces/Keyboards/iKBC/iKBC CD108 PD Review 1.png" alt="">
                            </div>

                            <h3>Dành cho những ai yêu thích sự tối giản và cần một chiếc bàn phím gõ thoải mái và bền bỉ</h3>
                            <p>
                                Vẻ ngoài tối giản với tông màu đen cơ bản, nhấn nhá một chút màu sắc với keycaps tặng kèm. Bạn có một chiếc bàn phím phù hợp nhất dành cho những anh chị em làm lập trình, những bạn phải soạn thảo văn bản, người dùng văn phòng và những anh chị em cần dùng bàn phím trong một khoảng thời gian dài mà phải đảm bảo sự chính xác và thoải mái khi sử dụng.
                            </p>
                            
                            <h3>Chất lượng từ keycaps PBT Doubleshot</h3>
                            <p>
                                Mẫu bàn phím được trang bị keycaps chất lượng cao và hoàn thiện cực kì dày dặn, rất tốt chính làm keycaps PBT Doubleshot được in 2 lần, đảm bảo khả năng chống bám vân tay và không phai màu qua quá trình lâu dài sử dụng mà vẫn như mới.
                            </p>
                            <div class="detail-form__product-blog-img">
                                <img src="./img/Produces/Keyboards/iKBC/iKBC CD108 PD Keycap.png" alt="">
                            </div>

                            <h3>Switch danh tiếng Cherry MX Switch tuỳ chọn 3 màu</h3>
                            <p>
                                Switch được trang bị trên bàn phím của hãng Cherry Corp – một tập đoàn của Đức sản xuất. Tạo nên một tiêu chuẩn vàng cho switch với danh tiếng và chất lượng đã được kiểm định một cách nghiêm ngặt. Chất lượng Đức dành cho bạn.
                            </p>
                            <div class="detail-form__product-blog-img">
                                <img src="./img/Produces/Keyboards/iKBC/iKBC CD108 PD Switches.png" alt="">
                            </div>

                            <h3>Layout chuẩn ANSI quốc tế</h3>
                            <p>
                                Với layout tiêu chuẩn quốc tế, bạn hoàn toàn yên tâm khi gõ trên bàn phím này. Cảm giác mang lại cực kỳ hứng thú và thoải mái.Tôi đảm bảo bạn sẽ yêu chiếc bàn phím này ngay khi chạm vào nó và bắt đầu sử dụng.
                            </p>
                            <div class="detail-form__product-blog-img">
                                <img src="./img/Produces/Keyboards/iKBC/iKBC CD108 PD Review 1.png" alt="">
                            </div>

                            <h3>Tóm lại</h3>
                            <p>
                                Nhắm đến đối tượng người dùng là những ai thích sự tối giản, đi kèm một chất lượng hoàn thiện cực kỳ tốt nhờ phần cứng cao cấp. Chiêc bàn phím này chắc chắn sẽ là một trợ thủ không thể thiếu của người sử dụng. Phù hợp với : lập trình viên cần code nhiều trong khoảng thời gian dài, người dùng văn phòng cần soạn thảo văn bản một cách êm ái thoải mái, người sáng tạo nội dung , viết content sản phẩm. Và chắc chắn không thể thiếu game thủ khi mà chất lượng và độ nhạy của chiếc bàn phím này là quá tốt.
                            </p> -->
                        </div>
                    </div>
                </div>
    <!-- </form> -->
   
    
    <div class="detail-form__product-footing">
        <div class="product-services-form">
            <div class="detail-form__product-configuration-heading product-services-form-heading">
                <h4>DỊCH VỤ KHÁCH HÀNG</h4>
            </div>
            <div class="product-services-box">
                <ul class="product-services">
                    <li class="product-service">
                        <div class="product-service-items">
                            <i class="fa fa-headset"></i>
                            <span>TƯ VẤN SẢN PHẨM</span>
                        </div>
                    </li>
                    <li class="product-service">
                        <div class="product-service-items">
                            <i class="fa fa-money"></i>
                            <span>DỊCH VỤ TRẢ GÓP</span>
                        </div>
                    </li>
                    <li class="product-service">
                        <div class="product-service-items">
                            <i class="fa fa-gear"></i>
                            <span>DỊCH VỤ BẢO HÀNH</span>
                        </div>
                    </li>
                    <li class="product-service">
                        <div class="product-service-items">
                            <i class="fa fa-arrow-right-arrow-left"></i>
                            <span>DỊCH VỤ ĐỔI TRẢ</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> 

<?php
    }
?>