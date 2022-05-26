<?php 
    include("../.././config/config.php"); 
?> 

<table class="products-table">
    <thead>
        <tr style="height: 50px"> 
            <th rowspan='1' colspan='1' style='width:80px; min-width: 80px'>CODE</th>
            <th rowspan='1' colspan='1' style='width:200px; min-width: 200px'>CUSTOMER</th>
            <th rowspan='1' colspan='1' style='width:180px; min-width: 150px'>EMAIL</th>
            <th rowspan='1' colspan='1' style='width:50px; min-width: 50px'>PAYMENT</th>
            <th rowspan='1' colspan='1' style='width:150px; min-width: 100px'>DATE</th>
            <th rowspan='1' colspan='1' style='width:150px; text-align:right'>PRICE</th>
            <th rowspan='1' colspan='1' style='width:50px'>STATUS</th>
            <th rowspan='1' colspan='1' style='width:100px; min-width:100px'>DETAIL</th>
        </tr>
    </thead>
    <tbody id="table-body">
        <?php 
            $sql = "SELECT * FROM tb_cart ORDER BY date DESC";
            $query = mysqli_query($mysqli, $sql);
            $total_records = mysqli_num_rows($query);
            $record_per_page = 6;
            $page = (int)$_GET["page"];
            $start_from = ($page - 1)*$record_per_page; 

            // $sql = $sql." LIMIT ".$start_from.", ".$record_per_page;
            // $query = mysqli_query($mysqli, $sql); 

            while ($row = mysqli_fetch_array($query)) { 
        ?>
        <tr>
            <td><?php echo "WG-".$row['id']; ?></td>
            <td><?php echo $row['name_customer']; ?></td> 
            <td><?php echo $row['email_customer']; ?></td>
            <td><?php if ($row['method_payment'] == 0) echo "Due"; else echo "Paid"; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td style="text-align:right"><?php echo number_format($row['total'], 0, ".", ",")."đ"?></td>
            <td>
            <?php
                if ($row['status'] == 0) {
                    echo "<span style='display:inline-block; width: auto; padding:5px 10px' class='progress status-span'>In progress</span>";
                }
                else if ($row['status'] == 1) {
                    echo "<span style='display:inline-block; width: auto; padding:0 10px' class='success status-span'>Delivered</span>";
                }
                else {
                    echo "<span style='display:inline-block; width: auto; padding:0 10px' class='return status-span'>Return</span>";
                }
            ?>
            </td> 
            <td><i onclick="detailOrder(<?php echo $row['id']; ?>)" class="detail-product fa-solid fa-arrow-up-right-from-square"></i></td>
        </tr> 
        <?php
            }
        ?>  
    </tbody>
</table> 