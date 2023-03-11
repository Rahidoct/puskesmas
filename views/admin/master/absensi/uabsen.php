<script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<div class="container-fluid">
  <!-- Cek Sudah Absen Belum -->
  <?php
  // Include library PHP QR Code
  require "config/conn.php";
  // Get ID Karyawan
  $id_users = $_SESSION['id_users'];
  $mysql = mysqli_query($con, "SELECT * FROM karyawan WHERE id_users = '$id_users'");
  $dataKaryawan = mysqli_fetch_assoc($mysql);
  $id_karyawan = $dataKaryawan['id_karyawan'];

  // Get Date
  $date = date("Y-m-d");

  // Cek QR
  $resQR = "true";
  $resQRKeluar = "true";
  $sqlCek = mysqli_query($con, "SELECT * FROM log_absensi WHERE id_karyawan = '$id_karyawan' && `date` = '$date' && (`stats`='Masuk' OR stats='Rapat' OR stats='Izin' OR stats='Sakit')");
  $sqlKeluar = mysqli_query($con, "SELECT * FROM log_absensi WHERE id_karyawan = '$id_karyawan' && `date` = '$date' && (`stats`='Keluar' OR stats='Rapat' OR stats='Izin' OR stats='Sakit')");
  $num = mysqli_num_rows($sqlCek);
  $numKeluar = mysqli_num_rows($sqlKeluar);
  $dataQR = mysqli_fetch_assoc($sqlCek);

  if ($num > 0) {
    $resQR = "true";
  } else {
    $dataQR = ['time' => "00:00:00"];
    $resQR = "false";
    $dataQR = ['stats' => ""];
  }

  if ($numKeluar > 0) {
    $resQRKeluar = "true";
  } else {
    $resQRKeluar = "false";
  }

  ?>
  <!-- Akhir Cek -->
  <div class="d-sm-flex align-items-center justify-content-between mb-2 border-bottom border-success">
    <h1 class="h3 mb-0 text-gray-800">Scan QR</h1>
  </div>
  <p class="mb-4 text-black-50-400">Sistem Absensi Qr-Code | UPTD Puskesmas Bangodua </p>
  <div class="vid">

  </div>
  <h1 id="status"></h1>
  <div class="statKeluar">
  </div>
  <div class="print">
    <a href="?halaman_cetakQR" class="btn btn-success btn-sm" id="cetak">Cetak QR</a>
    <span><i>Klik cetak qr jika anda kehilangan QR anda</i></span>

  </div>
  <?php $_SESSION['nama'] = "Rahmat Hidayat" ?>

