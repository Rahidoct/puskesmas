<!-- Sidebar -->
<ul class="navbar-nav bg-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Role Admin -->
    <?php if($_SESSION['level']=='admin'):?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?beranda_admin">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-hospital"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMINISTATOR</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item <?=isset($homeAdmin)?'active':'';?>">
        <a class="nav-link" href="?beranda_admin"> <strong class="btn btn-success col-md-12">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></strong>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Absensi
    </div>
    <!-- Heading -->
    <!-- Navigasi - Menu Absensi -->
    <li class="nav-item <?=isset($absensi)?'active':'';?>">
        <a class="nav-link collapsed" href="?absensi" data-toggle="collapse" data-target="#absensi" aria-expanded="true"
            aria-controls="absensi">
            <i class="fa-solid fa-qrcode"></i>
            <span>Absensi</span>
        </a>
        <div id="absensi" class="collapse <?=isset($absensi)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($area_absen)?'active':'';?>" href="?halaman_absensi">Absen</a>
                <a class="collapse-item <?=isset($info_absen)?'active':'';?>" href="?info_absen">Info Absen</a>
                <a class="collapse-item <?=isset($form_izin)?'active':'';?>" href="?form_izin">Pengajuan Izin</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?=isset($rekap_absen)?'active':'';?>">
        <a class="nav-link" href="?rekap_absen">
            <i class="fa-solid fa-print"></i>
            <span>Rekap Absen</span>
        </a>
    </li>
    <!-- Navigasi - Menu Absensi -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Sistem E-Arsip
    </div>
    <!-- Heading -->
    <!-- Navigasi - Menu elektronik arsip -->
    <li class="nav-item <?=isset($data_surat)?'active':'';?>">
        <a class="nav-link collapsed" href="?data_surat" data-toggle="collapse" data-target="#data_surat" aria-expanded="true"
            aria-controls="data_surat">
            <i class="fa-solid fa-folder-open"></i>
            <span>E-Arsip</span>
        </a>
        <div id="data_surat" class="collapse <?=isset($data_surat)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($surat_masuk)?'active':'';?>" href="?surat_masuk">Surat Masuk</a>
                <a class="collapse-item <?=isset($surat_keluar)?'active':'';?>" href="?surat_keluar">Surat Keluar</a>
                <a class="collapse-item <?=isset($kontrak_kerja)?'active':'';?>" href="?dok_kontrak_kerja">Kontrak Kerja</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($disposisi)?'active':'';?>">
        <a class="nav-link collapsed" href="?disposisi" data-toggle="collapse" data-target="#disposisi" aria-expanded="true"
            aria-controls="disposisi">
            <i class="fa-solid fa-folder-open"></i>
            <span>Disposisi</span>
        </a>
        <div id="disposisi" class="collapse <?=isset($disposisi)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($buat_surat)?'active':'';?>" href="?buat_surat">Buat Surat</a>
                <a class="collapse-item <?=isset($penerima)?'active':'';?>" href="?penerima">Penerima</a>
                <a class="collapse-item <?=isset($pengirim)?'active':'';?>" href="?pengirim">Pengirim</a>
            </div>
        </div>
    </li>
    <!-- End Navigasi - Menu elektronik arsip -->
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Sistem Kepegawaian
    </div>
    <!-- Heading -->
    <!-- Navigasi - Menu kepegawaian -->
    <li class="nav-item <?=isset($data_karyawan)?'active':'';?>">
        <a class="nav-link collapsed" href="?data_karyawan" data-toggle="collapse" data-target="#data_karyawan" aria-expanded="true"
            aria-controls="data_karyawan">
            <i class="fa-solid fa-hospital-user"></i>
            <span>Data Karyawan</span>
        </a>
        <div id="data_karyawan" class="collapse <?=isset($data_karyawan)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($kepala_puskesmas)?'active':'';?>" href="?kepala_puskesmas">Kepala Puskesmas</a>
                <a class="collapse-item <?=isset($nominatif)?'active':'';?>" href="?nominatif_pns">Karyawan</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?=isset($kepegawaian)?'active':'';?>">
        <a class="nav-link collapsed" href="?kepegawaian" data-toggle="collapse" data-target="#kepegawaian" aria-expanded="true"
            aria-controls="kepegawaian">
            <i class="fa-solid fa-file-pen"></i>
            <span>Input Data Pegawai</span>
        </a>
        <div id="kepegawaian" class="collapse <?=isset($kepegawaian)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($form_add_pegawai)?'active':'';?>" href="?form_add_pegawai">Tambah Karyawan</a>
                <a class="collapse-item <?=isset($pangkat)?'active':'';?>" href="?pangkat_atau_golongan">Tambah Pangkat/Gol</a>
                <a class="collapse-item <?=isset($posisi_jabatan)?'active':'';?>" href="?posisi_jabatan">Tambah Jabatan</a>
            </div>
        </div>
    </li>
    <!-- End Navigasi - Menu kepegawaian -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
