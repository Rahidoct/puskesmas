<?php hakAkses(['asset']); ?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="nama_barang"]').val("");
        $('[name="merek_id"]').val("").trigger('change');
        $('[name="kategori_id"]').val("").trigger('change');
        $('[name="keterangan"]').val("");
        $('#barangModal .modal-title').html('Tambah Barang');
        $('[name="ubah"]').hide();
        $('[name="tambah"]').show();
    } else {
        $('#barangModal .modal-title').html('Edit Barang');
        $('[name="tambah"]').hide();
        $('[name="ubah"]').show();

        $.ajax({
            type: "POST",
            data: {
                id: x
            },
            url: '<?=base_url();?>process/view_barang.php',
            dataType: 'json',
            success: function(data) {
                $('[name="idbarang"]').val(data.idbarang);
                $('[name="merek_id"]').val(data.merek_id).trigger('change');
                $('[name="kategori_id"]').val(data.kategori_id).trigger('change');
                $('[name="nama_barang"]').val(data.nama_barang);
                $('[name="keterangan"]').val(data.keterangan);
            }
        });
    }
}
</script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Aset Tetap / Inventaris</h1>
    </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-brands fa-squarespace"></i></strong> Anda dapat melihat data inventaris puskesmas disini. !
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#barangModal"
                onclick="submit('add')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive table-sm"><small>
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col" width="20">NO</th>
                            <th scope="col">KODE ASET</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">MEREK</th>
                            <th scope="col">TAHUN</th>
                            <th scope="col">KATEGORI</th>
                            <th scope="col">HARGA</th>
                            <th scope="col">SUMBER DANA</th>
                            <th scope="col">KETERANGAN</th>
                            <th scope="col">LOKASI</th>
                            <th scope="col">PENANGGUNG JAWAB</th>
                            <th scope="col" width="50">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php 
                        $n=1;
                        $query = mysqli_query($con,"SELECT * FROM inventaris JOIN merek ON inventaris.idmerek = merek.idmerek
                                                                             JOIN kategori ON inventaris.idkategori = kategori.idkategori
                                                                             JOIN karyawan ON inventaris.id_karyawan = karyawan.id_karyawan") 
                                                                             or die(mysqli_error($con));
                        while($data = mysqli_fetch_array($query)):
                        ?>
                        <tr>
                            <td><?= $n++; ?></td>
                            <td><?= $data['kode']; ?></td>
                            <td><?= $data['nama_aset']; ?></td>
                            <td><?= $data['idmerek']; ?></td>
                            <td><?= $data['tahun']; ?></td>
                            <td><?= $data['idkategori']; ?></td>
                            <td><?= "Rp." . number_format($data['harga']); ?></td>
                            <td><?= $data['dana']; ?></td>
                            <td><?= $data['keterangan']; ?></td>
                            <td><?= $data['lokasi_aset']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td>
                                <a href="#barangModal" data-toggle="modal" onclick="submit(<?=$row['idbarang'];?>)"
                                    class="btn btn-sm btn-circle btn-info"><i class="fas fa-edit"></i></a>
                                <a href="<?=base_url();?>/process/barang.php?act=<?=encrypt('delete');?>&id=<?=encrypt($row['idbarang']);?>"
                                    class="btn btn-sm btn-circle btn-danger btn-hapus"><i class="fa-solid fa-trash-can"></i></a>
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
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/barang.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang <span class="text-danger">*</span></label>
                                <input type="hidden" name="idbarang" class="form-control">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merek_id">Merek Barang <span class="text-danger">*</span></label>
                                <select name="merek_id" id="merek_id" class="form-control select2" style="width:100%;"
                                    required>
                                    <option value="">-- Pilih Merek --</option>
                                    <?= list_merek(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_id">Kategori Barang <span class="text-danger">*</span></label>
                                <select name="kategori_id" id="kategori_id" class="form-control select2"
                                    style="width:100%;" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?= list_kategori(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"
                                    required></textarea>
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