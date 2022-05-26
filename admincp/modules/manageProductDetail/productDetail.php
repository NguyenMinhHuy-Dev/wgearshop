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
?>

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">

<script>
    document.querySelector('#detail').classList.add('active'); 
    document.querySelector('.name-page').innerHTML = "Product detail"; 
</script>

<div class="product-page home-content" id="home-content">
    <!-- <div class="add-product">
        <span onclick="addProduct()"><i class="fa-solid fa-plus"></i> New product</span>
    </div> -->
    <div class="products-table-cover" id="products-table-cover">

    </div>
</div>

<script> 
    function editProductDetail(id, page) { 
        location.href = `index.php?editDetail&idsanpham=${id}`; 
    } 
    function showProducts(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("products-table-cover").innerHTML = this.responseText;
            } 
        };    
        // console.log(path);
        var path = `modules/manageProductDetail/show.php?page=${page}`;
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    <?php 
        // if (isset($_SESSION['page-pre'])) {
    ?>
        // showProducts(<?php //echo $_SESSION['page-pre']; ?>);
    <?php
        // }
        // else {
    ?>
        showProducts(1);
    <?php
        // }
    ?>
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");   
           showProducts(page);   
        });   
    });
</script>