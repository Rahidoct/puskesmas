<?php
session_start();
include('../config/conn.php');
include('../config/function.php');

if (isset($_POST['ubah'])) {
    $id = $_POST['id'];

    // Parsing data untuk tabel User
    $id_users = $_POST['id_users'];
    $username = $_POST['username'];
    $email = $_POST['email']; 
    $level = $_POST['level'];

    // Query untuk tabel users
    $update_users = mysqli_query($con, "UPDATE users SET username = '$username', email = '$email', level = '$level' WHERE id_users = (SELECT id_users FROM karyawan WHERE id_karyawan = '$id')");

    if ($update_users) {
        // Parsing Data Untuk Table Karyawan
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $umur = $_POST['umur'];
        $mulai_kerja = $_POST['mulai_kerja'];
        $posisi = $_POST['posisi'];
        $gaji = $_POST['gaji'];
        $status = $_POST['status'];

        // Query untuk tabel karyawan
        $update_karyawan = mysqli_query($con, "UPDATE karyawan SET id_users = '$id_users', id_posisi = '$posisi', nama = '$nama', nip = '$nip', no_hp = '$no_hp', alamat = '$alamat', umur = '$umur', mulai_kerja = '$mulai_kerja', gaji = '$gaji', status_pegawai = '$status' WHERE id_karyawan = '$id'");
        // var_dump($update_karyawan);die;
        if ($update_karyawan) {
            $success = 'Berhasil mengedit data karyawan';
        } else {
            $error = 'Gagal mengedit data karyawan';
        }
    } else {
        $error = 'Gagal mengedit data users';
    }

    $_SESSION['success'] = isset($success) ? $success : '';
    $_SESSION['error'] = isset($error) ? $error : '';
    header('Location:../?beranda_admin');
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
    header('Location:../?beranda_admin');
}

if(decrypt(@$_GET['act'])=='ganti_pass' && isset($_POST['ubah_pass'])){
    $id = $_POST['id'];
    $password =password_hash($_POST['password'],PASSWORD_DEFAULT);

    $update = mysqli_query($con,"UPDATE users SET password='$password' WHERE id_users='$id'") or die (mysqli_error($con));
    $_SESSION['success'] = "Anda berhasil mengubah password";
    echo '<script>window.history.back();</script>';
}

?>