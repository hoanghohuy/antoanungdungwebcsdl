<?php
require 'connectdatabase.php';
ob_start();
$id = $_GET['id'];
header('Content-Type: application/json');
if(!isset($id) || !is_numeric($id) || intval($id) < 1){
	echo json_encode(array(
		"result" => false,
		"message" => "ID khong hop le"
	));
	exit();
}


// SQL
$sql = "SELECT id ,hoten ,mapb ,diachi,sdt ,email ,luong ,username, password FROM nhanvien WHERE id = " . $id;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    	echo json_encode(array(
			"result" => true,
			"message" => "Lay thanh cong",
			"data" => $row
		));
		break;
    }
}else{
	echo json_encode(array(
		"result" => false,
		"message" => "Id khong ton tai",
	));
}
ob_end_flush();
?>