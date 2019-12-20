<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan</title>
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>
<body>
  <p><?php echo $this->session->flashdata('pesan'); ?></p>
  <img src="assets/img/logo.jpg" style="position: absolute; width: 60px; height: auto;">
  <table style="width: 100%;">
    <tr>
      <td align="center">
        <span style="line-height: 1.6; font-weight: bold;">
          MAN 3 KOTA PADANG
          <br>PROVINSI SUMATERA BARAT
        </span>
      </td>
    </tr>
  </table>

  <hr class="line-title"> 
  <p align="center">
    KARTU UJIAN SISWA <br>
    <b>2019</b>
  </p>
  <table class="table table-bordered">
    <tr>
        <th>Nama Lengkap</th>
        <td><?php echo $siswa->nama_lengkap ?></td>
      </tr>
      <tr>
        <th>NIS</th>
        <td><?php echo $siswa->nis ?></td>
      </tr>
      <tr>
        <th>NISN</th>
        <td><?php echo $siswa->nisn ?></td>
      </tr>

      <tr>
        <th>tahun</th>
        <td><?php echo $siswa2->tahun ?></td>
      </tr>
  </table>
  <script type="text/javascript">
    window.print();
  </script>

</body>
</html>