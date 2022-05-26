<!-- Slides -->
<?php 
    include("admincp/config/config.php");
    include("pages/slider.php");
?>

<!-- Sản phẩm bán chạy -->
<div class="container__wrapper-inner"> 
    <div class="container__wrapper-inner-heading">
        <h4>SẢN PHẨM BÁN CHẠY</h4>
    </div>

    <!-- Bàn phím -->
    <div class="grid container__wrapper-products">
        <div class="container__wrapper-products-heading">
            <span class="container__wrapper-products-heading-name">BÀN PHÍM</span>
        </div> 
        
        <ul class="container__wrapper-products-list Keyboards">
            <?php
                $sql_kbs = "SELECT * FROM tb_product WHERE id_category=1 ORDER BY sold DESC LIMIT 9";
                $query_kbs = mysqli_query($mysqli, $sql_kbs);
                $count = 0;

                while ($row = mysqli_fetch_array($query_kbs)) {
                    $count++;
                    if ($row["status"] == 1) {
            ?>
            <li class="container__wrapper-product"> 
                <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>">
                    <div class="container__wrapper-product-img">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see">
                            <button class="btn btn--sec container__wrapper-product-see">XEM CHI TIẾT</button>
                        </div>
                        <img src="admincp/modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm">
                    </div>
                </a>
                <div class="container__wrapper-product-info">
                    <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>"></a>
                    <div class="container__wrapper-product-info-layout">
                        <!-- <a href=""></a> -->
                        <div class="container__wrapper-product-name">
                            <!-- <a href="">
                                <span></span>
                            </a> -->
                            <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>" class="header__cart-list-item-name"><?php echo $row["name"]; ?></a>
                        </div>
                        <div class="container__wrapper-product-prices">
                            <span class="container__wrapper-product-price-normal product-price-sale"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></span>
                            <span class="container__wrapper-product-price-normal">
                                <?php
                                    if ($row["normal_price"] != $row['sale_price']) {
                                        echo number_format($row['normal_price'], 0, ".", ",")."đ";;
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>  
            </li>
            <?php
                    }
                }
            ?>
            <li class="container__wrapper-product" style=""> 
                <a href="index.php?danhmuc=banphim">
                    <div class="container__wrapper-product-img" style="height:100%">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see" style="opacity:1">
                            <button class="btn btn--sec container__wrapper-product-see" id="button-add" style="width:150px; height:150px; border:1px solid var(--input)">XEM THÊM</button>
                        </div>
                    </div>
                </a> 
            </li>
        </ul>
        <?php
            // if ($count > 5) {
        ?>
        <!-- <div class="container__wrapper-product-footing">
            <button class="btn btn--pri container__wrapper-product-footing-button-see-more key">
                XEM THÊM
            </button>
            <script> 
                document.querySelector('.container__wrapper-product-footing-button-see-more.key').addEventListener('click', function() {
                    this.classList.toggle('active');
                    document.querySelector('.container__wrapper-products-list.Keyboards').classList.toggle('active');
                });
            </script>
        </div> -->
        <?php
            // }
        ?>
    </div>

    <!-- Chuột -->
    <div class="grid container__wrapper-products">
        <div class="container__wrapper-products-heading">
            <span class="container__wrapper-products-heading-name">CHUỘT</span>
        </div> 

        <ul class="container__wrapper-products-list Mouses"> 
            <?php
                $sql_mse = "SELECT * FROM tb_product WHERE id_category=2 ORDER BY sold DESC LIMIT 9";
                $query_mse = mysqli_query($mysqli, $sql_mse);
                $count = 0;

                while ($row = mysqli_fetch_array($query_mse)) {
                    $count++;
                    if ($row["status"] == 1) {
            ?>
            <li class="container__wrapper-product"> 
                <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>">
                    <div class="container__wrapper-product-img">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see">
                            <button class="btn btn--sec container__wrapper-product-see">XEM CHI TIẾT</button>
                        </div>
                        <img src="admincp/modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm">
                    </div>
                </a>
                <div class="container__wrapper-product-info">
                    <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>"></a>
                    <div class="container__wrapper-product-info-layout">
                        <!-- <a href=""></a> -->
                        <div class="container__wrapper-product-name">
                            <!-- <a href="">
                                <span></span>
                            </a> -->
                            <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>" class="header__cart-list-item-name"><?php echo $row["name"]; ?></a>
                        </div>
                        <div class="container__wrapper-product-prices">
                            <span class="container__wrapper-product-price-normal product-price-sale"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></span>
                            <span class="container__wrapper-product-price-normal">
                                <?php
                                    if ($row["normal_price"] != $row['sale_price']) {
                                        echo number_format($row['normal_price'], 0, ".", ",")."đ";;
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>  
            </li>
            <?php
                    }
                }
            ?>
            <li class="container__wrapper-product" style=""> 
                <a href="index.php?danhmuc=chuot">
                    <div class="container__wrapper-product-img" style="height:100%">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see" style="opacity:1">
                            <button class="btn btn--sec container__wrapper-product-see" id="button-add" style="width:150px; height:150px; border:1px solid var(--input)">XEM THÊM</button>
                        </div>
                    </div>
                </a> 
            </li>
        </ul>
        <?php
            // if ($count > 5) {
        ?>
        <!-- <div class="container__wrapper-product-footing">
            <button class="btn btn--pri container__wrapper-product-footing-button-see-more mse">
                XEM THÊM
            </button>
            <script> 
                document.querySelector('.container__wrapper-product-footing-button-see-more.key').addEventListener('click', function() {
                    this.classList.toggle('active');
                    document.querySelector('.container__wrapper-products-list.Keyboards').classList.toggle('active');
                });
            </script>
        </div>  -->
        <?php
            // }
        ?>
    </div>

    <!-- Tai nghe -->
    <div class="grid container__wrapper-products">
        <div class="container__wrapper-products-heading">
            <span class="container__wrapper-products-heading-name">TAI NGHE</span>
        </div> 

        <ul class="container__wrapper-products-list Headphones">  
            <?php
                $sql_hds = "SELECT * FROM tb_product WHERE id_category=3 ORDER BY sold DESC LIMIT 9";
                $query_hds = mysqli_query($mysqli, $sql_hds);
                $count = 0;

                while ($row = mysqli_fetch_array($query_hds)) {
                    $count++;
                    if ($row["status"] == 1) {
            ?>
            <li class="container__wrapper-product"> 
                <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>">
                    <div class="container__wrapper-product-img">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see">
                            <button class="btn btn--sec container__wrapper-product-see">XEM CHI TIẾT</button>
                        </div>
                        <img src="admincp/modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt="Sản phẩm">
                    </div>
                </a>
                <div class="container__wrapper-product-info">
                    <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>"></a>
                    <div class="container__wrapper-product-info-layout">
                        <!-- <a href=""></a> -->
                        <div class="container__wrapper-product-name">
                            <!-- <a href="">
                                <span></span>
                            </a> -->
                            <a href="index.php?chitietsanpham=<?php echo $row['name'] ?>" class="header__cart-list-item-name"><?php echo $row["name"]; ?></a>
                        </div>
                        <div class="container__wrapper-product-prices">
                            <span class="container__wrapper-product-price-normal product-price-sale"><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></span>
                            <span class="container__wrapper-product-price-normal">
                                <?php
                                    if ($row["normal_price"] != $row['sale_price']) {
                                        echo number_format($row['normal_price'], 0, ".", ",")."đ";;
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>  
            </li>
            <?php
                    }
                }
            ?>
            <li class="container__wrapper-product" style=""> 
                <a href="index.php?danhmuc=tainghe">
                    <div class="container__wrapper-product-img" style="height:100%">
                        <div class="container__wrapper-product-overlay"></div>
                        <div class="container__wrapper-product-button-see" style="opacity:1">
                            <button class="btn btn--sec container__wrapper-product-see" id="button-add" style="width:150px; height:150px; border:1px solid var(--input)">XEM THÊM</button>
                        </div>
                    </div>
                </a> 
            </li>
        </ul>
        <?php
            // if ($count > 5) {
        ?>
        <!-- <div class="container__wrapper-product-footing">
            <button class="btn btn--pri container__wrapper-product-footing-button-see-more hdp">
                XEM THÊM
            </button>
            <script> 
                document.querySelector('.container__wrapper-product-footing-button-see-more.key').addEventListener('click', function() {
                    this.classList.toggle('active');
                    document.querySelector('.container__wrapper-products-list.Keyboards').classList.toggle('active');
                });
            </script>
        </div> -->
        <?php
            // }
        ?>
    </div> 
</div>

<div class="container__wrapper-about-us">
    <div class="grid container__wrapper-about-box">
        <div class="container__wrapper-inner-heading container__wrapper-about-heading">
            <h4>GIỚI THIỆU VỀ W-GEAR</h4>
        </div>
        
        <div class="container__wrapper-about-content">
            <p>
                W-Gear ra đời dựa trên niềm yêu thích mãnh liệt về các sản phẩm, phụ kiện chơi game hay còn gọi là gaming gear của những người sáng lập cửa hàng. 
                Nhằm tạo cơ hội cho mọi người có thể sở hữu được những sản phẩm vô cùng chất lượng nhưng giá cả lại hợp với túi tiền. Cùng với các tiêu chí và nhiều chính sách ưu đãi cho khách hàng, cho khách hàng một trải nghiệm tuyệt vời đến nỗi không thể quên đi khi đến với W-GEAR.
            </p>
            <p>
                Nhân viên tại W-GEAR luôn có thái độ rất tốt và khả năng phục vụ, tư vấn và chăm sóc khách hàng cực kỳ chuyên nghiệp. Đồng thời còn hướng dẫn, hỗ trợ khách hàng đã mua hàng. Đội ngũ shipper tại W-GEAR rất đông đảo, chỉ sau khi khách hàng đặt hàng online thì "1 phút 30 giây" sau sản phẩm sẽ tới tận nhà khách hàng nhanh chóng.
            </p>
            <p>
                Về sản phẩm tại W-GEAR, luôn có những sản phẩm từ hãng cao cấp cho tới hãng bình dân, có thể kể đến sự chất lượng đến từ hãng Logitech với những mẫu tai nghe, chuột và bàn phím dành cho mọi loại nhu cầu. Song cũng có hãng quốc dân như DareU, Edra,...
            </p>
        </div>
    </div>
</div>

<!-- Bài đánh giá -->
<div class="container__wrapper-blogs">
    <div class="container__wrapper-inner-heading">
        <h4>BÀI VIẾT ĐÁNH GIÁ</h4>
    </div>

    <div class="grid container__wrapper-blog">
        <ul>
            <li>
                <div class="container__wrapper-blog-container">
                    <div class="header__user-account-img container__wrapper-blog-img">
                        <img class="header__user-account-avatar" src="admincp/modules/manageAccounts/uploads/default.jpg" alt="Ảnh đại diện">
                    </div>

                    <span class="header__user-account-name container__wrapper-blog-name">Phạm Quang Dự</span>
                    <div class="container__wrapper-blog-rate">
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                    </div>
                    <div class="container__wrapper-blog-content">
                        <p>
                            Tôi đánh giá W-Gear tận 5 sao vì nhân viên phục vụ và tư vấn rất nhiệt tình, cộng với trang trí rất bắt mắt và sạch sẽ. Cửa hàng còn có nhiều ưu đãi cho khách lần đầu ghé và cả những khách đã mua lâu năm.
                        </p>
                    </div>
                </div>
            </li> 

            <li>
                <div class="container__wrapper-blog-container">
                    <div class="header__user-account-img container__wrapper-blog-img">
                        <img class="header__user-account-avatar" src="./img/Account/blogger 2.jpg" alt="Ảnh đại diện">
                    </div>
                    
                    <span class="header__user-account-name container__wrapper-blog-name">Nguyễn Minh Huy</span>
                    <div class="container__wrapper-blog-rate">
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                    </div>
                    <div class="container__wrapper-blog-content">
                        <p>
                            W-Gear không bao giờ bắt khách hàng phải chờ lâu, mình tới chỉ cần đọc tên sản phẩm thôi là "1 phút 30 giây" có ngay. Thật tuyệt vời!!! Đánh giá liền 5 sao. 
                        </p>
                    </div>
                </div>
            </li> 

            <li>
                <div class="container__wrapper-blog-container">
                    <div class="header__user-account-img container__wrapper-blog-img">
                        <img class="header__user-account-avatar" src="./img/Account/blogger 3.jpg" alt="Ảnh đại diện">
                    </div>
                    
                    <span class="header__user-account-name container__wrapper-blog-name">Trần Công Bình</span>
                    <div class="container__wrapper-blog-rate">
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                    </div>
                    <div class="container__wrapper-blog-content">
                        <p>
                            Với bản thần tôi rất thích chơi game và W-Gear luôn là lựa chọn số 1 để mua những thứ tôi cần, đầy đủ mẫu mã và giá cả lại hợp lý. Xuất sắc!!!
                        </p>
                    </div>
                </div>
            </li> 
            
            <li>
                <div class="container__wrapper-blog-container">
                    <div class="header__user-account-img container__wrapper-blog-img">
                        <img class="header__user-account-avatar" src="./img/Account/blogger 4.jpg" alt="Ảnh đại diện">
                    </div>
                    
                    <span class="header__user-account-name container__wrapper-blog-name">Trịnh Hoàng Tùng</span>
                    <div class="container__wrapper-blog-rate">
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                        <i class="icon-rated fa-solid fa-star"></i>
                    </div>
                    <div class="container__wrapper-blog-content">
                        <p>
                            Trước giờ tui chưa bao giờ đánh giá cao một cửa hàng nào cả nhưng W-Gear lại khác, thái độ của nhân viên đối với khách hàng quả là tuyệt vời, không gì bàn cãi. Phục vụ tận tình chu đáo. Luôn có nhiều ưu đâĩ cho khách hàng.
                        </p>
                    </div>
                </div>
            </li> 
        </ul>
    </div>
</div>

<!-- Đăng ký email -->
<div class="container__wrapper-email-register">
    <div class="container__wrapper-inner-heading">
        <h4>NHẬN THÔNG BÁO VỀ SỰ KIỆN CỦA W-GEAR</h4>
    </div>

    <div class="grid container__wrapper-email-form">
        <input type="text" placeholder="Đăng ký Email để nhận thông báo">
        <button class="btn btn--pri email-submit">ĐĂNG KÝ</button>
    </div>
</div> 