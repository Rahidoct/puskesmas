<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
    <h1 class="h3 mb-0 text-gray-800">Profil Admin</h1>
</div>
<p class="mb-4 text-black-50-400">Admin | UPTD Puskesmas Bangodua</p> 

<?php

$id = $_SESSION['id_users'];
$sql = mysqli_query($con, "SELECT * FROM karyawan inner join users on karyawan.id_users = users.id_users join posisi on karyawan.id_posisi = posisi.id_posisi where users.id_users = '$id' ");
$data = mysqli_fetch_assoc($sql);

?>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <?php 
                $foto = $data['foto'];
                if ($foto == ""){
              ?>
              <img src="assets/foto/profil.jpeg" alt="Profile" class="img-profile rounded-circle mb-2" style="width: 200px;">
              <h2 class="border-bottom border-success"><?=$data['nama']; ?></h2>

              <?php 
              }else{
              ?>
              <img src="pkmbunder/assets/img/<?=$data['foto'] ?>" alt="Profile" class="img-profile rounded-circle mb-2" style="width: 200px;">
              <h2 class="border-bottom border-success"><?=$data['nama']; ?></h2>
              <?php 
              }
              ?>
              <h3><?=$data['nama_posisi']; ?></h3>
              <div class="h2 text-gray-800">
                <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="linkedin"><i class="fa-brands fa-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
        
              <div class="tab-content pt-2">

                <div class="profile-overview" id="profile-overview">
                    <h2 class="nav justify-content-end text-success mb-4">Profil Karyawan</h2>
                    <h4 class="card-title text-success border-bottom border-success">TENTANG SAYA</h4>
                    <p><cite title="Source Title"><?=$data['tentang'] ?></cite></p>

                    <h3 class="card-title text-success">BIODATA</h3>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Nama Lengkap</div>
                        <div class="col-lg-9 col-md-8">: <?=$data['nama'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Jabatan</div>
                        <div class="col-lg-9 col-md-8">: <?=$data['nama_posisi'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                        <div class="col-lg-9 col-md-8">: <?=$data['alamat'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Negara</div>
                        <div class="col-lg-9 col-md-8">: Indonesia</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">No. Hp</div>
                        <div class="col-lg-9 col-md-8">: <?=$data['no_hp'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8">: <?=$data['email'] ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Nama Instansi</div>
                        <div class="col-lg-9 col-md-8">: UPTD Puskesmas Bunder</div>
                    </div>

                    <div class="nav justify-content-end border-bottom border-success">
                        <a href="#karyawanModal" data-toggle="modal" onclick="submit(<?=$row['id_karyawan'];?>)" 
                            class="btn btn-sm btn-circle btn-info mb-2"><i class="fas fa-edit"></i></a>    
                    </div>

                </div>

                <div class="card-body">

              </div><!-- End Bordered Tabs -->
            </div>
          </div>
        </div>
    </section>
</div>

<!-- Modal Edit Biodata -->
<div class="modal fade" id="karyawanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="<?=base_url();?>process/edit_profile.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                     <h3 class="modal-title">Update Profile</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Profile Edit Form -->
                  <form>
                    <input name="id_users" type="hidden" class="form-control" id="fullName" value="<?=$data['id_users'] ?>">
                    <div class="row mb-3">
                      <label for="foto" class="col-md-4 col-lg-3 col-form-label" required>Profile Image</label>
                      <input type="hidden" name="id_karyawan" class="form-control">
                      <div class="col-md-8 col-lg-9">
                        <input type="file" name="foto" value="<?= upload_kontrak(); ?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px" required><?=$data['tentang'] ?></textarea>
                      </div>
                    </div>

                    <hr class="sidebar-divider">
                    <div class="nav justify-content-end">
                        <button class="btn btn-primary" type="submit" name="ubah"><i class="fas fa-save"></i>
                        Ubah</button>
                    </div>
                </form><!-- End Profile Edit Form -->
            </div>
        </div>
    </div>
</div>