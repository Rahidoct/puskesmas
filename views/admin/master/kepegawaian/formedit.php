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
$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM karyawan where id_karyawan = '$id' ");
$r = mysqli_fetch_assoc($sql);
?>
<div class="card mt-3 mb-4">
  <div class="card mt-3 mb-4 border-bottom-secondary">
        <div class="card-header bg-primary text-white">
            <h5 class="modal-title"><strong></strong></h5>
        </div>
        <div class="card-body">
            <form method="post" id="formadd" action="<?=base_url();?>process/users.php">
                <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
                    <h5 class="h4 mb-0 text-gray-800">Registrasi User</h5>
                </div>            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="hidden" name="id_users" class="form-control">
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" aria-describedby="passwordHelp">
                            <small id="passwordHelp" class="form-text" style="color:red;">Biarkan kosong jika tidak ingin merubah password</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <select name="level" class="form-control" required>
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
              <div class="card-body">
    <form method="POST" action="">
       <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h5 class="h4 mb-0 text-gray-800">Data Pegawai</h5>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label for="nama">Nama Karyawan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?=$r['nama_karyawan']?>">
            <small class="text-danger">*<span class="text-gray-800">ketik nama dengan gelar</span></small>
          </div>
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" placeholder="ketik nomor nip.." value="<?=$r['nip']?>">
            <small class="text-danger">*<span class="text-gray-800">kosongkan jika tidak memiliki NIP</span></small>
          </div>
          <div class="form-group">
            <label for="hp">No Hp</label>
            <input type="number" class="form-control" id="hp" name="hp" placeholder="ketik nomor hp.." value="<?=$r['hp']?>">
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" cols="30" rows="10"><?=$r['alamat']?></textarea>
          </div>

        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label for="Mulai Kerja">Mulai Kerja</label>
            <input type="date" class="form-control" id="mkerja" name="mkerja" placeholder="Mulai Kerja" value="<?=$r['mulai_kerja']?>">
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="umur">Umur</label>
            <input type="number" class="form-control" id="umur" name="umur" placeholder="umur" value="<?=$r['umur']?>">
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
                <?php
                $sqlJabatan = mysqli_query($con, "SELECT * FROM posisi");
                if (mysqli_num_rows($sqlJabatan) > 0) {
                  while ($data = mysqli_fetch_assoc($sqlJabatan)) {
                ?>
                <option value="<?= $data['id_posisi'] ?>"><?= $data['nama_posisi'] ?></option>
                <?php
                  }
                }
                ?>
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
            <input type="text" class="form-control" id="gaji" name="gaji" placeholder="Gaji" value="<?=$r['gaji']?>">
            <small class="text-danger">*<span class="text-gray-800">dilarang menggunakan symbol, gunakan angka saja</span></small>
          </div>
        </div>
      </div>
      <button type="submit" disabled name="ubah" class="btn btn-primary float-right"><i class="fas fa-save"></i> Ubah</button>
      <a href="?beranda_admin" name="batal" class="btn btn-danger">Batal</a>
    </form>
  </div>
</div>
</div>

<?php
if(isset($_POST['bsimpan'])){
   
  // $nip = ($r['status_pegawai']=='PNS')?$_POST['nip']: '';

  $ubah = mysqli_query($con, "UPDATE karyawan SET nama_karyawan = '$_POST[nama]', alamat = '$_POST[alamat]', mulai_kerja = '$_POST[mkerja]', umur = '$_POST[umur]', id_posisi = '$_POST[posisi]', status_pegawai = '$_POST[status]', gaji = '$_POST[gaji]', nip = '$_POST[nip]', hp = '$_POST[hp]' where id_karyawan = '$id'")or die($con);

// var_dump($ubah);
// exit;
 
    //jika berhasil
    if($ubah){
    //maka keluar informasi
    echo "<script>
      alert('Data Departemen Berhasil Diubah');
      document.location='?beranda_admin';
      </script>"; 
    }else{
      echo "<script>
      alert('Data Departemen Gagal Diubah');
      document.location='?beranda_admin';
      </script>"; 
    }

  }
?>