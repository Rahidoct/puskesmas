<?php
function base_url(){
    $base_url= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url.= "://".$_SERVER['HTTP_HOST'];
    $base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    return $base_url;
}

function session_timeout(){
    global $base_url;
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //lama waktu 30 menit = 1800
    if(isset($_SESSION['LAST_ACTIVITY'])&&(time()-$_SESSION['LAST_ACTIVITY']>1800)){
        session_unset();
        session_destroy();
        header("Location:".$base_url."login.php");
    }
    $_SESSION['LAST_ACTIVITY']=time();
}

// call session_timeout() on every page that requires session timeout checks
$base_url = base_url();
session_timeout();

function delMask( $str ) {
    return (int)implode('',explode('.',$str));
}

function hakAkses(array $user) {
    $akses = $_SESSION['level'];
    if (!in_array($akses, $user)) {
        header("Location: ../views/index.php");
        exit;
    }
}


function list_jabatan(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM posisi ORDER BY nama_posisi ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['id_posisi']."\">".$row['nama_posisi']."</option>";
    }  
    return $opt; 
}
function list_pegawai(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM karyawan ORDER BY nama ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['id_karyawan']."\">".$row['nama']."</option>";
    }  
    return $opt; 
}

function bulan($bln){
    $bulan = [
        1 => 'Januari',
             'Februari',
             'Maret',
             'April',
             'Mei',
             'Juni',
             'Juli',
             'Agustus',
             'September',
             'Oktober',
             'November',
             'Desember'
        ];

    return $bulan[$bln];
}
function tahun(){
    return [
        '2020','2021','2022','2023','2024','2025'
    ];
}

function list_pengirim(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM arsip_pengirim ORDER BY nama_pengirim ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['id_pengirim']."\">".$row['nama_pengirim']."</option>";
    }  
    return $opt; 
}

function list_penerima(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM arsip_penerima ORDER BY nama_penerima ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['id_penerima']."\">".$row['nama_penerima']."</option>";
    }  
    return $opt; 
}

function list_merek(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM merek ORDER BY nama_merek ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['idmerek']."\">".$row['nama_merek']."</option>";
    }  
    return $opt; 
}

function list_kategori(){
    include ('conn.php');
    $query = mysqli_query($con,"SELECT * FROM kategori ORDER BY nama_kategori ASC");
    $opt = "";
    while($row = mysqli_fetch_array($query)){
        $opt .= "<option value=\"".$row['idkategori']."\">".$row['nama_kategori']."</option>";
    }  
    return $opt; 
}

function list_barang(){
    include ('conn.php');
    $kategori = mysqli_query($con,"SELECT * FROM kategori ORDER BY nama_kategori ASC");
    $opt = "";
    while($row = mysqli_fetch_array($kategori)){
        $barang = mysqli_query($con,"SELECT x.*,x1.nama_merek FROM barang x JOIN merek x1 ON x1.idmerek=x.merek_id WHERE kategori_id='".$row['idkategori']."' ORDER BY nama_barang ASC");
        $opt .= "<optgroup label=\"".$row['nama_kategori']." | ".$row['keterangan']."\">";
        while($row2 = mysqli_fetch_array($barang)){
            $opt .= "<option value=\"".$row2['idbarang']."\">".$row2['nama_barang']." - ".$row2['nama_merek']."</option>";
        }
        $opt .= "</optgroup>";
    }  
    return $opt; 
}

function encrypt($str) {
return base64_encode($str);
}
function decrypt($str) {
return base64_decode($str);
}

