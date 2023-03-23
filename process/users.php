<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');


if(isset($_POST['tambah'])){
    // Parsing Data Untuk Table User
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $level = $_POST['level'];

    // Query untuk tabel users
    $insert_users = mysqli_query($con, "INSERT INTO users (username, password, email, level) VALUES ('$username', '$password', '$email', '$level')");

    if($insert_users){
        $id_users = mysqli_insert_id($con); // Mendapatkan ID terakhir yang dimasukkan ke tabel users

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

        // Query untuk tabel karyawan
        $insert_karyawan = mysqli_query($con, "INSERT INTO karyawan (id_posisi, id_users, nama, nip, no_hp, alamat, umur, mulai_kerja, gaji, status_pegawai) VALUES ('$posisi','$id_users','$nama','$nip','$no_hp','$alamat','$umur','$mulai_kerja','$gaji','$status')");

        // Register user
        if($insert_karyawan){
            $success = 'Berhasil menambahkan data users';
        }else{
            $error = 'Gagal menambahkan data karyawan';
        }
    }else{
        $error = 'Username atau email telah terdaftar!';
    }

    $_SESSION['success'] = isset($success) ? $success : '';
    $_SESSION['error'] = isset($error) ? $error : '';
    header('Location:../?beranda_admin');
}

if(isset($_POST['ubah'])){
    // Parsing Data Untuk Table User
    $id = $_POST['id_karyawan'];
    $username = $data['username'];
    $email = $data['email'];
    $password = password_hash($data['password'],PASSWORD_DEFAULT);
    $level = $data['level'];
    // Parsing Data Untuk Table Pegawai
    $nama = $data['nama'];
    $nip = $data['nip'];
    $no_hp = $data['no_hp'];
    $alamat = $data['alamat'];
    $umur = $data['umur'];
    $mulai_kerja = $data['mulai_kerja'];
    $posisi = $data['posisi'];
    $gaji = $data['gaji'];
    $status = $data['status'];
    $foto = $data['foto'];
    $tentang = $data['tentang'];

    // Query untuk tabel users
    if($password!=""){
        $update = mysqli_query($con, "UPDATE users SET username='$username', email='$email', password='$password', level='$level' WHERE id_users='$id_users'");
    }else{
        $update = mysqli_query($con, "UPDATE users SET email='$email', level='$level' WHERE id_users='$id_users'");
    }

    if($update){
        // Query untuk tabel karyawan
        $update = mysqli_query($con, "UPDATE karyawan SET id_users='$username', id_posisi='$posisi', nama='$nama', nip='$nip', no_hp='$no_hp', alamat='$alamat', umur='$umur', mulai_kerja='$mulai_kerja', gaji='$gaji', status_pegawai='$status', foto='$foto', tentang='$tentang' WHERE id_karyawan='$id'");

        if($update){
            $success = 'Berhasil mengubah data users';
        }else{
            $error = 'Gagal mengubah data karyawan';
        }
    }else{
        $error = 'Gagal mengubah data users';
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