<?php
    // echo "DANH SÁCH KHUYẾN MÃI";
?>

<script>
    document.querySelector('#promotion').classList.add('active');
    document.querySelector('.name-page').innerHTML = "Promotion";
</script>

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">

<div class="product-page home-content" id="home-content">
    <div class="add-product">
        <span onclick="addPromotion()"><i class="fa-solid fa-plus"></i> New promotion</span>
    </div>
    <div class="products-table-cover" id="products-table-cover">

    </div>
</div>

<script> 
    function remove(id) {
        location.href = `modules/managePromotion/handle.php?idkhuyenmai=${id}`;
    }
    function addPromotion() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("home-content").innerHTML = this.responseText;
            } 
        };    
        // console.log(path);
        var path = `modules/managePromotion/add.php`;
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    function comeback() {
        location.href = `index.php?promotion`;
    }
    function showPromotion(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("products-table-cover").innerHTML = this.responseText;
            } 
        };    
        // console.log(path);
        var path = `modules/managePromotion/show.php?page=${page}`;
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    <?php 
        // if (isset($_SESSION['page-pre'])) {
    ?>
        // showPromotion(<?php //echo $_SESSION['page-pre']; ?>);
    <?php
        // }
        // else {
    ?>
        showPromotion(1);
    <?php
        // }
    ?>
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");   
           showPromotion(page);   
        });   
    });
</script>