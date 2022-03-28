<!-- Lấy thông tin nhân viên từ get id     -->
<?php 
    session_start();
    // define
    $ciphering = "AES-256-CTR";
    $option = 0;
    $encryption_iv = '1122334455667788';
    $encryption_key = "aaaaaaaa";
    require 'connectdatabase.php';
    if(!isset($_SESSION['username']) || !$_SESSION['username']) {
        header("Location: index.php");
        exit();
    }
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql_sel = "SELECT id ,hoten, mapb, diachi,sdt ,email ,username,password,luong FROM nhanvien WHERE `id` = $id";
        $result = $conn->query($sql_sel);
        $rows = mysqli_fetch_array($result);
    }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/new_logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


	<title>Nhân Viên - Quản Lý Nhân Viên</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    QUẢN LÝ NHÂN VIÊN
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="profile.php">
                        <i class="pe-7s-user"></i>
                        <p>Cá Nhân</p>
                    </a>
                </li>
                <li class="active">
                    <a href="nhanvien.php">
                        <i class="pe-7s-users"></i>
                        <p>nhân viên</p>
                    </a>
                </li>
                <li>
                    <a href="phongban.php">
                        <i class="pe-7s-home"></i>
                        <p>Phòng Ban</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="controller_logout.php">
                        <i class="pe-7s-close" style="margin-left: 30px;"></i>
                        <p>Đăng Xuất</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <p class="navbar-brand" href="#">SỬA THÔNG TIN NHÂN VIÊN</p>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
            <form method="post" action="controller_edit.php">
              <div class="form-group" style="display: none;">
                <label>ID</label>
                <input type="text" name="nid" class="form-control" value="<?php echo $rows["id"]; ?>">
              </div>
              <div class="form-group">
                <label >Họ Và Tên</label>
                <input name="hoten" type="text" class="form-control" placeholder="Nhập họ và tên" value="<?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                 echo $rows["hoten"]; }
                 else {
                    echo "";
                 }
                ?>">
              </div>
              <div class="form-group">
                    <label for="phongban">Phòng Ban <?php
                        if(isset($_SESSION['username']) && $_SESSION['username']) {
                        $mapb2 = $rows["mapb"];
                        $sql2 = "SELECT tenpb from phongban WHERE mapb = '$mapb2'";
                        $result2 = $conn->query($sql2);
                        $rows2 = mysqli_fetch_array($result2);
                        }
                        else { echo "Lỗi!"; }
                        ?>   </label>
                    <select class="form-control" name="phongban">
                      <?php 
                                        $sql = "SELECT mapb, tenpb from phongban";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        // Load dữ liệu lên website
                                        while($row = $result->fetch_assoc()) {

                                            ?>

                    <option <?= $rows["mapb"] == $row["mapb"] ? "selected" : "" ?>  value='<?= $row["mapb"] ?>'> <?= $row["tenpb"] ?></option>";

                    <?php
                                        }
                                    }
                     ?>
                    </select>
                  </div>

            <div class="form-group">
                <label >Địa Chỉ</label>
                <input name="diachi" type="text" class="form-control" placeholder="Số nhà, đường, xã,..." value="<?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                echo $rows["diachi"]; }
                ?>">
            </div>

            <div class="form-group">
                <label>Số Điện Thoại</label>
                <input name="sdt" type="text" class="form-control" aria-describedby="emailHelp" placeholder="SĐT" value="<?php
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                echo $rows["sdt"];} ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Nhập vào email" value="<?php 
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                    echo $rows["email"];} ?>">
            </div>
        
            <div class="form-group">
                <label>Tên Đăng Nhập</label>
                <input name="username" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Username" value="<?php 
                if(isset($_SESSION['username']) && $_SESSION['username']) {
                echo $rows["username"];} ?>">
            </div>

            <div class="form-group">
                <label>Mật Khẩu</label>
                <input name="password" type="text" class="form-control" placeholder="Password" value="<?php
                $password_decryption = openssl_decrypt($rows["password"], $ciphering, $encryption_key,$option,$encryption_iv);
                echo $password_decryption;
                ?>">
            </div>

            <div class="form-group">
                <label>Lương</label>
                <input name="luong" type="text" class="form-control" placeholder="Nhập vào lương" value="<?php
                $luong_decryption = openssl_decrypt($rows["luong"], $ciphering, $encryption_key,$option,$encryption_iv);
                echo $luong_decryption; ?>">
            </div>


            <div class="modal-footer">
                <button type="submit" class="btn btn-secondary" name="return">Quay Lại</button>
                <button <?php if($rows["username"] == 'admin') {
                echo "disabled"; } 
            ?> type="submit" class="btn btn-primary" name="Confirm">Lưu Lại</button>
            </div>

            
         </form>
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid" style="position: absolute; bottom: 0;right: 0;">
                <nav class="pull-left" style="display: flex; justify-content: space-between;">
                </nav>
                <p class="copyright pull-right">
                    &copy; 2021 <a href="#">Quản Lý Nhân Viên</a>, An toàn ứng dụng web và cơ sở dữ liệu
                </p>
            </div>
        </footer>


    </div>
</div>

</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

    <script src="assets/js/custom.js"></script>

</html>
