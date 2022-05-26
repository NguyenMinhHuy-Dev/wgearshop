<?php
    // session_start();

    if (!isset($_SESSION['USERNAME_ADMIN'])) {
        header('Location: ../admincp/login.php');
    } 
?>

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">

<script>
    document.querySelector('#customers').classList.add('active');
    document.querySelector('.name-page').innerHTML = "Customers";
</script>

<div class="account-page home-content" id="home-content">
    <div class="add-product">
        <!-- <span onclick="addProduct()"><i class="fa-solid fa-plus"></i> New product</span> -->
    </div>
    <div class="products-table-cover" id="customers-table-cover">

    </div>
</div>

<script>   
    function removeAccount(username) {
        location.href = `modules/manageAccounts/handle.php?username=${username}`;
    }
    function showCustomers(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("customers-table-cover").innerHTML = this.responseText;
            } 
        };    
        // console.log(path);
        var path = `modules/manageAccounts/show.php?page=${page}`;
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    showCustomers(1);
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '.pagination_link', function(){  
           var page = $(this).attr("id");   
           showCustomers(page);   
        });   
    });
</script>
