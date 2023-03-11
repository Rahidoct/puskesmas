<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
    <h1 class="h3 mb-0 text-gray-800">Hak Akses</h1>
</div>
<p class="mb-4 text-black-50-400">Admin | UPTD Puskesmas Bangodua</p> 

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="#" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#addModal">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <!-- bagian atas isi data -->
                <thead class="card-header bg-info">
                    <tr class="text-white bold">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                $tampil = mysqli_query($koneksi, "SELECT * FROM karyawan inner join user on karyawan.id_user = user.id_user where is_active = '1' AND level ='HRD'");
                $no = 1;
                //membuat perulangan data
                while ($data = mysqli_fetch_array($tampil)) :
                ?>
                    <!-- bagian isi data -->
                    <tbody>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_karyawan'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td>
                                <button class="btn btn-info btn-circle btn-edit" data-id="<?= $data['id_user']; ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-circle btn-danger btn-hapus" data-id="<?= $data['id_user']; ?>"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php //akhir dari perulangan data
                endwhile;
                    ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="proses/addHak.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Hak Ases User</h5>
                    <button class="close closed" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Pilih Nama</label>
                                <input type="hidden" name="id" class="form-control">
                                <select name="nama" id="selectNama" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <button class="btn btn-secondary closed" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="add"><i class="fas fa-save"></i>
                        Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Pengguna -->
<div class="modal fade" id="penggunaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="proses/editHakAkses.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close closed" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="hidden" name="id" class="form-control">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" required disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text" style="color:red;">Biarkan kosong
                                    jika tidak ingin merubah password</small>
                            </div>
                        </div>
                    </div>
                    <hr class="sidebar-divider">
                    <button class="btn btn-secondary closed" type="button" data-dismiss="modal"><i class="fas fa-times"></i>
                        Batal</button>
                    <button class="btn btn-primary float-right" type="submit" name="ubah"><i class="fas fa-save"></i>
                        Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(".btn-hapus").click(function() {
        if (confirm("Anda yakin ingin mencopot user dari hak akses?")) {
            const id = $(this).data('id');
            $.ajax({
                url: 'proses/delHak.php',
                type: 'POST',
                data: {
                    id
                },
                success: function() {
                    location.reload();
                }
            })
        }
    })

    $(".btn-edit").on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: 'proses/hakAkses.php',
            type: 'POST',
            data: {
                id
            },
            dataType: 'JSON',
            success: function(e) {
                $('#penggunaModal .modal-title').html('Edit Pengguna');
                $("[name='nama']").val(e.nama_karyawan)
                $("[name='id']").val(e.id_karyawan)
                $("[name='email']").val(e.email)
                $("[name='username']").val(e.username)
                $("#penggunaModal").modal("show")
                $(".closed").click(function() {
                    $("#penggunaModal").modal("hide")
                })
            },

        })
    })

    $(document).ready(function() {
        $.ajax({
            url: 'proses/karHak.php',
            type: 'GET',
            success: function(e) {
                $("#selectNama").append(e)
            }
        })
    })
</script>