<?php
    require 'connectdatabase.php';
    if (isset($_POST["ConfirmDelete"])) {
        $nid = $_POST["nid"];
        if($nid == 1) {
        header("Location: nhanvien.php");
        exit();
        }
        $sql ="DELETE FROM nhanvien WHERE id = $nid" ;
        $result = $conn->query($sql);
        if($result == true) {
        header("Location: nhanvien.php");
        }
        else {
            echo "Có lỗi xảy ra! Hãy thử lại sau!!!";
        }
    }
    if (isset($_POST["return"])) {
        header("Location: nhanvien.php");
    }
 ?>