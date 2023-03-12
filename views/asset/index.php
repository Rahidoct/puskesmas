<?php hakAkses(['asset']); $now = date('Y-m-d'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Beranda </h1>
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
    <strong class="text-success"><?= $_SESSION['fullname'] ?>.</strong> | Pengelolah Aset UPTD Puskesmas Bangodua </p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i> !</strong> Anda dapat menggunakan menu-menu navigasi yang tersedia untuk memasukan beberapa data yang diperlukan.
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <?php
        // Hitung data aktiva atau aset
        $sqlAset = mysqli_query($con, "SELECT count(*) as id_aset FROM inventaris WHERE id_aset = ''");
        $cekAset = mysqli_fetch_assoc($sqlAset);
        // Hitung barang masuk
        $sqlIn = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM barang_masuk WHERE jumlah > 0 GROUP BY MONTH(tanggal)");
        $cekIn = mysqli_fetch_assoc($sqlIn);
        // Hitung barang keluar
        $sqlOut = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM barang_keluar WHERE jumlah > 0 GROUP BY MONTH(tanggal)");
        $cekOut = mysqli_fetch_assoc($sqlOut);
        // Hitung sisa stok barang
        $sqlStok = mysqli_query($con, "SELECT COUNT(*) AS stok FROM barang WHERE stok > 0");
        $cekStok = mysqli_fetch_assoc($sqlStok);
    ?>
    <!-- row laporan stok barang dan aset -->
    <div class="row">
        <!-- aset tetap -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Aset Tetap</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $cekAset['id_aset'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-house-circle-check fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- barang masuk-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Barang Masuk</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $cekIn['jumlah'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-people-carry-box fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- barang keluar -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Barang Keluar</a>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $cekOut['jumlah'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-truck-ramp-box fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- sisa stok -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                                Sisa Stok Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-white"><?= $cekStok['stok'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-layer-group fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir row laporan stok barang dan aset -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="float-left">Barang Masuk Hari Ini</h4>
            <a href="<?=base_url();?>process/cetak_barang_masuk_today.php" target="_blank"
                class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA BARANG</th>
                            <th>MEREK</th>
                            <th>KATEGORI</th>
                            <th>KETERANGAN</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT x.*,x1.nama_barang,x2.nama_merek,x3.nama_kategori FROM barang_masuk x JOIN barang x1 ON x1.idbarang=x.barang_id JOIN merek x2 ON x2.idmerek=x1.merek_id JOIN kategori x3 ON x3.idkategori=x1.kategori_id WHERE x.tanggal='$now' ORDER BY x.idbarang_masuk DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['nama_merek']; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="float-left">Barang Keluar Hari Ini</h4>
            <a href="<?=base_url();?>process/cetak_barang_keluar_today.php" target="_blank"
                class="btn btn-info btn-icon-split btn-sm float-right">
                <span class="icon text-white-50">
                    <i class="fas fa-print"></i>
                </span>
                <span class="text">Cetak</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>TANGGAL</th>
                            <th>NAMA BARANG</th>
                            <th>MEREK</th>
                            <th>KATEGORI</th>
                            <th>KETERANGAN</th>
                            <th>JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT x.*,x1.nama_barang,x2.nama_merek,x3.nama_kategori FROM barang_keluar x JOIN barang x1 ON x1.idbarang=x.barang_id JOIN merek x2 ON x2.idmerek=x1.merek_id JOIN kategori x3 ON x3.idkategori=x1.kategori_id WHERE x.tanggal='$now' ORDER BY x.idbarang_keluar DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= date('d-m-Y',strtotime($row['tanggal'])); ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['nama_merek']; ?></td>
                            <td><?= $row['nama_kategori']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->