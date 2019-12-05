<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="col-12">
    <div class="card">

        <div class="card-body">
            <h4 class="card-title">Kartu Ujian</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <h6 class="card-subtitle"></h6>

            <div class="d-flex no-block align-items-center">
                
                <div class="ml-auto">
                    <a href="<?php echo site_url('kartu-ujian/cetak')?>"><button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button></a>
                </div>
            </div>

        <link rel="stylesheet" href="<?php echo base_url('assets/css/print-bootstrap.css') ?>">
		<br><a href="<?php echo base_url('kartu-ujian/index'); ?>" class="btn btn-primary"><i class="fa  fa-chevron-left"></i></a>
		<button class="btn btn-danger" OnClick="javascript:window.print()" > Download PDF</button>
		<br>
		<table class="table">
			<tr>
				<th>Nama Lengkap</th>
				<td><?php echo $detail->nama_lengkap ?></td>
			</tr>
			<tr>
				<th>NIS</th>
				<td><?php echo $detail->nis ?></td>
			</tr>
			<tr>
				<th>NISN</th>
				<td><?php echo $detail->nisn ?></td>
			</tr>

			<tr>
				<th>tahun</th>
				<td><?php echo $detail2->tahun ?></td>
			</tr>
		</table>
		</script>
        </div>
    </div>
</div>
	          <a  class="btn btn-primary" onClick="window.open('<?php echo base_url('kartu-ujian/cetak')?>','mywindow','width=10000,location=no')"><i class="fa fa-print"></i> Cetak Kartu Ujian</a>

</body>
</html>