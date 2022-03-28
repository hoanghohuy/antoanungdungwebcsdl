<?php
require 'connectdatabase.php';
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$site_key    = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$secret_key  = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
session_start();
 if(isset($_POST["login"])) {
 //khai báo mảng error chứa lỗi
   $errors = [];
   $username = htmlspecialchars($conn->real_escape_string($_POST["username"]),ENT_QUOTES);
   $password = htmlspecialchars($conn->real_escape_string($_POST["password"]),ENT_QUOTES);
   // kiem tra da nhap vao username chua
   if(empty(trim($_POST['username']))) {
      $errors['username']['required'] = 'Tên đăng nhập không được bỏ trống!';
   }
   // kiem tra da nhap vao password chua
  if(empty(trim($_POST['password']))) {
     $errors['password']['required'] = 'Mật khẩu không được bỏ trống!';
  }
  // kiem tra da xac minh captcha chua
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
          // chống SQL Injection = real_escape_string...
          // chống XSS bằng hàm htmspecialchars()...
          $user = htmlspecialchars($conn->real_escape_string($_POST["username"]),ENT_QUOTES);
          $pass = htmlspecialchars($conn->real_escape_string($_POST["password"]),ENT_QUOTES);
          // cau query
          $sql_login = "SELECT username, password FROM `nhanvien` WHERE `USERNAME` = '$user' and `PASSWORD` = md5($pass)";
          $result = mysqli_query($conn,$sql_login);
          $row = mysqli_fetch_assoc($result);
          if($row) {
            $_SESSION["username"] = $user;
            header("Location: profile.php");
          }
          else
          $errors['login']['required'] = 'Thông tin tài khoản hoặc mật khẩu không chính xác!';
          }
      }
    }

    // 
    if(isset($_POST["forgot-pass"])) {
      header("Location: forgot.php");
    }
    if(isset($_POST["change-pass"])) {
      header("Location: change-pass.php");
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
    <input type="password" name="password" placeholder="Password" value="<?php echo (!empty($_POST['password']))?$_POST['password']:false; ?>">
    <?php 
      if(!empty($errors['password']['required'])) {
      echo "<span style='color: red;'>".$errors['password']['required']."</span>";
        }
    ?>
    <div class="g-recaptcha" style="margin: 20px 16%;" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
    <?php 
      if(!empty($errors['recaptcha']['required'])) {
      echo "<span style='color: red;'>".$errors['recaptcha']['required']."</span>";
        }
    ?>
    <input type="submit" value="Login" name="login">
    <?php 
      if(!empty($errors['login']['required'])) {
      echo "<span style='color: red;'>".$errors['login']['required']."</span>";
        }
    ?>
    <div class="forgot-form">
      <input type="submit" value="Quên mật khẩu" name="forgot-pass">
      <input type="submit" value="Đổi mật khẩu" name="change-pass">
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