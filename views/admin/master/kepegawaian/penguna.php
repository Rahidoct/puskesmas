<?php hakAkses(['admin']) ?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="email"]').val("");
        $('[name="username"]').val("");
        $('[name="level"]').val("");
        $('[name="nama"]').val("");
        $('[name="nip"]').val("");
        $('[name="no_hp"]').val("");
        $('[name="alamat"]').val("");
        $('[name="mulai_kerja"]').val("");
        $('[name="umur"]').val("");
        $('[name="posisi"]').val("").trigger('change');
        $('[name="status"]').val("");
        $('[name="gaji"]').val("");
        $('#penggunaModal .modal-title').html('Tambah Pengguna');
        $('[name="username"]').prop('readonly', false);
        $('[name="password"]').prop('required', true);
        $('#passwordHelp').hide();
        $('[name="ubah"]').hide();
        $('[name="tambah"]').show();
    } else {
        $('#penggunaModal .modal-title').html('Edit Pengguna');
        $('[name="username"]').prop('readonly', true);
        $('[name="password"]').prop('required', false);
        $('#passwordHelp').show();
        $('[name="tambah"]').hide();
        $('[name="ubah"]').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>process/view_user.php',
            dataType: 'json',
            success: function(data) {
                $('[name="id_users"]').val(data.id_users);
                $('[name="username"]').val(data.username);
                $('[name="email"]').val(data.email);
                $('[name="level"]').val(data.level);
                $('[name="nama"]').val(data.nama);
                $('[name="nip"]').val(nip);
                $('[name="no_hp"]').val(no_hp);
                $('[name="alamat"]').val(alamat);
                $('[name="mulai_kerja"]').val(mulai_kerja);
                $('[name="umur"]').val(umur);
                $('[name="posisi"]').val(posisi).trigger('change');
                $('[name="status"]').val(status);
                $('[name="gaji"]').val(gaji);
            }
        });
    }
}
</script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Hak Akses</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#penggunaModal"
                onclick="submit('add')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>NAMA LENGKAP</th>
                            <th>TELP</th>
                            <th>Email</th>
                            <!-- <th>LEVEL</th> -->
                            <th width="50">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT * FROM karyawan INNER JOIN users ON karyawan.id_users = users.id_users 
                                                                            ORDER BY id_karyawan DESC")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['no_hp']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td>
                                <a href="#penggunaModal" data-toggle="modal" onclick="submit(<?=$row['id_users'];?>)"
                                    class="btn btn-sm btn-circle btn-info"><i class="fas fa-edit"></i></a>
                                <a href="<?=base_url();?>/process/users.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['id_users']);?>"
                                    class="btn btn-sm btn-circle btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="penggunaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/users.php" method="post">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
                        <h5 class="h4 mb-0 text-gray-800">Registrasi Akun User</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="hidden" name="id_users" class="form-control">
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password"
                                    aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text" style="color:red;">Biarkan kosong
                                    jika tidak ingin merubah password</small>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
                        <h5 class="h4 mb-0 text-gray-800">Data Pegawai / Karyawan</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="hidden" name="id_karyawan" class="form-control">
                                <input type="text" class="form-control" name="nama" required>
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
                                <label for="mulai_kerja">Mulai Kerja</label>
                                <input type="date" class="form-control" id="mulai_kerja" name="mulai_kerja" placeholder="mulai_kerja">
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
                                        <option value="PPPK">PPPK</option>
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
                    </div>    
                    <hr class="sidebar-divider">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="tambah"><i class="fas fa-save"></i>
                        Tambah</button>
                    <button class="btn btn-primary float-right" type="submit" name="ubah"><i class="fas fa-save"></i>
                        Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>