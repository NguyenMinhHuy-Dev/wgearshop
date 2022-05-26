<?php 
    include("../.././config/config.php"); 
?>

<table class="products-table">
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
            $sql = "SELECT * FROM tb_product";
            $query = mysqli_query($mysqli, $sql);
            $total_records = mysqli_num_rows($query);
            $record_per_page = 5;
            $page = (int)$_GET["page"];
            $start_from = ($page - 1)*$record_per_page; 

            $sql = $sql." LIMIT ".$start_from.", ".$record_per_page;
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
                <i onclick="removeProduct(<?php echo $row['id']; ?>)" id="remove" class="icon trash fa-solid fa-square-minus"></i></a>
                <i onclick="editProduct(<?php echo $row['id']; ?>, <?php echo $_GET['page']; ?>)" id="edit" class="icon edit fa-solid fa-square-pen"></i>
            </td>
        </tr> 
        <?php
            }
        ?>  
    </tbody>
</table>
<div class="products-talbe-pages">
    <div class="page-numbers">
        <?php
            if ($_GET["page"] != 1) {
                echo "<i id='1' class='icon arrow left-arrow pagination_link fa-solid fa-angles-left'></i>";
                echo "<i id='".($_GET['page'] - 1)."' class='icon arrow left-arrow pagination_link fa-solid fa-angle-left'></i>";
            }
            else {
                echo "<i style='color:var(--input); user-select:none' class='icon arrow left-arrow fa-solid fa-angles-left'></i>";
                echo "<i style='color:var(--input); user-select:none' class='icon arrow left-arrow fa-solid fa-angle-left'></i>";
            }
        ?> 
        <ul>
            <?php 
                $total_pages = ceil($total_records/$record_per_page);
                $during_pages = ceil($total_pages/9);
                $x = 10; 
                while ($x <= $_GET['page']) { 
                    $x += 9;
                }
                $i = $x - 9;
                // if ($i == 0) {
                //     $i = 1;
                // } 
                    for (; $i <= $total_pages ; $i++) { 
                        if ($i == $x) {
                            break;
                        }
            ?>
            
            <li style="user-select:none" class="pagination_link <?php if ($_GET["page"] == $i) echo "active" ?>" id="<?php echo $i; ?>"><?php echo $i; ?></li>
            <?php
                    }
                // }
            ?>
        </ul>

        <?php
            if ($_GET["page"] != $total_pages) {
                echo "<i id='".($_GET["page"] + 1)."' class='icon arrow right-arrow pagination_link fa-solid fa-angle-right'></i>";
                echo "<i id='{$total_pages}' class='icon arrow right-arrow pagination_link fa-solid fa-angles-right'></i>";
            }
            else {
                echo "<i style='color:var(--input); user-select:none' class='icon arrow right-arrow fa-solid fa-angle-right'></i>";
                echo "<i style='color:var(--input); user-select:none' class='icon arrow right-arrow fa-solid fa-angles-right'></i>";
            }
        ?>  
    </div>
</div>