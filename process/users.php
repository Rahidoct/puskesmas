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