<?php 
// mengaktifkan session login pada php
session_start();

// menghubungkan php dengan koneksi database
include ('config/conn.php');
$base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

if(isset($_POST['cek_login'])){
    // menangkap data yang dikirim dari form login
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // cek apakah pengguna sudah memasukan username dan password?
    if(empty($username) || empty($password)){
    // jika belum maka tampilkan pesan
    $error = 'Harap isi username dan password';
}else{
    // menyeleksi data user dengan username yang sesuai
    $user = mysqli_query($con,"SELECT * FROM users INNER JOIN karyawan ON karyawan.id_users = users.id_users WHERE username='$username'") or die(mysqli_error($con));
    if(mysqli_num_rows($user)!=0){
        $data = mysqli_fetch_array($user);
            if(password_verify($password,$data['password'])){
                $_SESSION['id_users'] = $data['id_users'];
                $_SESSION['username'] = $data['username'];
                $_SESSION['fullname'] = $data['nama'];
                $_SESSION['level'] = $data['level'];
                $_SESSION['success'] = 'Login berhasil';
                header("Location:".$base_url);
                exit;
            }else{
                // jika password salah maka tampilkan pesan
                $error = 'Kayaknya password kamu salah deh. !!';
            }
    }else{
        // jika username salah maka tampilkan pesan
        $error= 'Sepertinya username kamu tidak terdaftar. :(';
    }
}
$_SESSION['error'] = $error;

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Login Karyawan</title>

    <!-- Custom fonts for this template-->
    <link href="<?= $base_url; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= $base_url; ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-5 col-lg-6 col-md-8">


                <div class="card bg-light o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="col-lg-12">
                            <div class="p-3">
                                <div class="text-center">
                                    <img src="<?=$base_url;?>assets/img/logo.png" class="mb-3" width="100px" height="100px">
                                    <h1 class="h4 text-gray-900">Selamat Datang !</h1>
                                    <center>
                                        <p>Karyawan | <a href='https://puskesmasbangodua.com' target='_blank'>UPTD Puskesmas Bangodua</a></p>
                                    </center><hr class="mb-4">    
                                </div>
                                <!-- Cek Login -->
                                <?php if(isset($_SESSION['success'])):?>
                                <div class="flash-data-berhasil" data-berhasil="<?= $_SESSION['success']; ?>"></div>
                                <?php endif; unset($_SESSION['success']);?>
                                <?php if(isset($_SESSION['error'])):?>
                                <div class="flash-data-gagal" data-gagal="<?= $_SESSION['error']; ?>"></div>
                                <?php endif; unset($_SESSION['error']);?>
                                <!-- Akhir Cek Login -->

                                <form class="user" method="post" action="">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user" placeholder="Masukkan username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Masukkan password">
                                    </div>
                                    <div class="form-group custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">ingat saya ?</label>
                                    </div>
                                    <hr>                
                                    <button type="submit" class="btn btn-primary btn-user btn-block" name="cek_login">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=$base_url;?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=$base_url;?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$base_url;?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?=$base_url;?>assets/vendor/sweet-alert/sweetalert2.all.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$base_url;?>assets/js/sb-admin-2.min.js"></script>
    <script src="<?=$base_url;?>assets/js/demo/sweet-alert.js"></script>

</body>

</html>