<?php
$servername = "localhost";
$database = "nhom18_quanlynhanvien";
$username = "nhom18_quanlynhanvien";
$password = "c4ca4238a0b923820dcc509a6f75849b";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
        mysqli_set_charset($conn, 'UTF8');
// Check connection
if (!$conn) {
    die("Connection failed: ");
}

function rand_string($length){
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$size = strlen($chars);
$str = '';
for( $i = 0; $i < $length; $i++ ) {

    $str .= $chars[rand(0,$size - 1)];

}
return $str;
}

?>