function upload_in()
{
    //deklarasikan variabel kebutuhan
    $namafile   = $_FILES['surat']['name'] ?? null;
    $ukuranfile = $_FILES['surat']['size'] ?? null;
    $error      = $_FILES['surat']['error'] ?? null;
    $tmpname    = $_FILES['surat']['tmp_name'] ?? null;

    //cek apakah yang diupload adalah dokumen surat
    $eksfilevalid = ['pdf', 'docx'];
    $eksfile      = explode('.', $namafile);
    $eksfile      = strtolower(end($eksfile));

    //jika bukan munculkan pesan error
    if (!$namafile || !in_array($eksfile, $eksfilevalid)) {
        return 1;
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($ukuranfile > 1000000){
        return 2; 
    }

    //jika lolos pengecekkan, file siap diupload
    //generate nama file baru    
    $namafilebaru = uniqid() . '.' . $eksfile;
    move_uploaded_file($tmpname, '../assets/file/surat_masuk/' . $namafilebaru);
    return $namafilebaru;
}

function upload_out()
{
    //deklarasikan variabel kebutuhan
    $namafile   = $_FILES['surat']['name'] ?? null;
    $ukuranfile = $_FILES['surat']['size'] ?? null;
    $error      = $_FILES['surat']['error'] ?? null;
    $tmpname    = $_FILES['surat']['tmp_name'] ?? null;

    //cek apakah yang diupload adalah dokumen surat
    $eksfilevalid = ['pdf', 'docx'];
    $eksfile      = explode('.', $namafile);
    $eksfile      = strtolower(end($eksfile));

    //jika bukan munculkan pesan error
    if (!$namafile || !in_array($eksfile, $eksfilevalid)) {
        return 1;
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($ukuranfile > 1000000){
        return 2; 
    }
    
    //jika lolos pengecekkan, file siap diupload
    //generate nama file baru
    $namafilebaru = uniqid() . '.' . $eksfile;
    move_uploaded_file($tmpname, '../assets/file/surat_keluar/' . $namafilebaru);
    return $namafilebaru;
}

function upload_kontrak()
{
    //deklarasikan variabel kebutuhan
    $namafile   = $_FILES['surat']['name'] ?? null;
    $ukuranfile = $_FILES['surat']['size'] ?? null;
    $error      = $_FILES['surat']['error'] ?? null;
    $tmpname    = $_FILES['surat']['tmp_name'] ?? null;

    //cek apakah yang diupload adalah dokumen surat
    $eksfilevalid = ['pdf', 'docx'];
    $eksfile      = explode('.', $namafile);
    $eksfile      = strtolower(end($eksfile));

    //jika bukan munculkan pesan error
    if (!$namafile || !in_array($eksfile, $eksfilevalid)) {
        return 1;
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($ukuranfile > 1000000){
        return 2; 
    }
    
    //jika lolos pengecekkan, file siap diupload
    //generate nama file baru
    $namafilebaru = uniqid() . '.' . $eksfile;
    move_uploaded_file($tmpname, '../assets/file/kontrak_kerja/' . $namafilebaru);
    return $namafilebaru;
}

//persiapan function untuk upload foto profil
function upload_foto()
{
    //deklarasikan variabel kebutuhan
    $namafile   = $file['foto']['name'] ?? null;
    $ukuranfile = $file['foto']['size'] ?? null;
    $error      = $file['foto']['error'] ?? null;
    $tmpname    = $file['foto']['tmp_name'] ?? null;

    //cek apakah yang diupload adalah file/gambar
    $eksfilevalid = ['jpg', 'jpeg', 'png'];
    $eksfile      = explode('.', $namafile);
    $eksfile      = strtolower(end($eksfile));

    //cek apakah yang diupload adalah dokumen surat
    $eksfilevalid = ['pdf', 'docx'];
    $eksfile      = explode('.', $namafile);
    $eksfile      = strtolower(end($eksfile));

    //jika bukan munculkan pesan error
    if (!$namafile || !in_array($eksfile, $eksfilevalid)) {
        return 1;
    }
    //jika file terlalu besar maka munculkan pesan error
    elseif($ukuranfile > 1000000){
        return 2; 
    }
    
    //jika lolos pengecekkan, file siap diupload
    //generate nama file baru
    $namafilebaru = uniqid() . '.' . $eksfile;
    move_uploaded_file($tmpname, '../assets/file/profil_karyawan/' . $namafilebaru);
    return $namafilebaru;
}

function randID()
{
    return rand(1, 99999);
}
?>