<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

//proses tambah
if(isset($_POST['tambah'])){
    $nama_posisi = $_POST['nama_posisi'];
    
    $insert = mysqli_query($con,"INSERT INTO posisi (nama_posisi) VALUES ('$nama_posisi')") or die (mysqli_error($con));
    if($insert){
        $success = 'Berhasil menambahkan data jabatan';
    }else{
        $error = 'Gagal menambahkan data jabatan';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?posisi_jabatan');
}

//proses hapus
if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    $id = decrypt($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM posisi WHERE id_posisi='$id'")or die(mysqli_error($con));
    if($query){
        $success = 'Berhasil menghapus data jabatan';
    }else{
        $error = 'Gagal menghapus data jabatan';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?posisi_jabatan');
}
?>