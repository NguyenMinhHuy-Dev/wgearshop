<?php 
    // unset($_SESSION['USERNAME']); 

    if (!isset($_SESSION['USERNAME_ADMIN'])) {
?>
    <script>
        location.href = "login.php";
    </script>
<?php
    //     header('Location: ../admincp/login.php');
    }  
    if (isset($_GET["idsanpham"])) {
        $sql = "SELECT * FROM tb_product WHERE id={$_GET['idsanpham']}";
        $query = mysqli_query($mysqli, $sql);
        $row_detail = mysqli_fetch_array($query);
    }

    if (isset($_POST['suachitiet'])) {
        $noidung = $_POST['noidung'];
        $cauhinh = $_POST['cauhinh'];
        $sql_update = "UPDATE tb_product SET content = '{$noidung}', config= '{$cauhinh}' WHERE id={$_GET["idsanpham"]}";
        mysqli_query($mysqli, $sql_update); 
?>
        <script>
            location.href = `index.php?detailproduct`;
        </script>
<?php
    }
?>

<script src="//cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>

<script>
    document.querySelector('#detail').classList.add('active'); 
    document.querySelector('.name-page').innerHTML = "Product detail"; 
</script>

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="./css/detailadmincp.css?v=<?php echo time(); ?>">


<div class="product-page home-content" id="home-content">
    <div class="return">
        <span onclick="comebackProductDetail()"><i class="fa-solid fa-arrow-left-long"></i> Return</span>
    </div>
    <form action="" method="POST">
        <div class="detail-form__product-present">
            <div class="detail-form__product-img">
                <img src="../admincp/modules/manageProducts/uploads/<?php echo $row_detail['image']; ?>" alt="Sản phẩm">
            </div>
            <div class="detail-form__product-name">
                <span><?php echo $row_detail['name']; ?></span>
            </div>
        </div>
        <div class="products-table-cover" id="products-table-cover"> 
            <textarea name="cauhinh"><?php echo $row_detail['config']; ?></textarea>
            <script>
                    CKEDITOR.replace( 'cauhinh' );
            </script>
        </div>
        <div class="products-table-cover" id="products-table-cover"> 
            <textarea name="noidung"><?php echo $row_detail['content']; ?></textarea>
            <script>
                    CKEDITOR.replace( 'noidung' );
            </script>
        </div>
        <div class="button-submit">
            <button type="submit" class="input btn" name="suachitiet">UPDATE DETAIL</button>
        </div>
    </form>
</div>

<script> 
    function comebackProductDetail() {
        location.href = `index.php?detailproduct`;
    }
</script>