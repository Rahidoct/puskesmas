<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');
//proses tambah
if(isset($_POST['tambah'])){
    $nama_pengirim = $_POST['nama_pengirim'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    
    $insert = mysqli_query($con,"INSERT INTO arsip_pengirim (nama_pengirim, no_hp, email, alamat) VALUES ('$nama_pengirim', '$no_hp', '$email', '$alamat')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data pengirim surat';
    }else{
        $error = 'Yah.. Gagal menambahkan data pengirim surat';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?pengirim');
}
//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM arsip_pengirim WHERE id_pengirim='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data pengirim surat';
    }else{
        $error = 'Yah... Gagal menghapus data pengirim surat';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?pengirim');
}

?>