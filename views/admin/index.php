<?php $now = date('Y-m-d'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Beranda</h1>
    </div>
    <p class="mb-4 text-black-50-400">
        <script> 
            var h=(new Date()).getHours();
            var m=(new Date()).getMinutes();
            var s=(new Date()).getSeconds();
            if (h >= 4 && h < 10) document.writeln("Selamat Pagi,");
            if (h >= 10 && h < 15) document.writeln("Selamat Siang,");
            if (h >= 15 && h < 18) document.writeln("Selamat Sore,");
            if (h >= 18 || h < 4) document.writeln("Selamat Malam,");
        </script> 
        <strong class="text-success"><?= $data['nama'] ?>.</strong> | Admin UPTD Puskesmas Bangodua </p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i> !</strong> Anda dapat menggunakan menu-menu navigasi yang tersedia untuk memasukan beberapa data yang diperlukan.
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <!-- Content Row Awal -->
    <div class="row">
        <?php
        // Hitung PNS
        $sqlPNS = mysqli_query($con, "SELECT count(*) as PNS FROM karyawan WHERE status_pegawai = 'PNS'");
        $resPNS = mysqli_fetch_assoc($sqlPNS);
        // P3K
        $sqlP3K = mysqli_query($con, "SELECT count(*) as PPPK FROM karyawan WHERE status_pegawai = 'PPPK'");
        $resP3K = mysqli_fetch_assoc($sqlP3K);
        // Honor
        $sqlHonor = mysqli_query($con, "SELECT count(*) as Honorer FROM karyawan WHERE status_pegawai = 'Honorer'");
        $resHonor = mysqli_fetch_assoc($sqlHonor);
        // Resign
        $sqlResing = mysqli_query($con, "SELECT count(*) as Resign FROM karyawan WHERE status_pegawai = 'Resign'");
        $resResign = mysqli_fetch_assoc($sqlResing);

        ?>
        <!-- card pns -->
        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
            <div class="card bg-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1" href="?halaman=pns">
                                Pegawai Negeri</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $resPNS['PNS'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-id-card fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card pppk -->
        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1" href="?halaman=pppk">
                                Karyawan PPPK</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $resP3K['PPPK'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-check-to-slot fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card honorer -->
        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1" href="?halaman=honorer">
                                Honorer</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $resHonor['Honorer'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-right-to-bracket fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card resign -->
        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Resign</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $resResign['Resign'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-right-from-bracket fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row Akhir -->

    <!-- Data nominatif pegawai puskesmas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-success">
            <h6 class="m-0 font-weight-bold text-white">Data Nominatif Karyawan Puskesmas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table cellspacing="0" id="example" class="table display responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Mulai Bekerja</th>
                            <th scope="col">Status Pegawai</th>
                            <th scope="col">Gaji</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $n=1;
                        //    Get All Karyawan
                        $mysql = mysqli_query($con, "SELECT * FROM karyawan INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi 
                                                                            INNER JOIN users ON karyawan.id_users = users.id_users");
                        while ($data = mysqli_fetch_assoc($mysql)) {
                        //    var_dump($mysql);
                        ?>
                            <tr>
                                <td><?= $n++; ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['nama_posisi'] ?></td>
                                <td><?= $data['umur'] ?></td>
                                <td><?= $data['mulai_kerja'] ?></td>
                                <td><?= $data['status_pegawai'] ?></td>
                                <td><?= "Rp." . number_format($data['gaji']) ?></td>
                                <td>
                                    <small class="btn btn-sm">
                                        <a href="<?=base_url();?>/process/users.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['id_users']);?>" class="btn btn-danger btn-icon-split btn-sm btn-hapus">
                                            <span class="icon text-white">
                                                <i class="fas fa-right-from-bracket"></i>
                                            </span>
                                            <span class="text">Resign</span>
                                        </a>
                                    </small>
                                </td>
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
<!-- /.container-fluid -->