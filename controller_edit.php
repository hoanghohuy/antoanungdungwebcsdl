    <!-- xử lý sửa thông tin lưu vào csdl     -->
<?php
        //define
        $ciphering = "AES-256-CTR";
        $option = 0;
        $encryption_iv = '1122334455667788';
        $encryption_key = "aaaaaaaa";

    require 'connectdatabase.php';
    if (isset($_POST["Confirm"])) {
        // BLOCK XSS bang hàm htmlspecialchars.
        $nid = htmlspecialchars($_POST["nid"],ENT_QUOTES);
        $hoten = htmlspecialchars($_POST["hoten"],ENT_QUOTES);
        $phongban = htmlspecialchars($_POST["phongban"],ENT_QUOTES);
        $diachi = htmlspecialchars($_POST["diachi"],ENT_QUOTES);
        $sdt = htmlspecialchars($_POST["sdt"],ENT_QUOTES);
        $email = htmlspecialchars($_POST["email"],ENT_QUOTES);
        $username = htmlspecialchars($_POST["username"],ENT_QUOTES);
        $password = htmlspecialchars($_POST["password"],ENT_QUOTES);
        $luong = htmlspecialchars($_POST["luong"],ENT_QUOTES);
        
        // ma hoa password va luong
        $password_aes = openssl_encrypt($password, $ciphering, $encryption_key,  $option, $encryption_iv);
        $luong_aes = openssl_encrypt($luong, $ciphering, $encryption_key,$option,$encryption_iv);

        $sql ="UPDATE nhanvien SET hoten = '$hoten', mapb= '$phongban',phai = 'Nam',diachi = '$diachi', sdt ='$sdt', email='$email', username= '$username', password= '$password_aes',luong = '$luong_aes' WHERE id = $nid" ;
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