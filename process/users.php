<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['tambah'])){
    // Parsing Data Untuk Table User
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = 'admin';
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $level = $_POST['level'];
    // Parsing Data Untuk Table Pegawai
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $umur = $_POST['umur'];
    $mulai_kerja = $_POST['mulai_kerja'];
    $posisi = $_POST['posisi'];
    $gaji = $_POST['gaji'];
    $status = $_POST['status'];

    // Register user
    $cek = mysqli_query($con,"SELECT * FROM users WHERE username='$username'") or die(mysqli_error($con));
    if(mysqli_num_rows($cek)==0){
        $insert = mysqli_query($con, "INSERT INTO users (id_users, email, username, password, level) VALUES ('$id','$email','$username','$password','$level')");
        $last_id = mysqli_insert_id($con);
        $insert .=  mysqli_query($con, "INSERT INTO karyawan (id_posisi, id_users, nama, nip, no_hp, alamat, umur, mulai_kerja, gaji, status_pegawai) VALUES ('$posisi','$last_id','$nama','$nip','$no_hp','$alamat','$umur','$mulai_kerja','$gaji','$status')");
        if($insert){
            $success = 'Berhasil menambahkan data users';
        }else{
            $error = 'Gagal menambahkan data users';
        }
    }else{
        $error = 'Username telah terdaftar !';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?penguna');
    // echo $insert;
}
if(isset($_POST['ubah'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    if($password!=""){
        $update = mysqli_query($con,"UPDATE users SET email='$email', password='".password_hash($password,PASSWORD_DEFAULT)." WHERE id_users='$id'") or die (mysqli_error($con));
    }else{
        $update = mysqli_query($con,"UPDATE users SET email='$email' WHERE id_users='$id'") or die (mysqli_error($con));
    }
    if($update){
        $success = 'Berhasil mengubah data users';
    }else{
        $error = 'Gagal mengubah data users';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
     header('Location:../?penguna');
}

if(decrypt(@$_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM users WHERE id_users='$id'")or die(mysqli_error($con));
    if ($delete) {
        $success = "Data users berhasil dihapus";
    }else{
        $error = "Data users gagal dihapus";
    }
    $_SESSION['success'] = $success;
    header('Location:../?penguna');
}

if(decrypt(@$_GET['act'])=='ganti_pass' && isset($_POST['ubah_pass'])){
    $id = $_POST['id'];
    $password =password_hash($_POST['password'],PASSWORD_DEFAULT);

    $update = mysqli_query($con,"UPDATE users SET password='$password' WHERE id_users='$id'") or die (mysqli_error($con));
    $_SESSION['success'] = "Anda berhasil mengubah password";
    echo '<script>window.history.back();</script>';
}

?>