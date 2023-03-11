<?php hakAkses(['admin']); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
        <h1 class="h3 mb-0 text-gray-800">Surat Elektronik</h1>
    	<ul class="nav justify-content-end">
    	  <li class="nav-item dropdown">
		    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">Surat Tugas</a>
		    <div class="dropdown-menu" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Bottom popover">
		      <a class="dropdown-item" href="#">Kontrak ASN</a>
		      <a class="dropdown-item" href="#">Kontrak HONOR</a>
		      <a class="dropdown-item" href="#">Something else here</a>
		      <div class="dropdown-divider"></div>
		      <a class="dropdown-item" href="#">Separated link</a>
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