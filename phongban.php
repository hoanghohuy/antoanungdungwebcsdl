<?php 
    require 'connectdatabase.php';
    session_start();
    if(!isset($_SESSION['username']) || !$_SESSION['username']) {
        header("Location: index.php");
        exit();
    }
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/new_logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Phòng Ban - Quản Lý Nhân Viên</title>

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
                    Quản Lý Nhân Viên
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="profile.php">
                        <i class="pe-7s-user"></i>
                        <p>Cá Nhân</p>
                    </a>
                </li>
                <li>
                    <a href="nhanvien.php">
                        <i class="pe-7s-users"></i>
                        <p>Nhân Viên</p>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
                    <p class="navbar-brand">PHÒNG BAN</p>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh Sách Phòng Ban</h4>
                                <p class="category">Dưới đây là tất cả các phòng ban trong công ty</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    	<th>Mã Phòng Ban</th>
                                    	<th>Tên Phòng Ban</th>
                                    	<th>Hành Động</th>
                                    </thead>
                                    </thead>
                                    <tbody>
                            <?php
                                        $sql = "SELECT mapb, tenpb from phongban";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        // Load dữ liệu lên website
                                        while($row = $result->fetch_assoc()) {
                                        echo    "<tr>";
                                        echo            "<td>" . $row["mapb"]. "</td>";
                                        echo            "<td>" . $row["tenpb"]. "</td>";
                                        echo            "<td>";
                                        echo            "<button type='button' disabled class='btn btn-warning' data-toggle='modal' data-target='#EditModal'>Sửa</button>";
                                        echo            "<button type='button' disabled class='btn btn-danger' data-toggle='modal' data-target='#exampleModal'>Xóa</button>";
                                        echo            "</td>";
                                        echo    "</tr>";
                                        }
                                    }
                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="profile.php">
                                User Profile
                            </a>
                        </li>
                        <li>
                            <a href="nhanvien.php">
                                Quản Lý Nhân Viên
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Phòng Ban
                            </a>
                        </li>
                    </ul>
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

</html>
