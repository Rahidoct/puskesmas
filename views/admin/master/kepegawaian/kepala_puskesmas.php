<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    $data = mysqli_query($con, "SELECT * FROM karyawan
    INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi
    INNER JOIN users ON users.id_users = karyawan.id_users
    WHERE 
    posisi.nama_posisi = 'Kepala Puskesmas'") or die(mysqli_error($koneksi));


    if (isset($_POST['submit'])) {
      $id_user = $_POST['id_user'];
      $is_active = $_POST['is_active'];

    ?>
      <script>
        alert("Berhasil")
      </script>
      <meta http-equiv="refresh" content="0;">

    <?php
    }
    // var_dump(mysqli_fetch_assoc($data));
    // exit;
    ?>
    <div class="card shadow mb-4">
      <div class="card-header py-3 bg-success">
        <h6 class="m-0 font-weight-bold text-white">Data Kepala Puskesmas</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="alert-success text-gray-800">
              <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Posisi</th>
                <th>Email</th>
                <th>Status</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($r = mysqli_fetch_assoc($data)) { ?>
                <tr>
                  <td><?= $r['nama'] ?></td>
                  <td><?= $r['nip'] ?></td>
                  <td><?= $r['nama_posisi'] ?></td>
                  <td><?= $r['email'] ?></td>
                  <td><?= ($r['is_active'] == '1') ? 'Aktif' : 'Tidak Aktif' ?></td>
                  <td>
                    <form action="" method="post">
                      <input type="hidden" class="hidden" name="id_user" value="<?= $r['id_user'] ?>">
                      <input type="hidden" class="hidden" name="is_active" value="<?= ($r['is_active'] == '1') ? '0' : '1' ?>">
                      <?php
                      if ($r['is_active'] == 1) {
                      ?>
                        <input type="submit" value="Non Aktifkan" name="submit" class="btn btn-danger btn-sm">
                      <?php
                      } else {
                      ?>

                        <input type="submit" value="Aktifkan" name="submit" class="btn btn-success btn-sm">
                      <?php
                      }
                      ?>
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