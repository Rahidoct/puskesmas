<?php
        //cek siapa yang login untuk menampilkan halaman sesuai role
        if(isset($_GET['backup_app'])){
            include ('proses/backup_app.php');
        }
        else if(isset($_GET['backup_db'])){
            include ('proses/backup_db.php');
        } 
        
        // jika yang login admin
        else if($_SESSION["level"] == "admin"){
            // maka tampilkan halaman admin saja
            if(isset($_GET['beranda_admin'])){
                $index = $homeAdmin = true;
                $views = 'views/admin/index.php';
            }
            else if(isset($_GET['halaman_absensi'])){
                $absensi = $area_absen = true;
                $views = 'views/admin/master/absensi/uabsen.php';
            }else if(isset($_GET['halaman_cetakQR'])){
                $absensi = $area_absen = true;
                $views = 'views/admin/master/absensi/cetakqr.php';
            }
            else if(isset($_GET['logAbsen'])){
                $views = 'process/logAbsen.php';
            }
            else if(isset($_GET['form_izin'])){
                $absensi = $form_izin = true;
                $views = 'views/admin/master/absensi/form_izin.php';
            }
            else if(isset($_GET['rekap_absen'])){
                $rekap_absen = true;
                $views = 'views/admin/master/absensi/rekap.php';
            }
            // menu elektronik arsip surat
            else if(isset($_GET['surat_masuk'])){
                $data_surat = $surat_masuk = true;
                $views = 'views/admin/master/E-Arsip/surat_masuk.php';
            }
            else if(isset($_GET['surat_keluar'])){
                $data_surat = $surat_keluar = true;
                $views = 'views/admin/master/E-Arsip/surat_keluar.php';
            }
            else if(isset($_GET['dok_kontrak_kerja'])){
                $data_surat = $kontrak_kerja = true;
                $views = 'views/admin/master/E-Arsip/kontrak.php';
            }
            else if(isset($_GET['buat_surat'])){
                $disposisi = $buat_surat = true;
                $views = 'views/admin/master/E-Arsip/buat_surat.php';
            }
            else if(isset($_GET['penerima'])){
                $disposisi = $penerima = true;
                $views = 'views/admin/master/E-Arsip/penerima.php';
            }
            else if(isset($_GET['pengirim'])){
                $disposisi = $pengirim = true;
                $views = 'views/admin/master/E-Arsip/pengirim.php';
            }
            // menu kepegawaian
            else if(isset($_GET['kepala_puskesmas'])){
                $data_karyawan = $kepala_puskesmas = true;
                $views = 'views/admin/master/kepegawaian/kepala_puskesmas.php';
            }
            else if(isset($_GET['nominatif_pns'])){
                $data_karyawan = $nominatif = true;
                $views = 'views/admin/master/kepegawaian/nominatif.php';
            }
            else if(isset($_GET['nominatif_pppk'])){
                $data_karyawan = $nominatif = true;
                $views = 'views/admin/master/kepegawaian/pppk.php';
            }
            else if(isset($_GET['nominatif_honorer'])){
                $data_karyawan = $nominatif = true;
                $views = 'views/admin/master/kepegawaian/honorer.php';
            }
            else if(isset($_GET['pegawai_resign'])){
                $data_karyawan = $pegawai_resign = true;
                $views = 'views/admin/master/kepegawaian/resign.php';
            }
            else if(isset($_GET['form_add_pegawai'])){
                $kepegawaian = $form_add_pegawai = true;
                $views = 'views/admin/master/kepegawaian/formadd.php';
            }
            else if(isset($_GET['edit_data_pegawai'])){
                $views = 'views/admin/master/kepegawaian/formedit.php';
            }
            else if(isset($_GET['posisi_jabatan'])){
                $kepegawaian = $posisi_jabatan = true;
                $views = 'views/admin/master/kepegawaian/posisi.php';
            }
            //
            else if(isset($_GET['profil_admin'])){
                $profil = $profil = true;
                $views = 'views/admin/master/kepegawaian/profiladmin.php';
            }
            else if(isset($_GET['penguna'])){
                $pengguna = $penguna = true;
                $views = 'views/admin/master/kepegawaian/penguna.php';
            }
            else{
                $index = true;
                $views = 'views/admin/index.php';
            }
        }

        // jika yang login asset maka tampilkan halaman asset
        else if($_SESSION["level"] == "asset"){
            if(isset($_GET['beranda_pengelolah_asset'])){
                $index = $homeAsset = true;
                $views = 'views/asset/index.php';
            }else if(isset($_GET['merek'])){
                $master = $merek = true;
                $views = 'views/asset/master/merek.php';
            }
            else if(isset($_GET['kategori'])){
                $master = $kategori = true;
                $views = 'views/asset/master/kategori.php';
            }
            else if(isset($_GET['barang'])){
                $barang = $barang = true;
                $views = 'views/asset/master/barang.php';
            }
            else if(isset($_GET['inventaris'])){
                $inventaris = $inventaris = true;
                $views = 'views/asset/master/inventaris.php';
            }
            else if(isset($_GET['pengguna'])){
                $pengguna = $pengguna = true;
                $views = 'views/asset/master/pengguna.php';
            }
            else if(isset($_GET['barang_masuk'])){
                $barang_masuk = $barang_masuk = true;
                $views = 'views/asset/transaksi/barang_masuk.php';
            }
            else if(isset($_GET['barang_keluar'])){
                $barang_keluar = $barang_keluar = true;
                $views = 'views/asset/transaksi/barang_keluar.php';
            }
            else if(isset($_GET['lap_barang_masuk'])){
                $laporan = $lap_barang_masuk = true;
                $views = 'views/asset/laporan/lap_barang_masuk.php';
            }
            else if(isset($_GET['lap_barang_keluar'])){
                $laporan = $lap_barang_keluar = true;
                $views = 'views/asset/laporan/lap_barang_keluar.php';
            }
            else{
                $index = true;
                $views = 'views/asset/index.php';
            }
        }
        
        // jika yang login bendahara maka tampilkan halaman bendahara
        else if($_SESSION["level"] == "bendahara"){
            if(isset($_GET['beranda_bendahara_puskesmas'])){
                $index = $homeBend = true;
                $views = 'views/bendahara/index.php';
            }
            else if(isset($_GET['uang_diterima'])){
                $uang_diterima = $uang_diterima = true;
                $views = 'views/bendahara/transaksi/uang_masuk.php';
            }
            else if(isset($_GET['uang_disetorkan'])){
                $uang_disetorkan = $uang_disetorkan = true;
                $views = 'views/bendahara/transaksi/uang_keluar.php';
            }
            else if(isset($_GET['lap_retribusi_today'])){
                $cetak = $lap_retribusi_today = true;
                $views = 'views/bendahara/laporan/lap_barang_masuk.php';
            }
            else if(isset($_GET['lap_retribusi_bulanan'])){
                $cetak = $lap_retribusi_bulanan = true;
                $views = 'views/bendahara/laporan/lap_barang_keluar.php';
            }
            else if(isset($_GET['jasa_pelayanan'])){
                $buku_kas = $jasa_pelayanan = true;
                $views = 'views/bendahara/master/jasa.php';
            }
            else if(isset($_GET['jenis'])){
                $buku_kas = $jenis = true;
                $views = 'views/bendahara/master/jenis.php';
            }
            else if(isset($_GET['kelompok'])){
                $buku_kas = $kelompok = true;
                $views = 'views/bendahara/master/kelompok.php';
            }
            else{
                $index = true;
                $views = 'views/bendahara/index.php';
            }
        }
        // Jika role user tidak dikenali, keluarkan pesan error
        else{
            $index = true;
            $views = '404.php';
        }
?>