<!-- Modal Surat Tugas -->
<div class="modal fade" id="stModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/cetak_surat/surat_tugas.php" method="post">
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
                                <label for="no_surat">Nomor Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_surat" name="no_surat" required>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="ttl">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ttl" name="ttl" required>
                            </div>
                        </div>
						<div class="col-md-8">
                            <div class="form-group">
                                <label for="pendidikan">Pendidikan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="form-group">
                                <label for="posisi">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="posisi" name="posisi" required>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_kontrak">Berlaku Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tgl_kontrak" name="tgl_kontrak" required>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="tgl_selesai">Berakhir Sampai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tugas">Tugas Pokok <span class="text-danger">*</span></label>
                                <textarea name="tugas" id cols="30" rows="5" class="form-control"
                                    required></textarea>
                            </div>
                        </div>
						<div class="col-md-12">
                            <div class="form-group">
                                <label for="disposisi">Disposisi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="disposisi" name="disposisi" required>
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="tambah"><i class="fas fa-save"></i>
                        Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>