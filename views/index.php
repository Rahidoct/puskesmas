<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Info Absensi</h1>
        <span class="text-gray-800">
            <h4>
                <span id="hours"></span>
                <span id="minutes"></span>
                <span id="seconds"></span>
            </h4>
        </span>
    </div>
    <p class="mb-4 text-black-50-400">Selamat datang, <strong class="text-success"><?= $data['nama'] ?></strong>. | <span class="text-danger"><small>Jangan lupa absen yah !!</small></span></p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-hand-peace"></i></strong> Karyawan yang sudah absen atau belum absen maupun izin akan ditampilkan disini !
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
    // Ambil Tanggal Hari ini
    $date = date("Y-m-d");
    // Ambil data absensi hari ini
    $absenMasuk = mysqli_query($con, "SELECT * FROM log_absensi WHERE date='$date' and stats='Masuk'") or die(mysqli_error($con));
    $jumAbsen = mysqli_num_rows($absenMasuk);
    $absenKeluar = mysqli_query($con, "SELECT * FROM log_absensi WHERE date='$date' and stats='Keluar'") or die(mysqli_error($con));
    $jumKeluar = mysqli_num_rows($absenKeluar);

    $absenIzin = mysqli_query($con, "SELECT * FROM log_absensi WHERE date='$date' and (stats='Izin' OR stats ='Sakit' OR stats='Rapat')") or die(mysqli_error($con));
    $jumIzin = mysqli_num_rows($absenIzin);

    // Belum izin
    // GetAll Absen hari ini
    $belumAbsen = mysqli_query($con, "SELECT * FROM log_absensi WHERE date='$date' AND stats != 'Keluar'") or die(mysqli_error($con));
    $jumAbsensi = mysqli_num_rows($belumAbsen);
    // Total Karyawan
    $karyawan = mysqli_query($con, "SELECT * FROM karyawan WHERE status_pegawai != 'Resign'");
    $totalKaryawan = mysqli_num_rows($karyawan);
    $belAbsen = ($totalKaryawan - $jumAbsensi)


    ?>
    <!-- Content Row Awal -->
    <div class="row">

        <!-- card pns -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                Absen Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumAbsen ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-right-to-bracket fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card pppk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                Absen Pulang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumKeluar ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-right-from-bracket fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card honorer -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                Karyawan Izin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumIzin ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-check-to-slot fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card resign -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-bottom-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-gray-800 text-uppercase mb-1">
                                Belum Absen</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $belAbsen ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-id-card fa-2x text-gray-800"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row Akhir -->

    <!-- Data nominatif pegawai puskesmas -->
    <div class="card shadow mb-4">
        <div class="card-header bg-success d-flex justify-content-between">
            <h6 class="font-weight-bold text-white mt-2">Status absen karyawan hari ini</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive table-sm">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="alert-success text-gray-800">
                        <tr>
                            <th>Nama</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Absen Masuk</th>
                            <th>Absen Pulang</th>
                            <th>Status Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $absenJoin = mysqli_query($con, "SELECT * FROM log_absensi INNER JOIN karyawan ON log_absensi.id_karyawan = karyawan.id_karyawan
                                INNER JOIN users ON karyawan.id_users = users.id_users
                                INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi 
                                WHERE stats != 'Keluar'  and date ='$date'");
                                while ($data = mysqli_fetch_assoc($absenJoin)) {
                    ?>
                        <tr>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['nama_posisi'] ?> </td>
                            <td><?= $data['status_pegawai'] ?> </td>
                            <td><?= ($data['stats'] != "Masuk") ? "-" : $data['date'] . ', ' . $data['time'] ?></td>
                            <?php
                            $keluar = mysqli_query($con, "SELECT date,time FROM log_absensi WHERE date='$date' AND stats= 'Keluar' and id_karyawan = '$data[id_karyawan]'");
                            $dataKeluar = (mysqli_num_rows($keluar) > 0 ? mysqli_fetch_assoc($keluar) : []);
                            ?>
                            <td><?= (count($dataKeluar) > 0) ? $dataKeluar['date'] . ', ' . $dataKeluar['time'] : "-" ?></td>
                            <?php
                            if (count($dataKeluar) > 0) :
                            ?>
                                <td><mark class="badge badge-danger text-white">Pulang</mark></td>
                            <?php else : ?>
                                <td><mark class="<?= ($data['stats'] == 'Masuk') ? 'badge badge-success' : 'badge badge-warning' ?> text-white"><?= $data['stats'] ?></mark></td>

                            <?php endif; ?>
                        </tr>
                    <?php
                    }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.setTimeout("waktu()", 1000)

        function waktu() {
            var waktu = new Date();
            setTimeout("waktu()", 1000);
            document.getElementById("hours").innerHTML = waktu.getHours() + " :";
            let minutes = waktu.getMinutes();
            minutes = minutes <= 9 ? '0' + minutes : minutes;
            document.getElementById("minutes").innerHTML = minutes + " :";
            let seconds = waktu.getSeconds();
            seconds = seconds <= 9 ? '0' + seconds : seconds;
            document.getElementById("seconds").innerHTML = seconds;
        }
    </script>
</div>