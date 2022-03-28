<?php
$api_url     = 'https://www.google.com/recaptcha/api/siteverify';
$site_key    = '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI';
$secret_key  = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
session_start();
 if(isset($_POST["forgot-pass"])) {
 //khai báo mảng error chứa lỗi
   $errors = [];
   $email = $_POST["email"];
   // kiem tra da nhap vao email chua
   if(empty(trim($_POST['email']))) {
      $errors['email']['required'] = 'Vui lòng nhập vào email!';
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
          // chống XSS = bằng hàm lọc htmlspecialchars...
          $email = htmlspecialchars($conn->real_escape_string($_POST["email"]),ENT_QUOTES);
          $result = mysqli_query($conn,"SELECT username FROM `nhanvien` WHERE `EMAIL` = '$email'");
          $row = mysqli_fetch_assoc($result);
          if($row) {
          $matkhau = rand(0,999999);
          // ma hoa mat khau bang ham ma hoa md5
          $result = mysqli_query($conn,"UPDATE nhanvien SET `PASSWORD` = md5($matkhau) WHERE `EMAIL` = '$email'");
          require 'function.php';
          GuiMatKhauMail($email, $matkhau);
          $errors['login']['required'] = 'Thành công! Mật khẩu mới đã gửi về Email !';
          }
          else
          $errors['login']['required'] = 'Email không tồn tại!';
          }
      }
    }

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
  <input type="text" name="email" placeholder="Nhập vào email..." value="<?php echo (!empty($_POST['username']))?$_POST['username']:false; ?>">
  <?php 
    if(!empty($errors['email']['required'])) {
    echo "<span style='color: red;'>".$errors['email']['required']."</span>";
      }
  ?>
  <div class="g-recaptcha" style="margin: 20px 16%;" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
  <?php 
      if(!empty($errors['recaptcha']['required'])) {
      echo "<span style='color: red;'>".$errors['recaptcha']['required']."</span>";
        }
    ?>
  <input type="submit" value="Quên Mật Khẩu" name="forgot-pass">
  <?php 
    if(!empty($errors['login']['required'])) {
    echo "<span style='color: red;'>".$errors['login']['required']."</span>";
      }
  ?>
  <input type="submit" value="Quay lại" name="back">

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