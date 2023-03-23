<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Data Nominatif Pegawai Resign / Habis Kontrak</h1>
    </div>
    <p class="mb-4 text-black-50-400">Pegawai Resign | UPTD Puskesmas Bangodua </p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i></strong> jika pegawai atau karyawan sudah tidak bekerja atau mutasi diuptd puskesmas bangodua akan ditampilkan disini.!!
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
    $data = mysqli_query($con, "SELECT * FROM karyawan
    INNER JOIN users ON karyawan.id_users = users.id_users
    INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi 
    WHERE 
    status_pegawai = 'Resign'");
    if (isset($_POST['submitted'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];
        mysqli_query($con, "UPDATE karyawan  SET status_pegawai  = '$status' WHERE id_karyawan = '$id'");
    ?>
        <script>
            alert("Berhasil")
        </script>
        <meta http-equiv="refresh" content="0;">

    <?php
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-danger">
            <h6 class="m-0 font-weight-bold text-white">Data Karyawan Resign Puskesmas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table cellspacing="0" id="example" class="table display responsive" style="width:100%">
                    <thead class="alert-success text-gray-800">
                        <tr>
                            <th>Name</th>
                            <th>Posisi</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Mulai Bekerja</th>
                            <th>Gaji</th>
                            <th>Action</th>
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
                                    <form action="" method="post">
                                        <input type="hidden" name="id" value="<?= $r['id_karyawan'] ?>">
                                        <select class="form-control mb-2" name="status">
                                            <option value="PNS">Pegawai Negri Sipil</option>
                                            <option value="P3K">PPPK</option>
                                            <option value="Honorer">Honorer</option>
                                        </select>
                                        <input class="btn btn-success" type="submit" name="submitted" value="Recover">
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