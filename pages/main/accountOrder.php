<?php
    session_start();
    include("../../admincp/config/config.php");

    $sql = "SELECT * FROM tb_account WHERE username='{$_SESSION['USERNAME']}'";
    $query = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_array($query);

?>  

<link rel="stylesheet" href="css/account.css?v=<?php echo time(); ?>">

    <table class='order-info-table'> 
        <thead>
            <tr>
                <th align='left' colspan='1' style="width: 150px; min-width: 150px">MÃ ĐƠN HÀNG</th>
                <th align='right' colspan='1' style="width: 100px; min-width: 100px">TIỀN</th>
                <th colspan='1' style="width: 150px; min-width: 150px">TRẠNG THÁI</th>
                <th colspan='1' style="width: 150px; min-width: 150px">XÁC NHẬN</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql_order = "SELECT * FROM tb_cart WHERE email_customer='{$row['contact']}' ORDER BY status ASC, date DESC";
                $query_order = mysqli_query($mysqli, $sql_order); 
                while ($row_order = mysqli_fetch_array($query_order))  { 
            ?>
                    <tr>
                        <td align='left'>WG-<?php echo $row_order['id'].$row_order['date']; ?></td>
                        <td align='right'><?php echo number_format($row_order['total'], 0, ".", ",")."đ"; ?></td>
                        <td align='center'>
                            <?php
                                if ($row_order['status'] == 1) {
                                    echo "<span class='success status-span'>Delivered</span>";
                                }
                                else if ($row_order['status'] == 2) {
                                    echo "<span class='return status-span'>Cancelled</span>";
                                }
                                else {
                                    echo "<span class='progress status-span'>In progress</span>";
                                }
                            ?>
                        </td>
                        <?php
                            if ($row_order['status'] == 0) {
                        ?>
                                <td>
                                    <span onclick="acceptOrder(<?php echo $row_order['id']; ?>)" class="button success-btn">Đã nhận</span>
                                    <span onclick="returnOrder(<?php echo $row_order['id']; ?>)" class="button return-btn">Hủy đơn</span> 
                                </td>
                        <?php
                            }
                            // else {
                        ?>
                            <!-- <td>
                                <i class="star fa-solid fa-star" id="star1"></i>
                                <i class="star fa-solid fa-star" id="star2"></i>
                                <i class="star fa-solid fa-star" id="star3"></i>
                                <i class="star fa-solid fa-star" id="star4"></i>
                                <i class="star fa-solid fa-star" id="star5"></i> 
                            </td> -->
                        <?php
                            // }
                        ?>
                    </tr>
            <?php
                }
            ?> 
        </tbody> 
    </table> 

