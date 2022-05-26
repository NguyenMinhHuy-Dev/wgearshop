<?php
    include("./config/config.php");
    $sql = "SELECT * FROM tb_account WHERE username='{$_SESSION['USERNAME_ADMIN']}'"; 
    $query = mysqli_query($mysqli, $sql); 
    $row = mysqli_fetch_array($query);
?>

<nav>
    <div class="sidebar-button">
        <i class="fa-solid fa-bars sidebarBtn"></i>
        <span class="name-page">Dashboard</span>
    </div>
    <div class="search-box">
        <input onkeyup="suggest()" type="text" name="search" class="input" id="search-input" placeholder="Tìm kiếm thông tin">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <div class="profile-details">  
        <div class="name">
            <span class="admin_name">Hello <b><?php echo $row['name']; ?></b></span>
            <span class="admin_name">admin</span>
        </div>
        <img src="../admincp/modules/manageAccounts/uploads/<?php echo $row['avatar']; ?>" alt="">
    </div>
</nav> 
 
<script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");

    sidebarBtn.onclick = function() {
        sidebar.classList.toggle("active");
        if(sidebar.classList.contains("active")){
            sidebarBtn.classList.replace("fa-bars" ,"fa-align-left"); 
        } 
        else
            sidebarBtn.classList.replace("fa-align-left", "fa-bars");
} 
</script>

<script>
    function editProductDetail(id) {
        location.href = `index.php?editDetail&idsanpham=${id}`;
    }
    function edit(id, page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("home-content").innerHTML = this.responseText;
            } 
        };    
        // console.log(path);
        var path = `modules/manageProducts/edit.php?&id=${id}&page=${page}`;
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    function remove(id) {
        location.href = `modules/manageProducts/handle.php?idsanpham=${id}`;
    }
    function comeback() {
        location.href = `index.php?dashboard`;
    }
    function suggest() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("home-content").innerHTML = this.responseText;
            } 
        };     
        path = `modules/showSearch.php?search=${document.getElementById('search-input').value.trim()}`; 
        if (path.includes('Chi tiết')) {
            path = `modules/showSearch.php?search=${document.getElementById('search-input').value.replace("Chi tiết", '').trim()}`; 
            path += '&detail';  
        }
        xhttp.open("GET", path, true);
        xhttp.send();
    }
</script>

<!-- <script>
    $(document).ready(function() {
        $(document).on('click', '.pagination_search_link', function(){  
           var page = $(this).attr("id");   
           suggest(page);   
        });   
    });
</script> -->