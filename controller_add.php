<?php
    require 'connectdatabase.php';
    if (isset($_POST["AddNhanVien"])) {
        // block xss bang cach su dung ham htmlspecialchars()
        $hoten = htmlspecialchars($_POST["hoten"],ENT_QUOTES);
        $phongban = htmlspecialchars($_POST["phongban"],ENT_QUOTES);
        $diachi = htmlspecialchars($_POST["diachi"],ENT_QUOTES);
        $sdt = htmlspecialchars($_POST["sdt"],ENT_QUOTES);
        $email = htmlspecialchars($_POST["email"],ENT_QUOTES);
        $username = htmlspecialchars($_POST["username"],ENT_QUOTES);
        $password = htmlspecialchars($_POST["password"],ENT_QUOTES);
        $luong = htmlspecialchars($_POST["luong"],ENT_QUOTES);
        //define AES
        $ciphering = "AES-256-CTR";
        $option = 0;
        $encryption_iv = '1122334455667788';
        $encryption_key = "aaaaaaaa";
        $password_aes = openssl_encrypt($password, $ciphering, $encryption_key,  $option, $encryption_iv);
        $luong_aes = openssl_encrypt($luong, $ciphering, $encryption_key,$option,$encryption_iv);
        // SQL
        $sqladd = "INSERT INTO nhanvien (ID, HOTEN, MAPB, PHAI, DIACHI, SDT, EMAIL, USERNAME, PASSWORD, LUONG, isAdmin) VALUES (NULL, '$hoten', '$phongban', 'Nam', '$diachi', '$sdt', '$email', '$username','$password_aes','$luong_aes', '0')";
        $result = $conn->query($sqladd);
        if($result ==true) {
        header("Location: nhanvien.php");
        }
        else {
            echo "Có lỗi xảy ra.";
        }
    }
?>