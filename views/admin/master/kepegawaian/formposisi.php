<?php
    //panggil function.php untuk upload file
    include "config/function.php";
        //Uji Jika klik tombol edit / hapus 
    if(isset($_GET['tambah_jabatan']))
    {
        if($_GET['edit_jabatan'] == "edit")
        {
            //tampilkan data yang akan diedit
            $tampil = mysqli_query($con, "SELECT
                                    *
                                FROM 
                                    posisi
                                WHERE
                                    id_posisi='$_GET[id]'");
            $data = mysqli_fetch_array($tampil);
            if($data)
            {
                //jika data ditemukan, maka data ditampung ke dalam variabel
                $vposisi = $data['nama_posisi'];
            }
        }

        elseif ($_GET['hapus_jabatan'] == 'hapus') {
            $hapus = mysqli_query($con, "DELETE FROM posisi WHERE id_posisi='$_GET[id]'");
            if($hapus){
                echo "<script>
                        alert('Hapus Data Sukses');
                        document.location= '?posisi_jabatan';
                    </script>";
            }
        }
    }


    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {
        //pengujian apakah data akan diedit /simpan baru
        if(isset($_GET['tambah_jabatan']) && $_GET['edit_jabatan'] == "edit"){
            $ubah = mysqli_query($con, "UPDATE  posisi SET 
                                                    nama_posisi = '$_POST[nama_posisi]'
                                                where id_posisi = '$_GET[id]'")or die(mysqli_error($con));

            if($ubah)
            {
                echo "<script>
                    alert('Ubah Data Sukses');
                    document.location= '?posisi_jabatan';
                </script>";
            }else
            {
              echo
                "<script>
                    alert('Ubah Data Gagal!!');
                    document.location= '?posisi_jabatan';
                </script>";
            }
        }
        else
        {
            //perintah simpan data baru
            //simpan data
            $simpan = mysqli_query($con, "INSERT INTO posisi (nama_posisi) VALUES ('$_POST[nama_posisi]') ");
            if($simpan)
            {
                echo "<script>
                    alert('Simpan Data Sukses');
                    document.location= '?posisi_jabatan';
                </script>";
            }else
            {
                echo
                "<script>
                    alert('Simpan Data Gagal!!');
                    document.location= '?posisi_jabatan';
                </script>";
            }
        }
    }
?>

<div class="card mt-3 mb-4">
  <div class="card-header bg-primary text-white">
    Form Tambah Posisi
  </div>
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="posisi">Posisi</label>
        <input type="text" class="form-control" value="<?= @$vposisi ?>" id="posisi" name="nama_posisi" placeholder="Nama jabatan">
      </div>
      <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
      <a href="?posisi_jabatan" name="bbatal" class="btn btn-danger">Batal</a>
    </form>
  </div>
</div>