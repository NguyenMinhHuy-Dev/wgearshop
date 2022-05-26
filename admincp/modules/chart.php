<?php
    include("./config/config.php");

    // $sql = "SELECT MONTH(date), SUM(total) FROM tb_cart WHERE status=1 GROUP BY MONTH(date)";
    $sql = "SELECT MONTH(date) as date, SUM(total) FROM tb_cart WHERE status=1 GROUP BY MONTH(date)";
    $query = mysqli_query($mysqli, $sql);
    $chart_data = '';
    while ($row = mysqli_fetch_array($query)) {
        $chart_data .=  "{day: '".$row['date']."', profit:".$row['SUM(total)']."}, ";
    }
    $chart_data = substr($chart_data, 0, -2); 
    
    $sql_view = "SELECT date, SUM(view) FROM tb_page GROUP BY Day(date)";
    $query_view = mysqli_query($mysqli, $sql_view);
    $chart_data_view = '';
    while ($row_view = mysqli_fetch_array($query_view)) {
        $chart_data_view .=  "{day: '".$row_view['date']."', view:".$row_view['SUM(view)']."}, ";
    }
    $chart_data_view = substr($chart_data_view, 0, -2);
?>

<script>
    document.querySelector('#dashboard').classList.add('active');
    document.querySelector('.name-page').innerHTML = "Dashboard";
</script>

<div class="dashboard-page home-content" id="home-content" style="padding-left: 20px">
    <div class="chart-box">
        <input onclick="returnDashboard()" type="button" value="Return" style="margin-left: 50px">
    </div>
    <div class="box-cover" id="box-cover">
        <div class="container" style="width:100%; margin-top:100px">
            <h2 align="center">THỐNG KÊ DOANH THU BÁN HÀNG TỪNG THÁNG TRONG NĂM 2022</h2> 
            <br /><br />
            <div id="chart"></div>
        </div>
    </div>

    <div class="box-cover" style="padding-bottom:100px">
        <div class="container" style="width:100%; margin-top:100px">
            <h2 align="center">THỐNG KÊ LƯỢT XEM TỪNG NGÀY</h2> 
            <br /><br />
            <div id="chart2"></div>
        </div>
    </div>
</div>

<script>
    Morris.Bar({
        element : 'chart',
        data:[<?php echo $chart_data; ?>],
        xkey:'day',
        ykeys:['profit'],
        labels:['Profit'],
        barColors: ["#d277f7", "#1531B2", "#1AB244", "#B29215"],
        // hideHover:'auto'
        // stacked:true
    });

    Morris.Line({
        element : 'chart2',
        data:[<?php echo $chart_data_view; ?>],
        xkey:'day',
        ykeys:['view'],
        labels:['view'],
        lineColors: ["#d277f7", "#1531B2", "#1AB244", "#B29215"],
        // hideHover:'auto'
        // stacked:true
    });
</script>

<script>
    function returnDashboard() {
        location.href = "index.php";
    }
</script>