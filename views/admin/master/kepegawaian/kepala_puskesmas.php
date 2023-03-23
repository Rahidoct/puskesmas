<!-- Begin Page Content -->
<div class="container-fluid">
    <?php
    include ('config/conn.php');
    // Query untuk menampilkan data karyawan dengan posisi Kepala Puskesmas
    $tampil = mysqli_query($con, "SELECT * FROM karyawan
                                                        INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi
                                                        INNER JOIN users ON karyawan.id_users = users.id_users
                                                        WHERE posisi.nama_posisi = 'Kepala Puskesmas'") or die(mysqli_error($con));

    // Cek apakah query berhasil dieksekusi
    if (mysqli_num_rows($tampil) < 1) {
    echo "Tidak ada data.";
    }

    if (isset($_POST['submit'])) {
    $id_users = $_POST['id_users'];
    $is_active = $_POST['is_active'];

    // Update status aktif
    $query = mysqli_query($con, "UPDATE users SET is_active='$is_active' WHERE id_users='$id_users'");

    if ($query) {
      if ($is_active) {
          $success = 'Berhasil mengaktifkan masa menjabat.';
      } else {
          $success = 'Berhasil menonaktifkan masa menjabat.';
      }
      $_SESSION['success'] = $success;
      } else {
      $error = 'Gagal mengubah status masa menjabat.';
      $_SESSION['error'] = $error;
      }
    }
    ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3 bg-success">
      <h6 class="m-0 font-weight-bold text-white">Data Kepala Puskesmas</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table cellspacing="0" id="example" class="table display responsive" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
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
              $n=1;
              while ($data = mysqli_fetch_assoc($tampil)) {
            ?>
              <tr>
                <th><?= $n++; ?></th>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['nip'] ?></td>
                <td><?= $data['nama_posisi'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= ($data['is_active'] == '1') ? 'Aktif' : 'Tidak Aktif' ?></td>
                <td>
                <form action="" method="post">
                  <input type="hidden" class="hidden" name="id_users" value="<?= $data['id_users'] ?>">
                  <input type="hidden" class="hidden" name="is_active" value="<?= ($data['is_active'] == '1') ? '0' : '1' ?>">
                  <?php if ($data['is_active'] == 1) { ?>
                    <button title="Non Aktif" type="submit" name="submit" class="btn btn-icon-split btn-sm m-0">
                        <h4 class="text-danger">
                          <i class="fas fa-toggle-off"></i>
                        </h4>
                    </button>
                  <?php } else { ?>
                    <button title="Aktif" type="submit" name="submit" class="btn btn-icon-split btn-sm m-0">
                        <h4 class="text-success">
                          <i class="fas fa-toggle-on"></i>
                        </h4>
                    </button>
                  <?php } ?>
                </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
