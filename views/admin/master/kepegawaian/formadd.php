<?php hakAkses(['admin']) ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success" id="dataKaryawan">
        <h1 class="h3 mb-0 text-gray-800">Form Data Pegawai</h1>
    </div>
    <p class="mb-4 text-black-50-400">Data Karyawan | UPTD Puskesmas Bangodua </p>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-robot"></i></strong> anda dapat memasukan data karyawan untuk digunakan daftar hadir / absensi.!!
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

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
                                <option value="pimpinan">Kepala Puskesmas</option>
                                <option value="apoteker">Apoteker</option>
                                <option value="antrian">Pendaftaran</option>
                                <option value="rekam_medis">Rekam Medis</option>
                            </select>
                            <small class="text-danger">*<span class="text-gray-800">hak akses adalah sistem yang boleh diakses oleh user tersebut</span></small>
                        </div>
                    </div>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
                    <h5 class="h4 mb-0 text-gray-800">Data Pegawai / Karyawan</h5>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="hidden" name="idtxt" class="form-control">
                            <input type="text" class="form-control" name="nama" required>
                            <input type="hidden" name="id_karyawan" class="form-control">
                            <small class="text-danger">*<span class="text-gray-800">nama lengkap dengan gelar</span></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIP / NIRA / SIP</label>
                            <input type="text" class="form-control" name="nip" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_hp" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Mulai Kerja">Mulai Kerja</label>
                            <input type="date" class="form-control" id="mulai_kerja" name="mulai_kerja" placeholder="Mulai Kerja">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" placeholder="umur">
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
                                <select class="custom-select" name="status" id="inputGroupSelect02">
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
                            <input type="number" class="form-control" id="gaji" name="gaji" placeholder="Gaji">
                            <small class="text-danger">*<span class="text-gray-800">dilarang menggunakan symbol, gunakan angka saja</span></small>
                        </div>
                    </div>
                    <div class="col-md-12 float-right">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="tambah"><i class="fas fa-save"></i>
                        Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->