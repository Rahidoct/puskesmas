<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');
//proses tambah
if(isset($_POST['tambah'])){
    $nama_penerima = $_POST['nama_penerima'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    
    $insert = mysqli_query($con,"INSERT INTO arsip_penerima (nama_penerima, no_hp, email, alamat) VALUES ('$nama_penerima', '$no_hp', '$email', '$alamat')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data penerima surat';
    }else{
        $error = 'Yah.. Gagal menambahkan data penerima surat';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?penerima');
}
//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM arsip_penerima WHERE id_penerima='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data penerima surat';
    }else{
        $error = 'Yah... Gagal menghapus data penerima surat';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?penerima');
}

?>