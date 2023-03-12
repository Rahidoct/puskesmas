<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['tambah'])){
    $id_karyawan = $_POST['nama'];
    $id_posisi = $_POST['nama_posisi'];
    $no_kontrak = $_POST['no_kontrak'];
    $tgl_kontrak = $_POST['tgl_kontrak'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $tahun = $_POST['tahun'];

    $surat = upload_kontrak();

    //cek apakah yang diupload itu file dokumen atau pdf
    //jika bukan munculkan pesan error
    if ($surat == 1) {
        $error = 'Gagal menambahkan kontrak kerja yang kamu upload bukan dokumen atau file :(';    
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($surat == 2) {
        $error = 'Gagal menambahkan kontrak kerja ukuran file terlalu besar :(';
    }
    //jika benar maka munculkan pesan success
    else{
        $insert = mysqli_query($con,"INSERT INTO kontrak (id_karyawan, id_posisi, no_kontrak, tgl_kontrak, tgl_selesai, tahun, file) VALUES ('$id_karyawan','$id_posisi','$no_kontrak','$tgl_kontrak','$tgl_selesai','$tahun','$surat')") or die (mysqli_error($con));
        $success = 'Berhasil menambahkan data kontrak kerja';
    }

    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?dok_kontrak_kerja');
}

if(isset($_POST['ubah'])){
    $id = $_POST['id_kontrak'];
    $id_karyawan = $_POST['nama'];
    $id_posisi = $_POST['nama_posisi'];
    $no_kontrak = $_POST['no_kontrak'];
    $tgl_kontrak = $_POST['tgl_kontrak'];
    $tgl_selesai = $_POST['tgl_selesai'];
    $tahun = $_POST['tahun'];
    $surat = $_FILES['surat']['name'];

    $surat = upload_kontrak();
    $update = mysqli_query($con,"UPDATE kontrak SET id_karyawan='$id_karyawan', id_posisi='$id_posisi', no_kontrak='$no_kontrak', tgl_kontrak='$tgl_kontrak', tgl_selesai='$tgl_selesai', tahun='$tahun',  file='$surat' WHERE id_kontrak='$id'") or die (mysqli_error($con));

    //var_dump($update);die;
    if($update){
        $success = 'Berhasil mengubah data surat masuk';
    }else{
        $error = 'Gagal mengubah data surat masuk';
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?dok_kontrak_kerja');
}

if(decrypt($_GET['act'])=='delete' && isset($_GET['id'])!=""){
    // echo $_GET['act'];die;
    $id = decrypt($_GET['id']);
    $delete = mysqli_query($con, "DELETE FROM kontrak WHERE id_kontrak='$id'")or die(mysqli_error($con));
    if ($delete) {
        $success = "Data surat masuk berhasil dihapus";
    }else{
        $error = "Data surat masuk gagal dihapus";
    }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    header('Location:../?dok_kontrak_kerja');
}
?>