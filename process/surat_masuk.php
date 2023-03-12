<?php
session_start();
include('../config/conn.php');
include('../config/function.php');

if (isset($_POST['tambah'])) {
    $no_surat = $_POST['no_surat'];
    $tgl_surat = $_POST['tgl_surat'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $perihal = $_POST['perihal'];
    $id_pengirim = $_POST['pengirim'];

    $surat = upload_in();

    //cek apakah yang diupload itu file dokumen atau pdf
    //jika bukan munculkan pesan error
    if ($surat == 1) {
        $error = 'Gagal menambahkan data surat masuk yang kamu upload bukan dokumen atau file :(';    
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($surat == 2) {
        $error = 'Gagal menambahkan data surat masuk ukuran file terlalu besar :(';
    }
    //jika benar maka munculkan pesan success
    else{
        $insert = mysqli_query($con, "INSERT INTO surat_masuk (no_surat, tgl_surat, tgl_diterima, perihal, id_pengirim, file) VALUES ('$no_surat','$tgl_surat','$tgl_diterima','$perihal','$id_pengirim','$surat')") or die(mysqli_error($con));
        $success = 'Berhasil menambahkan data surat masuk';
    }

    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_masuk');
}

if (isset($_POST['ubah'])) {
    $id = $_POST['id_arsip_in'];
    $no_surat = $_POST['no_surat'];
    $tgl_surat = $_POST['tgl_surat'];
    $tgl_diterima = $_POST['tgl_diterima'];
    $perihal = $_POST['perihal'];
    $id_pengirim = $_POST['pengirim'];
    $surat = $_FILES['surat']['name'];

    $surat = upload_in();
    $update = mysqli_query($con, "UPDATE surat_masuk SET no_surat='$no_surat', tgl_surat='$tgl_surat', tgl_diterima='$tgl_diterima', perihal='$perihal', id_pengirim='$id_pengirim',  file='$surat' WHERE id_arsip_in='$id'") or die(mysqli_error($con));

    //var_dump($update);die;
    if ($update) {
        $success = 'Berhasil mengubah data surat masuk';
    } else {
        $error = 'Gagal mengubah data surat masuk';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_masuk');
}

if (decrypt($_GET['act']) == 'delete' && isset($_GET['id']) != "") {
    // echo $_GET['act'];die;
    $id = decrypt($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM surat_masuk WHERE id_arsip_in='$id'") or die(mysqli_error($con));
    if ($delete) {
        $success = "Data surat masuk berhasil dihapus";
    } else {
        $error = "Data surat masuk gagal dihapus";
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?surat_masuk');
}