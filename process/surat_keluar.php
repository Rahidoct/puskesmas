<?php
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['tambah'])){
    $no_surat = $_POST['no_surat'];
    $tgl_surat = $_POST['tgl_surat'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $perihal = $_POST['perihal'];
    $id_penerima = $_POST['penerima'];

    $surat = upload_out();

    //cek apakah yang diupload itu file dokumen atau pdf
    //jika bukan munculkan pesan error
    if ($surat == 1) {
        $error = 'Gagal menambahkan data surat keluar yang kamu upload bukan dokumen atau file :(';    
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($surat == 2) {
        $error = 'Gagal menambahkan data surat keluar ukuran file terlalu besar :(';
    }
    //jika benar maka munculkan pesan success
    else{
        $insert = mysqli_query($con,"INSERT INTO surat_keluar (no_surat, tgl_surat, tgl_diterima, perihal, id_penerima, file) VALUES ('$no_surat','$tgl_surat','$tgl_diterima','$perihal','$id_penerima','$surat')") or die (mysqli_error($con));
        $success = 'Berhasil menambahkan data surat keluar';
    }

    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_keluar');
}

if(isset($_POST['ubah'])){
    $id = $_POST['id_arsip_out'];
    $no_surat = $_POST['no_surat'];
    $tgl_surat = $_POST['tgl_surat'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $perihal = $_POST['perihal'];
    $id_penerima = $_POST['penerima'];
    $surat = $_FILES['surat']['name'];

    $surat = upload_out();
    $update = mysqli_query($con,"UPDATE surat_keluar SET no_surat='$no_surat', tgl_surat='$tgl_surat', tgl_diterima='$tgl_diterima', perihal='$perihal', id_penerima='$id_penerima', file='$surat' WHERE id_arsip_out='$id'") or die (mysqli_error($con));
    
    // var_dump($update);die;
    if($update){
        $success = 'Berhasil mengubah data surat keluar';
    }else{
        $error = 'Gagal mengubah data surat keluar';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_keluar');
}

if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    // echo $_GET['act'];die;
    $id = decrypt($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM surat_keluar WHERE id_arsip_out='$id'")or die(mysqli_error($con));
    if ($delete) {
        $success = "Data surat keluar berhasil dihapus";
    }else{
        $error = "Data surat keluar gagal dihapus";
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_keluar');
}
?>