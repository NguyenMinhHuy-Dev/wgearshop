<?php
    include("../../config/config.php");
        $sql = "SELECT * FROM tb_account WHERE username='".$_GET["username"]."' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/'.$row["avatar"]);
        }
        $sql_xoa = "DELETE FROM tb_account WHERE username='".$_GET["username"]."'";
        mysqli_query($mysqli, $sql_xoa);
        header('Location:../../index.php?customers');  
?>