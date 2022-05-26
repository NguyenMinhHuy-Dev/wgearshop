<?php 
    include("../.././config/config.php"); 
?>

<table class="products-table">
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
            $sql = "SELECT * FROM tb_account WHERE type != 1 ORDER BY create_at DESC";
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