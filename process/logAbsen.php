<?php
require 'config/conn.php';
$id_karyawan = $_POST['id_karyawan'];
$status = $_POST['status'];
$date = $_POST['date'];
$time = $_POST['time'];
$sql = mysqli_query($con, "INSERT INTO log_absensi (id_karyawan,date,time,stats) VALUES ('$id_karyawan','$date','$time','$status')");
