<?php 
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

	<title>Quản Lý Nhân Sự</title>

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
                <li class="active">
                    <a href="#">
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
                    <p class="navbar-brand" href="#">THÔNG TIN CÁ NHÂN</p>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Project Nhóm 18</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Môn học</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="An toàn ứng dụng web và cơ sở dữ liệu">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Giảng Viên</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="Huỳnh Thanh Tâm">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">NHÓM SINH VIÊN THỰC HIỆN</label>
                                                <input type="email" class="form-control" disabled placeholder="Email" value="18">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input disabled type="text" class="form-control" placeholder="Company" value="Hồ Huy Hoàng">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MSSV</label>
                                                <input disabled type="text" class="form-control" placeholder="Last Name" value="N18DCAT025">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input disabled type="text" class="form-control" placeholder="Company" value="Nguyễn Văn Thanh Tú">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MSSV</label>
                                                <input disabled type="text" class="form-control" placeholder="Last Name" value="N18DCAT077">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Họ và tên</label>
                                                <input disabled type="text" class="form-control" placeholder="Company" value="Đỗ Anh Tuấn">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>MSSV</label>
                                                <input disabled type="text" class="form-control" placeholder="Last Name" value="N18DCAT079">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>LỚP</label>
                                                <input disabled type="text" class="form-control" placeholder="City" value="D18CQAT01-N">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mô tả bản thân</label>
                                                <textarea rows="4" class="form-control" placeholder="Here can be your description" value="Mike"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/default-avatar.png" alt="..."/>

                                      <h4 class="title">NHÓM 18<br />
                                         <small>***</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "ThS, Huỳnh Thanh Tâm <br>
                                                    An toàn ứng dụng web và cơ sở dữ liệu"
                                </p>
                            </div>
                            <hr>
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
                            <a href="#">
                                User Profile
                            </a>
                        </li>
                        <li>
                            <a href="nhanvien.php">
                                Quản Lý Nhân Viên
                            </a>
                        </li>
                        <li>
                            <a href="phongban.php">
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
