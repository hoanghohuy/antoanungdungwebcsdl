<?php
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$site_key    = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$secret_key  = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
session_start();
 if(isset($_POST["doimatkhau"])) {
   require 'connectdatabase.php';
 //khai báo mảng error chứa lỗi
   $errors = [];
   $username = htmlspecialchars($conn->real_escape_string($_POST["username"]),ENT_QUOTES);
   $password = htmlspecialchars($conn->real_escape_string($_POST["password"]),ENT_QUOTES);
   $new_password = htmlspecialchars($conn->real_escape_string($_POST["new_password"]),ENT_QUOTES);
   $renew_password = htmlspecialchars($conn->real_escape_string($_POST["renew_password"]),ENT_QUOTES);
   // kiem tra da nhap vao username chua
   if(empty(trim($_POST['username']))) {
      $errors['username']['required'] = 'Tên đăng nhập không được bỏ trống!';
   }
   // kiem tra da nhap vao password chua
  if(empty(trim($_POST['password']))) {
     $errors['password']['required'] = 'Mật khẩu không được bỏ trống!';
  }
  //kiem tra da nhap password moi chua
  if(empty(trim($_POST['new_password']))) {
     $errors['new_password']['required'] = 'Vui Lòng không được bỏ trống!';
  }
  //kiem tra da nhap lai password moi chua
  if(empty(trim($_POST['renew_password']))) {
     $errors['renew_password']['required'] = 'Vui Lòng không được bỏ trống!';
  }
  if ($new_password != $renew_password) {
  	$errors['renew_password']['required'] = 'Không trùng mật khẩu!';
  }


    $site_key_post    = $_POST['g-recaptcha-response'];
    if (empty($site_key_post)) {
      $errors['recaptcha']['required'] = 'Vui lòng xác minh mã Captcha!';
    }
    //lấy IP của khach
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $remoteip = $_SERVER['REMOTE_ADDR'];
    }
      
    //tạo link kết nối
    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
    //lấy kết quả trả về từ google
    $response = file_get_contents($api_url);
    //dữ liệu trả về dạng json
    $response = json_decode($response);
    if($response->success == true)
    {
        if(empty($errors)) {
          require_once 'connectdatabase.php';
          // chống SQL Injection = bằng hàm lọc real_escape_string...
          // chống XSS bằng hàm lọc htmlspecialchars()...
          $user = htmlspecialchars($conn->real_escape_string($_POST["username"]),ENT_QUOTES);
          $pass = htmlspecialchars($conn->real_escape_string($_POST["renew_password"]),ENT_QUOTES);
          $sel_nv = mysqli_query($conn,"SELECT username FROM `nhanvien` WHERE `USERNAME` = '$user'");
          $row = mysqli_fetch_assoc($sel_nv);
          if($row) {
          $sql = "UPDATE nhanvien SET password= md5($pass) WHERE `USERNAME` = '$user'";
          $result = $conn->query($sql);
          if($result == true) {
           $errors['login']['required'] = 'Đổi mật khẩu thành công!';
          }
          else { $errors['login']['required'] = 'Có lỗi xảy ra. Hãy thử lại sau!'; }
                  }
          else {
            $errors['login']['required'] = 'Tài khoản không tồn tại hoặc sai mật khẩu !';
          }
            
        }
      }
    }

    // 
    if(isset($_POST["back"])) {
      header("Location: index.php");
     }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quản Lý Nhân Viên</title>
    <link rel="stylesheet" type="text/css" href="assets/css/auth.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="icon" type="image/png" href="assets/img/new_logo.png">
  </head>
  <body>
<form class="box" method="POST">
    <h1>Quản Lý Nhân Viên</h1>
    <input type="text" name="username" placeholder="Username" value="<?php echo (!empty($_POST['username']))?$_POST['username']:false; ?>">
    <?php 
      if(!empty($errors['username']['required'])) {
      echo "<span style='color: red;'>".$errors['username']['required']."</span>";
        }
    ?>
    <input type="password" name="password" placeholder="Mật khẩu cũ" value="<?php echo (!empty($_POST['password']))?$_POST['password']:false; ?>">
    <?php 
      if(!empty($errors['password']['required'])) {
      echo "<span style='color: red;'>".$errors['password']['required']."</span>";
        }
    ?>
    <input type="password" name="new_password" placeholder="Mật khẩu mới" value="<?php echo (!empty($_POST['new_password']))?$_POST['new_password']:false; ?>">
    <?php 
      if(!empty($errors['new_password']['required'])) {
      echo "<span style='color: red;'>".$errors['new_password']['required']."</span>";
        }
    ?>
	<input type="password" name="renew_password" placeholder="Nhập lại mật khẩu mới" value="<?php echo (!empty($_POST['renew_password']))?$_POST['renew_password']:false; ?>">
	<?php 
      if(!empty($errors['renew_password']['required'])) {
      echo "<span style='color: red;'>".$errors['renew_password']['required']."</span>";
        }
    ?>
    <div class="g-recaptcha" style="margin: 20px 16%;" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
    <?php 
      if(!empty($errors['recaptcha']['required'])) {
      echo "<span style='color: red;'>".$errors['recaptcha']['required']."</span>";
        }
    ?>
    <input type="submit" value="Đổi mật khẩu" name="doimatkhau">
    <?php 
      if(!empty($errors['login']['required'])) {
      echo "<span style='color: red;'>".$errors['login']['required']."</span>";
        }
    ?>
    <div class="forgot-form">
      <input type="submit" value="Quay lại" name="back">
    </div>
    
    <div class="register_link">
    <h4 style="color: white;">Bạn chưa có tài khoản? <a style="color: white;" href="">Đăng ký ngay!</a></h4>
    </div>
</form>
<style>
  .forgot-form {
    display: flex;
  }
</style>
  </body>
</html>