<!--     <div class="sidebar-heading">
        Menu Pengguna
    </div>
 -->
    <!-- Nav Item - Menu Master -->    
    <!-- Nav Item - hak akses pengguna -->
<!--     <li class="nav-item <?=isset($penguna)?'active':'';?>">
        <a class="nav-link" href="?penguna">
            <i class="fa-solid fa-id-card"></i>
            <span>Hak Akses</span>
        </a>
    </li>
    <li class="nav-item <?=isset($panduan_admin)?'active':'';?>">
        <a class="nav-link" href="?panduan_admin">
            <i class="fa-solid fa-clipboard-question"></i>
            <span>Panduan ?</span>
        </a>
    </li>
 -->    <!-- End of Sidebar - Role Admin -->
    <?php endif; ?>

    <!-- Sidebar - Role Asset -->
    <?php if($_SESSION['level']=='asset'):?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?beranda_pengelolah_asset">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-warehouse"></i>
        </div>
        <div class="sidebar-brand-text mx-3">INVENTARIS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item <?=isset($homeAsset)?'active':'';?>">
        <a class="nav-link" href="?beranda_pengelolah_asset">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
     <!-- Nav Item - hak akses pengguna -->
    <li class="nav-item <?=isset($barang)?'active':'';?>">
        <a class="nav-link" href="?barang">
            <i class="fa-solid fa-database"></i>
            <span>Stok Barang</span></a>
    </li>

    <!-- Nav Item - hak akses pengguna -->
    <li class="nav-item <?=isset($inventaris)?'active':'';?>">
        <a class="nav-link" href="?inventaris">
            <i class="fa-solid fa-warehouse"></i>
            <span>Aset Tetap / Inventaris</span></a>
    </li>
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Inputan
    </div>

    <!-- Nav Item - Menu Master -->
    <li class="nav-item <?=isset($transaksi)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true"
            aria-controls="transaksi">
            <i class="fa-solid fa-right-left"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse <?=isset($transaksi)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($barang_masuk)?'active':'';?>" href="?barang_masuk">Barang Masuk</a>
                <a class="collapse-item <?=isset($barang_keluar)?'active':'';?>" href="?barang_keluar">Barang Keluar</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?=isset($master)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true"
            aria-controls="master">
            <i class="fa-solid fa-file-pen"></i>
            <span>Master Data</span>
        </a>
        <div id="master" class="collapse <?=isset($master)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($merek)?'active':'';?>" href="?merek">Merek</a>
                <a class="collapse-item <?=isset($kategori)?'active':'';?>" href="?kategori">Kategori</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($laporan)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
            aria-controls="laporan">
            <i class="fa-solid fa-folder-open"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse <?=isset($laporan)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($lap_barang_masuk)?'active':'';?>" href="?lap_barang_masuk">Laporan
                    Barang Masuk</a>
                <a class="collapse-item <?=isset($lap_barang_keluar)?'active':'';?>" href="?lap_barang_keluar">Laporan
                    Barang Keluar</a>
                <a class="collapse-item <?=isset($lap_stok_barang)?'active':'';?>"
                    href="<?=base_url();?>process/lap_stok_barang.php" target="_blank">Laporan Stok
                    Barang</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <!-- End of Sidebar - Role Asset -->
    <?php endif; ?>

    <!-- Sidebar - Role Bendahara -->
    <?php if($_SESSION['level']=='bendahara'):?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?beranda_bendahara_puskesmas">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-money-bill-transfer"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bendahara</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item <?=isset($homeBend)?'active':'';?>">
        <a class="nav-link" href="?beranda_bendahara_puskesmas">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($uang_diterima)?'active':'';?>">
        <a class="nav-link" href="?uang_diterima">
            <i class="fa-solid fa-right-to-bracket"></i>
            <span>Uang Diterima</span></a>
    </li>

    <li class="nav-item <?=isset($uang_disetorkan)?'active':'';?>">
        <a class="nav-link" href="?uang_disetorkan">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Uang Disetorkan</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu  -->
    <li class="nav-item <?=isset($cetak)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cetak" aria-expanded="true"
            aria-controls="cetak">
            <i class="fa-solid fa-print"></i>
            <span>Cetak Laporan</span>
        </a>
        <div id="cetak" class="collapse <?=isset($cetak)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($lap_retribusi_today)?'active':'';?>" href="?lap_retribusi_today">Laporan
                    Harian</a>
                <a class="collapse-item <?=isset($lap_retribusi_bulanan)?'active':'';?>" href="?lap_retribusi_bulanan">Laporan
                    Bulanan</a>
                <a class="collapse-item <?=isset($lap_arus_kas)?'active':'';?>"
                    href="<?=base_url();?>process/lap_stok_barang.php" target="_blank">Laporan BKU</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Pengguna
    </div>

    <!-- Nav Item - Menu Master -->
    <li class="nav-item <?=isset($buku_kas)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#buku_kas" aria-expanded="true"
            aria-controls="buku_kas">
            <i class="fa-solid fa-file-pen"></i>
            <span>Master Input Data</span>
        </a>
        <div id="buku_kas" class="collapse <?=isset($buku_kas)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($jenis)?'active':'';?>" href="?jenis">Jenis</a>
                <a class="collapse-item <?=isset($kelompok)?'active':'';?>" href="?kelompok">Kelompok</a>
                <a class="collapse-item <?=isset($jasa_pelayanan)?'active':'';?>" href="?jasa_pelayanan">Jasa Pelayanan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - profil -->
    <li class="nav-item <?=isset($profil_pengguna)?'active':'';?>">
        <a class="nav-link" href="?profil_pengguna">
            <i class="fa-solid fa-id-card"></i>
            <span>Profil</span></a>
    </li>
    <!-- Nav Item - hak akses pengguna -->
    <li class="nav-item <?=isset($panduan_pengguna)?'active':'';?>">
        <a class="nav-link" href="?panduan_pengguna">
            <i class="fa-solid fa-circle-question"></i>
            <span>Panduan ?</span></a>
    </li>
    <!-- End of Sidebar - Role Bendahara -->
    <?php endif; ?>

    <!-- Sidebar - Role Admin -->
    <?php if($_SESSION['level']=='super_admin'):?>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?beranda_super">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-user-secret"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Super Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Beranda -->
    <li class="nav-item <?=isset($home)?'active':'';?>">
        <a class="nav-link" href="?beranda_super">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($master)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#master" aria-expanded="true"
            aria-controls="master">
            <i class="fas fa-fw fa-folder"></i>
            <span>Master</span>
        </a>
        <div id="master" class="collapse <?=isset($master)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($merek)?'active':'';?>" href="?merek">Merek</a>
                <a class="collapse-item <?=isset($kategori)?'active':'';?>" href="?kategori">Kategori</a>
                <a class="collapse-item <?=isset($barang)?'active':'';?>" href="?barang">Barang</a>
                <a class="collapse-item <?=isset($pengguna)?'active':'';?>" href="?pengguna">Pengguna</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($transaksi)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true"
            aria-controls="transaksi">
            <i class="fas fa-fw fa-folder"></i>
            <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse <?=isset($transaksi)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($barang_masuk)?'active':'';?>" href="?barang_masuk">Barang Masuk</a>
                <a class="collapse-item <?=isset($barang_keluar)?'active':'';?>" href="?barang_keluar">Barang Keluar</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?=isset($laporan)?'active':'';?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true"
            aria-controls="laporan">
            <i class="fas fa-fw fa-folder"></i>
            <span>Laporan</span>
        </a>
        <div id="laporan" class="collapse <?=isset($laporan)?'show':'';?>" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=isset($lap_barang_masuk)?'active':'';?>" href="?lap_barang_masuk">Laporan
                    Barang Masuk</a>
                <a class="collapse-item <?=isset($lap_barang_keluar)?'active':'';?>" href="?lap_barang_keluar">Laporan
                    Barang Keluar</a>
                <a class="collapse-item <?=isset($lap_stok_barang)?'active':'';?>"
                    href="<?=base_url();?>process/lap_stok_barang.php" target="_blank">Laporan Stok
                    Barang</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->