</div>
  <!-- Javascript Absen -->
  <script>
    function keluar() {
      const getDate = new Date();
      const hour = getDate.getHours();
      const minute = getDate.getMinutes();
      const seconds = getDate.getSeconds()
      const time = `${hour}:${minute}:${seconds}`

      const data = {
        id_karyawan: <?= $id_karyawan ?>,
        date: '<?= $date ?>',
        time: time,
        status: "Keluar"
      }
      const absenAjax = $.ajax({
        url: "?logAbsen",
        type: "POST",
        datType: "text",
        data: data,
      })
      // Jika ajax sudah berjalan dengan normal
      absenAjax.done(function() {
        document.getElementById("status").innerHTML = `Anda sudah keluar, sampai jumpa besok :)`
        $(".statKeluar").children().remove()
      })
      // Jika ajax tidak berjalan dengan normal
      absenAjax.fail(function() {
        console.log("Fail")
      })
    }

    // Jika protocol bukan https maka pindahkan ke https
    if (location.protocol !== 'https:') {
      location.replace(`https:${location.href.substring(location.protocol.length)}`);
    }
    // Cek apakah status online / terhubung ke internet
    if (navigator.onLine) {
      $(".vid").append("<video id='preview' class='center' width='35%'></video>")
      let scanner = new Instascan.Scanner({
        video: document.getElementById("preview"),
        mirror: false
      })


      // Function Start Camera
      function startCamera() {
        Instascan.Camera.getCameras().then(function(cameras) {
          if (cameras.length > 0) {
            let selectedCam = cameras[0]
            $.each(cameras, (i, c) => {
              if (c.name.indexOf('back') != -1) {
                selectedCam = c;
                return false;
              }
            });
            scanner.start(selectedCam);
          } else {
            alert("Tidak ada kamera")
          }

        }).catch(function(e) {
          console.error(e);
        })
      }

      // Cek apakah karyawan/user sudah absen
      if (<?= $resQR ?> == false) {
        // Cek status jika status resign
        if ('<?= $dataKaryawan['status_pegawai'] ?>' == 'Resign') {
          document.getElementById("status").innerHTML = `Anda sudah resign jika ingin detail lanjut silahkan hubungi HRD`
          $(".print").children().remove()
          $(".vid").children().remove()

        } else {
          // Jika bukan resihn dan blm absen jalankan function startCamera
          startCamera();
        }


      } else {
        // Jika karyawan/user sudah absen
        document.getElementById("status").innerHTML = `<?= @$dataKaryawan['nama'] ?> anda sudah absen <?= @$dataQR['stats'] ?> hari ini pada pukul <?= @$dataQR['time'] ?>`
        $(".vid").children().remove()
        // Cek apakah user sudah absen keluar?
        if (<?= $resQRKeluar ?> == false) {
          // Jika blm munculkan tombol keluar
          $(".statKeluar").append("<button class='btn btn-danger mb-3' onclick='keluar()'>Absen Keluar</button>")
        } else {
          // jika sudah maka hapus tombol
          $(".statKeluar").children().remove()
          document.getElementById("status").innerHTML = `Anda tidak perlu absen lagi hari ini!`

        }
      }
      // Function stop camera
      function stopCamera() {
        scanner.stop();
      }

      // cek/validasi QR apakah sesuai dengan user/karyawan
      function cekEqual(id_karyawan1, id_karyawan2) {
        return id_karyawan1 == id_karyawan2
      }
      // tambahkan listener scan
      scanner.addListener('scan', function(e) {
        // Split Result Array
        const arr = e.split(";");
        const result = cekEqual(arr[1], '<?= $id_karyawan ?>')
        if (result) {
          // Prepare data untuk post database
          const getDate = new Date();

          const hour = getDate.getHours();
          const minute = getDate.getMinutes();
          const seconds = getDate.getSeconds()
          const time = `${hour}:${minute}:${seconds}`
          const data = {
            id_karyawan: <?= $id_karyawan ?>,
            date: '<?= $date ?>',
            time: time,
            status: "Masuk"
          }
          console.log(data)

          // Jalakan ajax dengan type POST
          const absenAjax = $.ajax({
            url: "?logAbsen",
            type: "POST",
            datType: "text",
            data: data,
          })
          // Jika ajax sudah berjalan dengan normal
          absenAjax.done(function() {
            console.log("Success")
            document.getElementById("status").innerHTML = `${arr[0]} Selamat datang, absen sukses`
            $(".statKeluar").append("<button class='btn btn-danger mb-3' onclick='keluar()'>Absen Keluar</button>")
            $(".vid").children().remove()
            stopCamera()
          })
          // Jika ajax tidak berjalan dengan normal
          absenAjax.fail(function() {
            console.log("Fail")
          })
        } else {
          // Jika QRCode Invalid atau tidak sesuai dengan user/karyawan
          stopCamera();
          document.getElementById("status").innerHTML = "QR Code Invalid!!"
        }


      });
    } else {
      // Jika user tidak memiliki koneksi
      document.getElementById("status").innerHTML = "Periksa ulang koneksi internet anda..!!"
      $(".vid").children().remove()
    }
  </script>

      <!-- <script>
            // Mengaktifkan kamera
            let scanner = new Instascan.Scanner({ video: document.getElementById(".vid") });
            scanner.addListener("scan", function (content) {
              // Jika QR code berhasil di-scan, submit form
              $("#code").val(content);
              $("form").submit();
            });
            Instascan.Camera.getCameras().then(function (cameras) {
              if (cameras.length > 0) {
                scanner.start(cameras[0]);
              } else {
                console.error("No cameras found.");
              }
            }).catch(function (e) {
              console.error(e);
            });
      </script> -->