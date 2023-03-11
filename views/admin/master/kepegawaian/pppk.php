<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Data Nominatif (PPPK)</h1>
    </div>
    <p class="mb-4 text-black-50-400">Pegawai Pemerintah Dengan Perjanjian Kontrak | UPTD Puskesmas Bangodua </p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i></strong> Apabila karyawan sudah tidak bekerja dipuskesmas anda dapat klik tombol resign.!!
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <?php
    $data = mysqli_query($con, "SELECT * FROM karyawan
    INNER JOIN users ON karyawan.id_users = users.id_users
    INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi 
    WHERE 
    status_pegawai = 'PPPK'");
    if (isset($_POST['submitted'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        mysqli_query($con, "UPDATE karyawan  SET status_pegawai  = '$status' WHERE id_karyawan = '$id'");
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header text-center">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link" href="?nominatif_pns">Pegawai Negeri</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active disabled">PPPK</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?nominatif_honorer">Honorer</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Status</a>
              </li>
            </ul>
      </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="alert-success text-gray-800">
                        <tr>
                            <th>Name</th>
                            <th>Posisi</th>
                            <th>Lokasi</th>
                            <th>Umur</th>
                            <th>Mulai Bekerja</th>
                            <th>Gaji</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($r = mysqli_fetch_assoc($data)) { ?>
                            <tr>
                                <td><?= $r['nama'] ?></td>
                                <td><?= $r['nama_posisi'] ?></td>
                                <td><?= $r['alamat'] ?></td>
                                <td><?= $r['umur'] ?></td>
                                <td><?= $r['mulai_kerja'] ?></td>
                                <td><?= $r['gaji'] ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="id" value="<?= $r['id_karyawan'] ?>">
                                        <input type="hidden" name="status" value="Resign">
                                        <input class="btn btn-danger btn-sm" type="submit" name="submitted" value="Resign">
                                    </form>
                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>