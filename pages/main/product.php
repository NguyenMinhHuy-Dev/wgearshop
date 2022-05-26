<?php
    include("admincp/config/config.php");

    
    if (isset($_GET['danhmuc'])) {
        $temp = $_GET['danhmuc'];
    }
    else {
        $temp = '';
    }

    if ($temp == 'banphim') {
        $id_category = 1;
        echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Bàn phím W-Gear';</script>";
    }
    else if ($temp == 'chuot') { 
        $id_category = 2;
        echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Chuột W-Gear';</script>";
    }
    else if ($temp == 'tainghe') { 
        $id_category = 3;
        echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Tai nghe W-Gear';</script>";
    } 
    else {
        echo "<script>document.getElementsByTagName('title')[0].innerHTML = 'Tìm kiếm ".$_GET['timkiem']."';</script>";
    }
?>
<div class="grid"> 
    <div class="container__wrapper-inner-heading container__wrapper-page-header">
        <?php
            if (!isset($_GET['timkiem'])) {
        ?>
        <h4>Trang chủ > 
            <?php 
                 $sql_loai = "SELECT * FROM tb_category WHERE id=".$id_category." LIMIT 1";
                 $query_loai = mysqli_query($mysqli, $sql_loai);
                 while ($row = mysqli_fetch_array($query_loai)) {
                    echo $row["name"];
                 }
            ?>
        </h4>
        <?php
            }
            else {
                echo "<h4>Tìm kiếm sản phẩm: ".$_GET["timkiem"]."</h4>";
            }
        ?>
        
    </div>

    <div class="container__wrapper-sort-filter-price">
        <div class="container__wrapper-sort"> 
            <div class="container__wrapper-selection keyboard">
                <?php
                    if ($temp != 'sanpham') {
                ?>
                <span>Sắp xếp</span> 
                <select name="sort" id="sort" class="input" onchange="showProducts(1)"> 
                    <option value="moinhat">Mới nhất</option>
                    <option value="banchay">Bán chạy</option>
                    <option value="giamdan">Giá giảm dần</option>
                    <option value="tangdan">Giá tăng dần</option> 
                </select>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="container__wrapper-filter">
            <div class="container__wrapper-selection keyboard">
                <?php
                    if ($temp != 'sanpham') {
                ?>
                <span>Lọc hãng</span>
                <select id="filter" class="input sortnfilter" onchange="showProducts(1)">
                    <option class="" value="tatca">Tất cả</option>
                    <?php 
                        $sql_loc = "SELECT DISTINCT brand FROM tb_product WHERE id_category=".$id_category." ORDER BY brand ASC LIMIT 7";
                        $query_loc = mysqli_query($mysqli, $sql_loc); 

                        while ($row = mysqli_fetch_array($query_loc)) { 
                    ?>
                    <option class="sortnfilter" value="<?php echo$row["brand"]; ?>"><?php echo $row["brand"]; ?></option>
                    <!-- <option value="2">iKBC</option>
                    <option value="3">FL-Esports</option>
                    <option value="4">Leopold</option> -->
                    <?php 
                        }
                    ?>
                    <option class="sortnfilter" value="others">Các hãng khác</option>
                </select>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="container__wrapper-price"> 
            <?php
                if ($temp != 'sanpham') {
            ?>
            <div class="container__wrapper-filter-prices">
                <input type="number" placeholder="Tối thiểu 0đ" id="min-price" name="min-price" class="input">
                <input type="number" placeholder="Tối đa 20,000,000đ" id="max-price" name="max-price" class="input">
                <button id="button-filter" class="btn btn--pri" onclick="showProducts(1)">Tìm kiếm</button>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="container__wrapper-inner" id="list-products">   
        <div class="grid container__wrapper-products">  
            
        </div> 

        <!-- <div class="grid container__page-numbers">
            <div class="page-numbers">
                <i class="icon arrow left-arrow fa-solid fa-angle-left"></i>

                <ul>
                    <li class="active">1</li>
                    <li>2</li>
                    <li><i class="fa-solid fa-ellipsis"></i></li>
                    <li>15</li>
                </ul>

                <i class="icon arrow right-arrow fa-solid fa-angle-right"></i>
            </div>
        </div> -->
    </div> 

</div>


<script>
    function showProducts(page) {
        $('html, body').animate({ scrollTop: 200 });
        <?php 
            if ($temp != 'sanpham') {
        ?>
            var strSort = document.getElementById("sort").value;
            var strFilter = 
            <?php 
                if (isset($_GET["loc"])) {  
                    echo "'".$_GET["loc"]."';"; 
                }
                else {
                    echo "document.getElementById('filter').value;";
                } 
            ?>
            // console.log(strFilter);
            var minPrice = document.getElementById("min-price").value;
            var maxPrice = document.getElementById("max-price").value;


            if (strSort == "" || strFilter == "") {
                document.getElementById("list-products").innerHTML = "";
                return;
            } 
            if (minPrice && maxPrice) {
                path = "pages/main/showProducts.php?danhmuc=<?php echo $_GET["danhmuc"]; ?>&sapxep="+strSort+"&loc="+strFilter+"&tu="+minPrice+"&den="+maxPrice;
            }
            else {
                path = "pages/main/showProducts.php?danhmuc=<?php echo $_GET["danhmuc"]; ?>&sapxep="+strSort+"&loc="+strFilter;
            }
            path = path + "&trang=" + page;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("list-products").innerHTML = this.responseText;
                } 
            };   
            // console.log(path);
            xhttp.open("GET", path, true);
            xhttp.send();
            <?php
                }
                if (isset($_GET["timkiem"])) {
            ?>
            path = "pages/main/showProducts.php?danhmuc=sanpham&timkiem=<?php echo $_GET["timkiem"]; ?>";
            path = path + "&trang=" + page;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("list-products").innerHTML = this.responseText;
                } 
            };   
            // console.log(path);
            xhttp.open("GET", path, true);
            xhttp.send();
            <?php
                }
            ?>
    } 
    showProducts(1);

    var inputMin = document.getElementById("min-price");
    inputMin.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("button-filter").click();
        }
    });

    var inputMax = document.getElementById("max-price");
    inputMax.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("button-filter").click();
        }
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");   
           showProducts(page);   
        });  
        $('.sortnfilter').one('click', function() {
            // $('.sortnfilter').one('click', function() {
                if (<?php echo isset($_GET["loc"]) ? 1 : 0; ?> == 1) {
                    location.href = "index.php?danhmuc=<?php echo $_GET["danhmuc"]; ?>";
                }
            // });
        });
    });
</script>
