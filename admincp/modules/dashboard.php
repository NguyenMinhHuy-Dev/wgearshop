<?php
    include("./config/config.php");
?>

<script>
    document.querySelector('#dashboard').classList.add('active');
    document.querySelector('.name-page').innerHTML = "Dashboard";
</script>

<div class="dashboard-page home-content" id="home-content">
    <div class="filter-box">
        <div class="date-picker">
            <input onchange="changeDate()" type="date" name="date" id="date" class="input">
        </div>
        <div class="choose-date">
            <label for="Day">Day</label>
            <input type="radio" checked name="format" class="input" id="Day">
            <label for="Month">Month</label>
            <input type="radio" name="format" class="input" id="Month"> 
        </div>
        <div class="chart-box">
            <input onclick="chart()" type="button" value="Chart">
        </div>
    </div>
    <div class="box-cover" id="box-cover">
        
    </div>
</div>


<script>
    function chart() {
        location.href = "index.php?chart";
    }
    function changeDate() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("box-cover").innerHTML = this.responseText;
            } 
        };    
        var date = document.getElementById('date').value;
        var d = new Date(date);
        var month = d.getMonth() + 1;
        // console.log(path);
        var path = '';
        if (document.getElementById('Day').checked == true) {
            path = `modules/showDashboard.php?day=${date}`;
        }
        else if (document.getElementById('Month').checked == true) {
            path = `modules/showDashboard.php?month=${month}`;
        } 
        // alert(path);
        xhttp.open("GET", path, true);
        xhttp.send();
    }
    changeDate();
</script>