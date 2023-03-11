<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- page heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Izin</h1>
    </div>
    <p class="mb-4 text-black-50-400">Karyawan | UPTD Puskesmas Bangodua </p>
    <?php
    $belumAbsen = [];
    $date = date("Y-m-d");
    $karyawan =  mysqli_query($con, "SELECT * FROM karyawan INNER JOIN users ON karyawan.id_users = users.id_users 
                                                            WHERE status_pegawai != 'Resign'");
    while ($data = mysqli_fetch_assoc($karyawan)) {
        $isAbsen = mysqli_query($con, "SELECT * FROM log_absensi WHERE date = '$date' AND id_karyawan ='$data[id_karyawan]'");
        if (mysqli_num_rows($isAbsen) == 0) {
            $push = [
                'id_karyawan' => $data['id_karyawan'],
                'nama' => $data['nama']
            ];
            array_push($belumAbsen, $push);
        }
    }
    ?>

    <div class="card mt-3">
        <div class="card-header bg-success text-white">
            Form input data karyawan izin 
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Pilih Karyawan</label>
                        </div>
                      <select class="custom-select" name="id_karyawan" id="inputGroupSelect01">
                          <option selected value="--nama karyawan--">--nama karyawan--</option>
                        <?php
                        for ($i = 0; $i < count($belumAbsen); $i++) {
                        ?>
                          <option value="<?= $belumAbsen[$i]['id_karyawan'] ?>"><?= $belumAbsen[$i]['nama'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect02">Alasan izin</label>
                        </div>
                        <select class="custom-select" name="stats" id="inputGroupSelect02">
                            <option selected>--Alasan--</option>
                            <option value="Rapat">Rapat</option>
                            <option value="Izin">Cuti</option>
                            <option value="Sakit">Sakit</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" name="bsimpan" value="Simpan">
                <a href="?info_absen" name="bbatal" class="btn btn-danger">Batal</a>
            </form>
        </div>
    </div>
</div>
<?php
    if (isset($_POST['bsimpan'])) {
    $karyawan = $_POST['id_karyawan'];
    $stats = $_POST['stats'];
    $time = Date("H:i:s");
    
    // Simpan data izin
    $save = mysqli_query($con, "INSERT INTO log_absensi (id_karyawan, date, time, stats) VALUES ('$karyawan','$date','$time','$stats')") or die (mysqli_error($con));
        if ($save){
            $success = 'Berhasil menambahkan data';
        }else{
          $error = 'Gagal menambahkan data';
        }
    $_SESSION['success'] = $success;
    $_SESSION['error'] = $error;
    include ('Location:../uabsen.php');
    }
?>