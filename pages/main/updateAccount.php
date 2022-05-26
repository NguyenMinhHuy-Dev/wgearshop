<?php 
    session_start();
    include('../../admincp/config/config.php');

    if (isset($_SESSION['USERNAME'])) {
        $sql = "SELECT * FROM tb_account WHERE username='".$_SESSION['USERNAME']."'";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query); 
    }


    if (isset($_POST['submit'])) {
        $name = $_POST['input-name'] == '' ? $row['name'] : $_POST['input-name'];
        // $email = $_POST['input-email'] == '' ? $row['contact'] : $_POST['input-email'];
        $phone = $_POST['input-phone_number'] == '' ? $row['phone_number'] : $_POST['input-phone_number'];
        $address = $_POST['input-address'] == '' ? $row['address'] : $_POST['input-address'];
        if ($_FILES["avatar"]["name"] != '') {
            $avatar = time().'_'.$_FILES["avatar"]["name"];
            $avatar_tmp = $_FILES["avatar"]["tmp_name"];

            move_uploaded_file($avatar_tmp, '../..//admincp/modules/manageAccounts/uploads/'.$avatar);
            if ($row['avatar'] != 'default.jpg') {
                $sql = "SELECT * FROM tb_account WHERE username='".$_SESSION['USERNAME']."'";
                $query = mysqli_query($mysqli, $sql);
                while ($row2 = mysqli_fetch_array($query)) {
                    unlink('../../admincp/modules/manageAccounts/uploads/'.$row2["avatar"]);
                }
            } 
        }
        else {
            $avatar = $row['avatar'];
        }

        if (preg_match('/^[0-9\d_]{1,20}$/i', $_POST['input-phone_number']) == 0) {
           $phone = '';
        }
        if (preg_match('/^([a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+)$/i', $_POST['input-name']) == 0) {
            $name = $row['name'];
        } 

        $sql = "UPDATE tb_account SET name='{$name}', address='{$address}', phone_number='{$phone}', avatar='{$avatar}' WHERE username='{$_SESSION['USERNAME']}'"; 
        // echo $sql;
        mysqli_query($mysqli, $sql); 
        header("Location: ../../index.php?taikhoan");
    }

    if (isset($_GET['accept-order'])) {
        $sql = "UPDATE tb_cart SET status=1, date=CURRENT_TIMESTAMP() WHERE id={$_GET['accept-order']}";
        $query = mysqli_query($mysqli, $sql);
        header("Location: ../../index.php?taikhoan");
    }

    if (isset($_GET['return-order'])) {
        $sql = "UPDATE tb_cart SET status=2, date=CURRENT_TIMESTAMP() WHERE id={$_GET['return-order']}";
        $query = mysqli_query($mysqli, $sql);
        $sql_amount = "SELECT * FROM tb_cart_detail WHERE id_cart={$_GET['return-order']}";
        $query_amount = mysqli_query($mysqli, $sql_amount);
        while ($row_amount = mysqli_fetch_array($query_amount)) {
            $sql_product = "SELECT * FROM tb_product WHERE id={$row_amount['id_product']}";
            $query_product = mysqli_query($mysqli, $sql_product);
            $row_product = mysqli_fetch_array($query_product);

            $sql_update = "UPDATE tb_product SET sold = sold - {$row_amount['amount']}, quantity = quantity + {$row_amount['amount']} WHERE id={$row_product['id']}";
            mysqli_query($mysqli, $sql_update);
        }
        header("Location: ../../index.php?taikhoan");
    }
?> 