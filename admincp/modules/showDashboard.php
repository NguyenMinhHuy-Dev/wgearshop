<?php
    include("../config/config.php");
    $date = 'CURRENT_DATE()';
    if (isset($_GET['day'])) {
        if ($_GET['day'] != '') {
            $date = "'".$_GET['day']."'";
        }
        else {
            $date = 'CURRENT_DATE()';
        }
    }
    if (isset($_GET['month'])) {
        $date = $_GET['month'];
    }
?>
<div class="overview-boxes">
    <div class="box view">
        <!-- <div class="inner-box"> -->
            <div class="right-side">
                <div class="number">
                    <?php
                        if (isset($_GET['day'])) {
                            $sql = "SELECT SUM(view) FROM tb_page WHERE date={$date}";
                        }
                        if (isset($_GET['month'])) {
                            $sql = "SELECT SUM(view) FROM tb_page WHERE MONTH(date) = {$date}"; 
                        }
                        $query = mysqli_query($mysqli, $sql);
                        $row = mysqli_fetch_array($query);
                        if (mysqli_num_rows($query) > 0) {
                            echo $row['SUM(view)'];
                        }
                        else {
                            echo 0;
                        }
                    ?>
                </div>
                <div class="box-topic">Views</div>
            </div>
            <i class="fa-solid fa-eye"></i>
        <!-- </div> -->
    </div>
    
    <div class="box sale">
        <div class="right-side">
            <div class="number">
                <?php
                    if (isset($_GET['day'])) {
                        $sql = "SELECT SUM(cd.amount) FROM tb_cart AS c, tb_cart_detail AS cd WHERE c.id = cd.id_cart AND CAST(c.date AS date) = {$date} AND c.status != 2";
                    }
                    if (isset($_GET['month'])) {
                        $sql = "SELECT SUM(cd.amount) FROM tb_cart AS c, tb_cart_detail AS cd WHERE c.id = cd.id_cart AND MONTH(date) = {$date} AND c.status != 2";
                    }
                    $query = mysqli_query($mysqli, $sql);
                    $row = mysqli_fetch_array($query);
                    if ($row['SUM(cd.amount)'] != '') {
                        echo $row['SUM(cd.amount)'];
                    }
                    else {
                        echo 0;
                    }
                ?>
            </div>
            <div class="box-topic">Sales</div>
        </div>
        <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="box profit">
        <div class="right-side">
            <div class="number">
                <?php
                    if (isset($_GET['day'])) {
                        $sql = "SELECT * FROM tb_cart WHERE CAST(date AS date)={$date} and status=1";
                    }
                    if (isset($_GET['month'])) {
                        $sql = "SELECT * FROM tb_cart WHERE  MONTH(date) = {$date} and status=1";
                    }
                    $sumTotal = 0;
                    $query = mysqli_query($mysqli, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        $sumTotal += $row['total'];
                    }
                    echo number_format($sumTotal, 0, ".", ",")."đ";
                ?>
            </div>
            <div class="box-topic">Profit</div>
        </div>
        <i class="fa-solid fa-money-bill-wave"></i>
    </div>
    <div class="box return">
        <div class="right-side">
            <div class="number">
                <?php
                    if (isset($_GET['day'])) {
                        $sql = "SELECT SUM(cd.amount) FROM tb_cart AS c, tb_cart_detail AS cd WHERE c.id = cd.id_cart AND CAST(c.date AS date) = {$date} AND c.status = 2";
                    }
                    if (isset($_GET['month'])) {
                        $sql = "SELECT SUM(cd.amount) FROM tb_cart AS c, tb_cart_detail AS cd WHERE c.id = cd.id_cart AND MONTH(date) = {$date} AND c.status = 2";
                    }
                    $query = mysqli_query($mysqli, $sql);
                    $row = mysqli_fetch_array($query);
                    if ($row['SUM(cd.amount)'] != NULL) {
                        echo $row['SUM(cd.amount)'];
                    }
                    else {
                        echo 0;
                    }
                ?>
            </div>
            <div class="box-topic">Return</div>
        </div>
        <i class="fa-solid fa-face-frown"></i>
    </div>
</div>

<div class="orders-boxes">
    <div class="recent-orders box">
        <div class="title">Recent Orders</div>
        <div class="button">
            <a href="index.php?orders">See All</a>
        </div>
        <div class="orders-details">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th align='left' style="width:270px; min-width:180px">Customer</th>
                        <th align='right' style="width:150px; min-width:80px">Price</th>
                        <th align='center'>Payment</th>
                        <th align='center'>Date</th>
                        <th align='right'>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM tb_cart ORDER BY date DESC LIMIT 8";
                        $query = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name_customer']; ?></td>
                        <td align='right'><?php echo number_format($row['total'], 0, ".", ",")."đ"; ?></td>
                        <td align='center'>
                            <?php
                                if ($row['method_payment'] == 0) {
                                    echo "Due";
                                }
                                else {
                                    echo "Paid";
                                }
                            ?>
                        </td>
                        <td align='center'><?php echo $row['date']; ?></td>
                        <td align='right'>
                            <?php
                                if ($row['status'] == 0) {
                                    echo "<span class='progress status-span'>In progress</span>";
                                }
                                else if ($row['status'] == 1) {
                                    echo "<span class='success status-span'>Delivered</span>";
                                }
                                else {
                                    echo "<span class='return status-span'>Return</span>";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="best-sale-product box">
        <div class="title">Best seller</div>
        <table class="orders-table best-table">
            <thead>
                <tr>
                    <th align='left' style="width:150px; min-width:80px">Name</th>
                    <th align='right' style="width:80px; min-width:70px">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM tb_product ORDER BY sold DESC LIMIT 5";
                    $query = mysqli_query($mysqli, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td align='right'><?php echo number_format($row['sale_price'], 0, ".", ",")."đ"; ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>