<?php
session_start();
include ('../config/conn.php');
include ('../config/function.php');

if(isset($_POST['ubah'])){
   $about      = $_POST['about'];
   $id_users   = $_POST['id_users'];
   $nama       = $_FILES['foto']['name'];
   $size       = $_FILES['foto']['size'];
   $error      = $_FILES['foto']['error'];
   $asal       = $_FILES['foto']['tmp_name'];

   $lokasi_foto = upload_foto();
   $update = mysqli_query($con,"UPDATE karyawan SET foto = '$lokasi_foto', tentang = '$about' where id_users = '$id_users'") or die (mysqli_error($con));

   //var_dump($update);die;
   if($update){
       $success = 'Berhasil mengubah profil';
   }else{
       $error = 'Gagal mengubah profil';
   }
   $_SESSION['success'] = $success;
   $_SESSION['error'] = $error;
   header('Location:../?profil_admin');
}
?>