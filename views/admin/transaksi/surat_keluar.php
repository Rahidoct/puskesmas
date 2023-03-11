<?php hakAkses(['admin']); ?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="no_surat"]').val("");
        $('[name="tgl_surat"]').val("");
        $('[name="tgl_diterima"]').val("");
        $('[name="perihal"]').val("");
        $('[name="penerima"]').val("").trigger('change');
        $('[name="surat"]').val("");
        $('#suratModal .modal-title').html('Tambah Surat Keluar');
        $('[name="ubah"]').hide();
        $('[name="tambah"]').show();
    } else {
        $('#suratModal .modal-title').html('Edit Surat');
        $('[name="tambah"]').hide();
        $('[name="ubah"]').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>process/view_surat_keluar.php',
            dataType: 'json',
            success: function(data) {
                $('[name="id_arsip_out"]').val(data.id_arsip_out);
                $('[name="no_surat"]').val(data.no_surat);
                $('[name="tgl_surat"]').val(data.tgl_surat);
                $('[name="tgl_diterima"]').val(data.tgl_diterima);
                $('[name="perihal"]').val(data.perihal);
                $('[name="penerima"]').val(data.penerima).trigger('change');
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
        <h1 class="h3 mb-0 text-gray-800">E-Arsip</h1>
    </div>
    <p class="mb-4 text-black-50-400">Sistem Elektronik Arsip | UPTD Puskesmas Bangodua</p> 
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-circle-info"></i> Pastikan!</strong> anda mengisi kolom input untuk menambah data surat keluar yang sudah discan.
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
                            <th>NO. SURAT</th>
                            <th>TGL SURAT</th>
                            <th>TGL DITERIMA</th>
                            <th>PERIHAL</th>
                            <th>PENERIMA</th>
                            <th>FILE SURAT</th>
                            <th width="50">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT * FROM surat_keluar INNER JOIN arsip_penerima ON surat_keluar.id_penerima = arsip_penerima.id_penerima")or die(mysqli_error($con));
                        while($row = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $row['no_surat']; ?></td>
                            <td><?= $row['tgl_surat']; ?></td>
                            <td><?= $row['tgl_diterima']; ?></td>
                            <td><?= $row['perihal']; ?></td>
                            <td><?= $row['nama_penerima']; ?></td>
                            <td>
                                <?php 
                                    //uji apakah file nya ada atau tidak
                                    if (empty($row['file'])) {
                                    echo " - ";
                                    } else { ?>
                                    <a href="<?=base_url();?>/assets/file/<?=$row['file']?>" target="_blank"> lihat file </a>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="#suratModal" data-toggle="modal" onclick="submit(<?=$row['id_arsip_out'];?>)"
                                    class="btn btn-sm btn-circle btn-info"><i class="fas fa-edit"></i></a>
                                <a href="<?=base_url();?>/process/surat_keluar.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['id_arsip_out']);?>"
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
            <form action="<?=base_url();?>process/surat_keluar.php" method="post" enctype="multipart/form-data">
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
                                <label for="no_surat">Nomor Surat <span class="text-danger">*</span></label>
                                <input type="hidden" name="no_surat" class="form-control">
                                <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penerima">Penerima <span class="text-danger">*</span></label>
                                <select name="penerima" id="penerima" class="form-control select2" style="width:100%;"
                                    required>
                                    <option value="">-- Pilih Penerima --</option>
                                    <?= list_penerima(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="perihal">Perihal Surat <span class="text-danger">*</span></label>
                                <input type="hidden" name="perihal" class="form-control">
                                <input type="text" class="form-control" id="perihal" name="perihal" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_surat">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="hidden" name="tgl_surat" class="form-control">
                                <input type="date" class="form-control" id="tgl_surat" name="tgl_surat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_diterima">Tanggal Diterima <span class="text-danger">*</span></label>
                                <input type="hidden" name="tgl_diterima" class="form-control">
                                <input type="date" class="form-control" id="tgl_diterima" name="tgl_diterima" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="surat">Upload File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="surat" name="surat" value="<?= upload(); ?>">
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