<!-- Page Heading -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Edit Karyawan</h1>
    </div>
    <p class="mb-4 text-black-50-400">Edit Data Karyawan | UPTD Puskesmas Bangodua </p>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i></strong> Anda dapat mengubah data karyawan, Jika karyawan terdapat perubahan data.!!
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php
      if(isset($_GET['ubah'])){
          $id = $_GET['ubah'];
          $query = mysqli_query($con, "SELECT * FROM karyawan INNER JOIN users ON karyawan.id_users = users.id_users
                                                             INNER JOIN posisi ON karyawan.id_posisi = posisi.id_posisi 
                                                             WHERE id_karyawan='$id'") or die(mysqli_error($con));
          $data = mysqli_fetch_array($query);
      }
    ?>
    <div class="card mt-3 mb-4 border-bottom-secondary">
        <div class="card-header bg-primary text-white">
        </div>
        <div class="card-body">
          <form method="POST" id="formedit" action="<?=base_url();?>process/users.php">
            <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
              <h5 class="h4 mb-0 text-gray-800">Ubah Data Pegawai</h5>
            </div>            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="hidden" name="id_users" class="form-control">
                        <input type="text" class="form-control" name="username" value="<?= $data['username']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $data['email']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nama">Nama Karyawan</label>
                    <input type="hidden" name="id_karyawan" class="form-control">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $data['nama']; ?>">
                    <small class="text-danger">*<span class="text-gray-800">ketik nama dengan gelar</span></small>
                  </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select name="level" class="form-control">
                            <option>--pilih jenis akses--</option>
                            <option value="user">Pegawai</option>
                            <option value="admin">Kasubag TU</option>
                            <option value="asset">Pengelolah Aset</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="kepala_puskesmas">Kepala Puskesmas</option>
                            <option value="apoteker">Apoteker</option>
                            <option value="antrian">Pendaftaran</option>
                            <option value="rekam_medis">Rekam Medis</option>
                        </select>
                        <small class="text-danger">*<span class="text-gray-800">hak akses adalah sistem yang boleh diakses oleh user tersebut</span></small>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="text" class="form-control" id="nip" name="nip" placeholder="ketik nomor nip.." value="<?= $data['nip']; ?>">
                  <small class="text-danger">*<span class="text-gray-800">kosongkan jika tidak memiliki NIP</span></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="no_hp">No Hp</label>
                  <input type="number" class="form-control" id="no_hp" name="no_hp"value="<?= $data['no_hp']; ?>">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" class="form-control" cols="30" rows="10"><?= $data['alamat']; ?></textarea>
                </div>

              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="Mulai Kerja">Mulai Kerja</label>
                  <input type="date" class="form-control" id="mkerja" name="mkerja" value="<?= $data['mulai_kerja']; ?>">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="umur">Umur</label>
                  <input type="number" class="form-control" id="umur" name="umur" value="<?= $data['umur']; ?>">
                </div>
              </div>

              <div class="col-md-7">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Pilih Jabatan</label>
                    </div>
                    <select class="custom-select" name="posisi" id="inputGroupSelect01">
                      <option selected>--jabatan pegawai--</option>
                      <?= list_jabatan(); ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect02">Pilih Status</label>
                    </div>
                    <select class="custom-select" name="status" id="inputGroupSelect01">
                      <option selected>--status pegawai--</option>
                      <option value="PNS">PNS (Pegawai Negri)</option>
                      <option value="P3K">PPPK</option>
                      <option value="Honorer">Honorer</option>
                      <option value="Resign">Resign</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="gaji">Gaji</label>
                  <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Gaji" value="<?=$data['gaji']?>">
                  <small class="text-danger">*<span class="text-gray-800">dilarang menggunakan symbol, gunakan angka saja</span></small>
                </div>
              </div>
            </div>
            <button type="submit" name="ubah" class="btn btn-primary float-right"><i class="fas fa-save"></i> Ubah</button>
            <a href="?beranda_admin" name="batal" class="btn btn-danger">Batal</a>
          </form>
        </div>
    </div>
</div>