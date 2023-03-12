<?php hakAkses(['admin']); ?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="nama"]').val("");
        $('[name="nama_posisi"]').val("");
        $('[name="tgl_kontrak"]').val("");
        $('[name="tgl_selesai"]').val("");
        $('[name="tahun"]').val("").trigger('change');
        $('[name="surat"]').val("");
        $('#suratModal .modal-title').html('Tambah Kontrak Kerja');
        $('[name="ubah"]').hide();
        $('[name="tambah"]').show();
    } else {
        $('#suratModal .modal-title').html('Edit Kontrak Kerja');
        $('[name="tambah"]').hide();
        $('[name="ubah"]').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>process/view_kontrak.php',
            dataType: 'json',
            success: function(data) {
                $('[name="id_kontrak"]').val(data.id_kontrak);
                $('[name="nama"]').val(data.nama);
                $('[name="nama_posisi"]').val(data.nama_posisi);
                $('[name="tgl_kontrak"]').val(data.tgl_kontrak);
                $('[name="tgl_selesai"]').val(data.tgl_selesai);
                $('[name="tahun"]').val(data.tahun).trigger('change');
                $('[name="surat"]').val(data.file);
            }
        });
    }
}
</script>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Kontrak Kerja Pegawai</h1>
    </div>
    <p class="mb-4 text-black-50-400">Sistem Elektronik Arsip | UPTD Puskesmas Bangodua</p> 
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-circle-info"></i> Pastikan!</strong> anda mengisi kolom input untuk menambah data kontrak kerja pegawai.
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#suratModal"
                onclick="submit('add')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <small>
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20">NO</th>
                            <th>NO KONTRAK</th>
                            <th>NAMA</th>
                            <th>POSISI</th>
                            <th>TGL KONTRAK</th>
                            <th>TGL BERAKHIR</th>
                            <th>TAHUN</th>
                            <th>FILE KONTRAK</th>
                            <th width="50">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT * FROM kontrak 
                                INNER JOIN karyawan ON kontrak.id_karyawan = karyawan.id_karyawan 
                                INNER JOIN posisi ON kontrak.id_posisi = posisi.id_posisi")
                                or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $row['no_kontrak']; ?></td>
                            <td><?= $row['nama']; ?></td>
                            <td><?= $row['nama_posisi']; ?></td>
                            <td><?= $row['tgl_kontrak']; ?></td>
                            <td><?= $row['tgl_selesai']; ?></td>
                            <td><?= $row['tahun']; ?></td>
                            <td>
                                <?php 
                                    //uji apakah file nya ada atau tidak
                                    if (empty($row['file'])) {
                                    echo " - ";
                                    } else { ?>
                                    <a href="<?=base_url();?>/assets/file/kontrak_kerja/<?=$row['file']?>" target="_blank"> lihat file </a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="#suratModal" data-toggle="modal" onclick="submit(<?=$row['id_kontrak'];?>)"
                                    class="btn btn-sm btn-circle btn-info"><i class="fas fa-edit"></i></a>
                                <a href="<?=base_url();?>/process/kontrak.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['id_kontrak']);?>"
                                    class="btn btn-sm btn-circle btn-danger btn-hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table></small>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal Tambah barang -->
<div class="modal fade" id="suratModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/kontrak.php" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="hidden" name="id_kontrak" class="form-control">
                                <select name="nama" id="nama" class="form-control select2" style="width:100%;" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    <?= list_pegawai(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_posisi"> Jabatan <span class="text-danger">*</span></label>
                                <select name="nama_posisi" id="nama_posisi" class="form-control select2" style="width:100%;" required>
                                    <option value="">-- Pilih Posisi --</option>
                                    <?= list_jabatan(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_kontrak">Nomor <span class="text-danger">*</span></label>
                                <input type="hidden" name="no_kontrak" class="form-control">
                                <input type="text" class="form-control" id="no_kontrak" name="no_kontrak" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_kontrak">Tanggal kontrak <span class="text-danger">*</span></label>
                                <input type="hidden" name="tgl_kontrak" class="form-control">
                                <input type="date" class="form-control" id="tgl_kontrak" name="tgl_kontrak" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tgl_selesai">Tanggal Selesai <span class="text-danger">*</span></label>
                                <input type="hidden" name="tgl_selesai" class="form-control">
                                <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="surat">Upload File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="surat" name="surat" value="<?= upload_kontrak(); ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahun">Tahun Kontrak <span class="text-danger">*</span></label>
                                <input type="hidden" name="tahun" class="form-control">
                                <input type="text" class="form-control" id="tahun" name="tahun" required>
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