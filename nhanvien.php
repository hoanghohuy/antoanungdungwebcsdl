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
                    <a href="#">
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
                        <p>
                        <?php 
                        if(isset($_SESSION['username']) && $_SESSION['username']) {
                            echo "Đăng Xuất";
                        }
                        else {
                            echo "Đăng Nhập";
                        }
                        ?>
                        </p>
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
                    <p class="navbar-brand" href="#">QUẢN LÝ NHÂN VIÊN</p>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Danh Sách Nhân Viên</h4>
                                <p class="category">Dưới đây là tất cả các nhân viên trong phòng ban</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Họ và tên</th>
                                        <th>Phòng Ban</th>
                                    	<th>Địa chỉ</th>
                                        <th>SĐT</th>
                                    	<th>Email</th>
                                        <th>Username</th>
                                    	<th>Hành Động</th>
                                    </thead>
                                    </thead>
                                    <tbody>
            <?php   
            $sql = "SELECT id ,hoten ,mapb ,diachi,sdt ,email ,luong ,username FROM nhanvien WHERE isAdmin = '0' ORDER BY id DESC";
            $result = $conn->query($sql);
            // đổ dữ liệu từ database lên bảng
            if ($result->num_rows > 0) {
            // Load dữ liệu lên website
            while($row = $result->fetch_assoc()) {
            echo    "<tr>";
            echo            "<td>". $row["id"]. "</td>";
            echo            "<td>". $row["hoten"]. "</td>";
            echo            "<td>". $row["mapb"]. "</td>";
            echo            "<td>". $row["diachi"]. "</td>";
            echo            "<td>". $row["sdt"]. "</td>";
            echo            "<td>". $row["email"]. "</td>";
                                // ". $row["luong"] ."$
            echo            "<td>". $row["username"] ."</td>";
            echo            "<td>";
            echo  "<button type='button' class='btn btn-warning btn-edit' data-id='";
            echo    $row["id"];
            echo  "'>Xem</button>";
            echo    "<button type='button' class='btn btn-warning'><a href='sua_nhanvien.php?id=";
            echo  $row["id"];
            echo  "'>Sửa</a></button>";
            echo    "<button type='button' class='btn btn-warning'><a style='color: red;' href='xoa_nhanvien.php?id=";
            echo  $row["id"];
            echo "'>Xóa</a></button>";
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
                <?php 
                if(isset($_SESSION['username']) && $_SESSION['username']) { 
                echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#AddModal'>THÊM NHÂN VIÊN</button>";
                    }
                ?> 
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
                            <a href="#">
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

<!-- Modal Thêm -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header hoang">
        <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên mới</h5>
        <button style="margin-right: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form method="post" action="controller_add.php">
              <div class="form-group">
                <label >Họ Và Tên</label>
                <input name="hoten" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Nhập họ và tên" required>
              </div>
              <div class="form-group">
                    <label for="phongban">Phòng Ban</label>
                    <select class="form-control" name="phongban">
                      <?php 
                                        $sql = "SELECT mapb, tenpb from phongban";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        // Load dữ liệu lên website
                                        while($row = $result->fetch_assoc()) {
                                        echo            "<option value='".$row["mapb"]."'>" .$row["tenpb"]."</option>";
                                        }
                                    }
                              ?>
                     ?>
                    </select>
                  </div>

            <div class="form-group">
                <label >Địa Chỉ</label>
                <input name="diachi" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Số nhà, đường, xã,...">
            </div>

            <div class="form-group">
                <label>Số Điện Thoại</label>
                <input name="sdt" type="text" class="form-control" aria-describedby="emailHelp" placeholder="SĐT">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Nhập vào email">
            </div>
        
            <div class="form-group">
                <label>Tên Đăng Nhập</label>
                <input name="username" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label>Mật Khẩu</label>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label>Lương</label>
                <input name="luong" type="password" class="form-control" aria-describedby="emailHelp" placeholder="Nhập vào lương" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" name="AddNhanVien">Lưu</button>
            </div>
         </form>
      </div>
      
    </div>
  </div>
</div>
<!--END Modal Thêm -->




<!-- Modal XEM -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header hoang">
        <h5 class="modal-title" id="exampleModalLabel">Xem Thông Tin Nhân Viên</h5>
        <button style="margin-right: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <form method="post" action="edit_modal.php">
              <div class="form-group" style="display: none;">
                <label>ID</label>
                <input type="text" name="sid" class="form-control" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Họ Và Tên</label>
                <input type="text" class="form-control" name="hoten" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
              </div>
              <div class="form-group">
                    <label for="phongban">Phòng Ban</label>
                    <select class="form-control" name="phongban">
                      <?php 
                                        $sql = "SELECT mapb, tenpb from phongban";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                        // Load dữ liệu lên website
                                        while($row = $result->fetch_assoc()) {
                                        echo            "<option value='".$row["mapb"]."'>" .$row["tenpb"]."</option>";
                                        }
                                    }
                              ?>
                     ?>
                    </select>
                  </div>
            <div class="form-group">
                <label for="diachi">Địa Chỉ</label>
                <input type="text" class="form-control" name="diachi" aria-describedby="emailHelp" placeholder="Số nhà, đường, xã,...">
            </div>

            <div class="form-group">
                <label for="sdt">Số Điện Thoại</label>
                <input type="text" class="form-control" name="sdt" aria-describedby="emailHelp" placeholder="SĐT">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Nhập vào email">
            </div>
        
            <div class="form-group">
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Username">
            </div>

            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="luong">Lương</label>
                <input type="password" class="form-control" name="luong" aria-describedby="emailHelp" placeholder="Nhập vào lương">
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </form>
      </div>
      
    </div>
  </div>
</div>
<!-- End Modal -->

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
