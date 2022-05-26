<?php
    include("../config/config.php");
    $sql_product = "SELECT * FROM tb_product WHERE name LIKE '%{$_GET['search']}%'";
    $sql_acocunt = "SELECT * FROM tb_account WHERE name LIKE '%{$_GET['search']}%'";
    $query_product = mysqli_query($mysqli, $sql_product);  
    $query_account = mysqli_query($mysqli, $sql_acocunt);  

?>  

<link rel="stylesheet" href="./css/productsadmincp.css?v=<?php echo time(); ?>">

<style>
    .home-section .account-page {
        padding-top: 80px;
    }
</style>

<table class="products-table">
    <?php
        if (isset($_GET['detail'])) {
    ?>
        <thead>
            <tr style="height: 50px"> 
                <th rowspan='1' colspan='1' style='width:300px; min-width: 200px'>NAME</th>
                <th rowspan='1' colspan='1' style='width:180px; min-width: 150px'>CATEGORY</th>
                <th rowspan='1' colspan='1' style='width:170px'>IMAGE</th>
                <th rowspan='1' colspan='1' style='width:120px'>CONFIG</th> 
                <th rowspan='1' colspan='1' style='width:120px'>CONTENT</th> 
                <th  align='center' rowspan='1' colspan='1' style='width:170px; min-width:170px; text-align:center'>SETTING</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php 
                $sql = "SELECT * FROM tb_product WHERE name LIKE '%{$_GET['search']}%'";
                $query = mysqli_query($mysqli, $sql);
                // $total_records = mysqli_num_rows($query);
                // $record_per_page = 5;
                // $page = (int)$_GET["page"];
                // $start_from = ($page - 1)*$record_per_page; 

                // $sql = $sql." LIMIT ".$start_from.", ".$record_per_page;
                $query = mysqli_query($mysqli, $sql); 

                while ($row = mysqli_fetch_array($query)) { 
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <?php 
                        $sql_loai = "SELECT * FROM tb_category";
                        $query_loai = mysqli_query($mysqli, $sql_loai);
                        while ($row2 = mysqli_fetch_array($query_loai)) {
                            if ($row2["id"] == $row["id_category"]) {
                                echo $row2["name"];
                                break;
                            }
                        }
                    ?>
                </td>
                <td><img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt=""></td>
                <td><?php if ($row['content'] != '') echo "EDITED"; else echo "NULL"; ?></td>
                <td><?php if ($row['config'] != '') echo "EDITED"; else echo "NULL"; ?></td>
                <td style="text-align:center">
                    <i onclick="editProductDetail(<?php echo $row['id']; ?>)" id="edit" class="icon edit fa-solid fa-pen-to-square"></i>
                </td>
            </tr> 
            <?php
                }
            ?>  
        </tbody>
    <?php
        }
        else if (mysqli_num_rows($query_product) > 0) {
    ?>
        <thead>
            <tr style="height: 50px"> 
                <th rowspan='1' colspan='1' style='width:300px; min-width: 200px'>NAME</th>
                <th rowspan='1' colspan='1' style='width:180px; min-width: 150px'>CATEGORY</th>
                <th rowspan='1' colspan='1' style='width:170px'>IMAGE</th>
                <th rowspan='1' colspan='1' style='width:120px'>AMOUNT</th>
                <th rowspan='1' colspan='1' style='width:150px'>PRICE</th>
                <th rowspan='1' colspan='1' style='width:100px'>STATUS</th>
                <th rowspan='1' colspan='1' style='width:170px; min-width:170px'>SETTING</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php 
                $sql = "SELECT * FROM tb_product WHERE name LIKE '%{$_GET['search']}%'";
                $query = mysqli_query($mysqli, $sql);
                // $total_records = mysqli_num_rows($query);
                // $record_per_page = 5;
                // $page = (int)$_GET["page"];
                // $start_from = ($page - 1)*$record_per_page; 

                // $sql = $sql." LIMIT ".$start_from.", ".$record_per_page;
                $query = mysqli_query($mysqli, $sql); 

                while ($row = mysqli_fetch_array($query)) { 
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <?php 
                        $sql_loai = "SELECT * FROM tb_category";
                        $query_loai = mysqli_query($mysqli, $sql_loai);
                        while ($row2 = mysqli_fetch_array($query_loai)) {
                            if ($row2["id"] == $row["id_category"]) {
                                echo $row2["name"];
                                break;
                            }
                        }
                    ?>
                </td>
                <td><img src="modules/manageProducts/uploads/<?php echo $row["image"]; ?>" alt=""></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></td>
                <?php
                    if ($row["status"] == 1) {
                        echo "<td class='see-status'>Hiện</td>";
                    }
                    else {
                        echo "<td class='unsee-status'>Ẩn</td>";
                    }
                ?>
                <td>
                    <i onclick="remove(<?php echo $row['id']; ?>)" id="remove" class="icon trash fa-solid fa-square-minus"></i></a>
                    <i onclick="edit(<?php echo $row['id']; ?>, <?php echo $_GET['page']; ?>)" id="edit" class="icon edit fa-solid fa-square-pen"></i>
                </td>
            </tr> 
            <?php
                }
            ?>  
        </tbody>
    <?php
        }
        else if (mysqli_num_rows($query_account) > 0) {
    ?>
        <thead>
            <tr style="height: 50px"> 
                <th rowspan='1' colspan='1' style='width:100px; min-width: 90px'>AVATAR</th>
                <th rowspan='1' colspan='1' style='width:300px; min-width: 200px'>NAME</th>
                <th rowspan='1' colspan='1' style='width:180px; min-width: 150px'>USERNAME</th>
                <th rowspan='1' colspan='1' style='width:170px'>EMAIL</th>
                <th rowspan='1' colspan='1' style='width:120px'>PHONE</th>
                <th rowspan='1' colspan='1' style='width:150px'>TYPE</th>
                <th rowspan='1' colspan='1' style='width:100px'>STATUS</th>
                <th rowspan='1' colspan='1' style='width:170px; min-width:170px'>SETTING</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <?php 
                $sql = "SELECT * FROM tb_account WHERE name LIKE '%{$_GET['search']}%'";
                $query = mysqli_query($mysqli, $sql);
                // $total_records = mysqli_num_rows($query);
                // $record_per_page = 5;
                // $page = (int)$_GET["page"];
                // $start_from = ($page - 1)*$record_per_page; 

                // $sql = $sql." LIMIT ".$start_from.", ".$record_per_page;
                $query = mysqli_query($mysqli, $sql); 

                while ($row = mysqli_fetch_array($query)) { 
            ?>
            <tr>
                <td><img style="border-radius: 50%" src="./modules/manageAccounts/uploads/<?php echo $row['avatar']; ?>" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['contact']; ?></td>
                <td><?php echo $row['phone_number']; ?></td>
                <td style="<?php if ($row['type'] == 1) echo "; font-weight: 600";?>"><?php if ($row['type'] == 0) echo "Customer"; else echo "Admin"; ?></td>
                <td><?php if ($row['code'] == '') echo "Verified"; else echo "Not verified"; ?></td>
                <?php
                    if ($row['type'] == 0) {
                ?>
                <td>
                    <i onclick="removeAccount('<?php echo $row['username']; ?>')" id="remove" class="icon trash fa-solid fa-square-minus"></i></a>
                    <!-- <i onclick="" id="edit" class="icon edit fa-solid fa-square-pen"></i> -->
                </td>
                <?php
                    }
                ?>
            </tr> 
            <?php
                }
            ?>  
        </tbody>
    <?php
        }
    ?>
</table> 