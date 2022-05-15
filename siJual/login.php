<?php
include "include/config.php";
include "include/lib.php";
include "include/koneksi.php";
//kalo udah login, gak perlu login lagi
if(is_login()){
  header("Location:dashboard.php");
}
//cek apakah tombol login diklik
if(isset($_POST['login'])){
  //ambil inputan user
    $user = sanitasi_input($_POST['user']);
    $pass = md5(sanitasi_input($_POST['pass']));
   //cek database
    //fitur tanpa remember me
  $sql = "SELECT * FROM user WHERE username='$user' && password='$pass'";
  
  $result = mysqli_query($koneksi,$sql);
  $row = mysqli_num_rows($result);
  //jika data ada
  if($row>0){
      $sql = mysqli_query($koneksi,"SELECT * FROM user WHERE username='$user'");
      $data = mysqli_fetch_assoc($sql);
      //buat session
      $_SESSION['username'] = $data['username'];
      $_SESSION['nama'] = $data['name'];
      $_SESSION['role'] = $data['role'];
      $_SESSION["is_login"] = true;
      
       //jika remember me diklik
      if(!empty($_POST["remember"])) {
          //buat cookie untuk 1 minggu
          setcookie ("userlogin",$user,time()+ (3600 * 7));
      } else {
        if(isset($_COOKIE["userlogin"])) {
           setcookie ("userlogin","");
          }
      }
      header("Location:dashboard.php");
  }else{
    $error = "Username atau Password Salah";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Sijual</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo PLUGIN_URL?>fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo PLUGIN_URL?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo CSS_URL?>adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Sijual</b></a>
    </div>
    <?php
      if(isset($error)){
        echo "<div class='alert alert-danger text-center'>$error</div>";
      }
    ?>
    <div class="card-body">
      <p class="login-box-msg">Silakan login</p>

      <form action="" method="post" name="frmlogin">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="user">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="pass">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input value='Login' name='login' type="submit" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo PLUGIN_URL?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PLUGIN_URL?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo JS_URL?>adminlte.min.js"></script>
</body>
</html>
