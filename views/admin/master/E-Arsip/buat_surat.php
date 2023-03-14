<?php hakAkses(['admin']); ?>
<script>
function submit(x) {
    if (x == 'add') {
        $('[name="nama_barang"]').val("");
        $('[name="merek_id"]').val("").trigger('change');
        $('[name="kategori_id"]').val("").trigger('change');
        $('[name="ttl"]').val("");
        $('#stModal .modal-title').html('Tambah Surat Tugas');
        $('[name="ubah"]').hide();
        $('[name="tambah"]').show();
    } else {
        $('#stModal .modal-title').html('Edit Barang');
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
                $('[name="ttl"]').val(data.ttl);
            }
        });
    }
}
</script>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Surat Elektronik</h1>
    	<ul class="nav justify-content-end">
    	  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Surat Tugas</a>
		    <div class="dropdown-menu" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Bottom popover">
		      <a class="dropdown-item" href="#">Kontrak Kerja</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#stModal" onclick="submit('add')">Surat Tugas</a>
		    </div>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Surat Perjalanan Dinas</a>
		    <div class="dropdown-menu">
		      <a class="dropdown-item" href="#">Dalam Kota</a>
		      <a class="dropdown-item" href="#">Tetap</a>
		      <a class="dropdown-item" href="#">Something else here</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#">Separated link</a>
		    </div>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Surat Kegiatan</a>
		    <div class="dropdown-menu">
		      <a class="dropdown-item" href="#">LOKMIN</a>
		      <a class="dropdown-item" href="#">LOKCAM</a>
		      <a class="dropdown-item" href="#">Something else here</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#">Separated link</a>
		    </div>
		  </li>
		  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Berita Acara</a>
		    <div class="dropdown-menu">
		      <a class="dropdown-item" href="#">Keluhan</a>
		      <a class="dropdown-item" href="#">Kehilangan</a>
		      <a class="dropdown-item" href="#">Pengembalian</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#">Separated link</a>
		    </div>
		  </li>
		</ul>
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong><i class="fa-solid fa-circle-info"></i> Pastikan!</strong> anda memilih menu navigasi diatas untuk membuat surat berdasarkan kebutuhan.
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    
    <div class="card shadow mb-4">
	  <div class="card-header bg-primary text-white">
	  	DISPOSISI
	  </div>
	  <div class="card-body">
	  	  <div class="table-responsive">
			  <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
				  <thead>
				    <tr>
				      <th scope="col" width="20">#</th>
				      <th scope="col" width="50">NO. SURAT</th>
				      <th scope="col">ISI SURAT</th>
				      <th scope="col" width="50">TANGGAL</th>
				      <th scope="col" width="50">OPSI</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>800/001/PKM-BDR/II/2023</td>
				      <td>Surat Tugas Rahmat Hidayat</td>
				      <td>01/01/2023</td>
				      <td>Hapus</td>
				    </tr>
				    <tr>
				      <th scope="row">2</th>
				      <td>800/002/PKM-BDR/II/2023</td>
				      <td>Surat Kegiatan Lokbul</td>
				      <td>01/01/2023</td>
				      <td>Hapus</td>
				    </tr>
				    <tr>
				      <th scope="row">3</th>
				      <td>800/003/PKM-BDR/II/2023</td>
				      <td>Berita Acara PLN</td>
				      <td>01/01/2023</td>
				      <td>Hapus</td>
				    </tr>
				  </tbody>
				</table>
			</div>
		  </div>
	</div>
</div>

<!-- Modal Kontrak Kerja -->
<div class="modal fade" id="skModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/merek.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Merek</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Nama Merek <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ttl">Keterangan <span class="text-danger">*</span></label>
                                <textarea name="ttl" id cols="30" rows="5" class="form-control"
                                    required></textarea>
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