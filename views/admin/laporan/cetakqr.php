<div class="container-fluid">
  <?php
  // GET DATA KARYAWAN
  include  'assets/library/phpqrcode/qrlib.php';
  $id_users = $_SESSION['id_users'];
  $sqlKaryawan = mysqli_query($con, "SELECT * FROM karyawan INNER JOIN posisi on karyawan.id_posisi = posisi.id_posisi 
                                                         where id_users = '$id_users'");
  $data = mysqli_fetch_assoc($sqlKaryawan);
  $textGenerate = $data['nama'] . ";" . $data['id_users'];
  $nameFile = 'assets/qrCode/' . md5($data['nama']) . ".png";
  if (!file_exists($nameFile)) {
    QRCode::png($textGenerate, $nameFile, QR_ECLEVEL_L, 15, 0);
  }

  ?>

  <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
    <h1 class="h3 mb-0 text-gray-800">Cetak QR</h1>
  </div>
  <div class="profile mb-4" id="profile" style="max-width: 318px;">

    <img src="<?= $nameFile ?>" alt="">
    <h3 class="text-center"><?= $data['nama'] ?></h3>
    <h4 class="text-center"><?= $data['nama_posisi'] ?></h4>
  </div>
  <button class="btn btn-success" onclick="PrintImage('<?= $nameFile ?>')">Cetak</button>
  <a href="assets/qrCode/<?= md5($data['nama']) ?>.png" download="<?= $data['nama'] ?>.png" class="btn btn-primary" >Download</a>

  <script>

    function ImagetoPrint(source) {
      return "<html><head><scri" + "pt>function step1(){\n" +
        "setTimeout('step2()', 10);}\n" +
        "function step2(){window.print();window.close()}\n" +
        "</scri" + "pt></head><body onload='step1()'>\n" +
        "<img src='" + source + "' style='padding:30px;'/><br> <?= $data['nama'] ?></body></html>";
    }

    function PrintImage(source) {
      var Pagelink = "about:blank";
      var pwa = window.open(Pagelink, "_new");
      pwa.document.open();
      pwa.document.write(ImagetoPrint(source));
      pwa.document.close();
    }
  </script>
</div>