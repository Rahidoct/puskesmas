<!-- Begin Page Content -->
<div class="container-fluid">    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Rekap Absensi</h1>
    </div>
    <p class="mb-4 text-black-50-400">Sistem Absensi Qr-Code | UPTD Puskesmas Bangodua </p>
    <div class="container-fluid">
        <form method="POST">
            <div class="row ">
                <div class="col-5">
                    <div class="form-group">
                        <input type="date" class="form-control" id="awal" name="awal" placeholder="Tanggal Awal">
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <input type="date" class="form-control" id="akhir" name="akhir" placeholder="Tanggal Akhir">
                    </div>
                </div>
                <div class="col-2">
                    <input type="submit" value="Cari" name="cari" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['cari'])) {
        $karyawan_absensi = [];
        $awal = $_POST['awal'];
        $akhir = $_POST['akhir'];
        $date_awal = date_create($awal);
        $date_akhir = date_create($akhir);
        $diff = date_diff($date_awal, $date_akhir);
        $jumlah_hari = $diff->format("%d%");

        $mysql_karyawan = mysqli_query($con, 'SELECT * from karyawan INNER JOIN users ON karyawan.id_users = users.id_users');
        while ($data = mysqli_fetch_assoc($mysql_karyawan)) {
            $mysql_masuk = mysqli_query($con, "select count(*) as masuk from log_absensi where id_karyawan = '$data[id_karyawan]' AND stats = 'Masuk' AND date between '$awal' AND '$akhir'");
            $mysql_izin = mysqli_query($con, "select count(*) as izin from log_absensi where id_karyawan = '$data[id_karyawan]' AND stats = 'Izin' AND date between '$awal' AND '$akhir'");
            $mysql_sakit = mysqli_query($con, "select count(*) as sakit from log_absensi where id_karyawan = '$data[id_karyawan]' AND stats = 'Sakit' AND date between '$awal' AND '$akhir'");
            $masuk = mysqli_fetch_assoc($mysql_masuk);
            $izin = mysqli_fetch_assoc($mysql_izin);
            $sakit = mysqli_fetch_assoc($mysql_sakit);

            $kar_absen = [
                'nama' => $data['nama'],
                'masuk' => $masuk['masuk'],
                'sakit' => $sakit['sakit'],
                'izin' => $izin['izin'],
            ];
            $karyawan_absensi[] = $kar_absen;
        }
    }
    ?>

    <!-- Data nominatif pegawai puskesmas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-success d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-white">Rekap Absen Karyawan Puskesmas Bangodua</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="alert-success text-gray-800">
                        <tr>
                            <th>Nama</th>
                            <th>Jumlah Masuk</th>
                            <th>Jumlah Sakit</th>
                            <th>Jumlah Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['cari'])) {
                            for ($i = 0; $i < count($karyawan_absensi); $i++) {

                        ?>
                                <tr>
                                    <td><?= $karyawan_absensi[$i]['nama'] ?></td>
                                    <td><?= $karyawan_absensi[$i]['masuk'] ?> Hari</td>
                                    <td><?= $karyawan_absensi[$i]['sakit'] ?> Hari</td>
                                    <td><?= $karyawan_absensi[$i]['izin'] ?> Hari</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">Pilih ingin rekap tanggal berapa</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>