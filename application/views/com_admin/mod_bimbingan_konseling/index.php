<div class="row">

  <div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex no-block align-items-center">
                <div>
                    <h5 class="card-title m-b-0">Daftar Pelayanan Anda</h5>
                </div>
                <div class="ml-auto">
                    <a href="<?php echo site_url('bimbingan-konseling/add')?>"><button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button></a>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Table -->
            <!-- ============================================================== -->
            <div class="table-responsive">
                <table id="example23"
                    class="display nowrap table table-hover table-striped table-bordered"
                    cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal</th>
                            <th>Permasalahan</th>
                            <th>Penyelesaian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($data->result() as $row) : $no++; ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->nis; ?></td>
                            <td><?php echo $row->nama_lengkap; ?></td>
                            <td><?php echo $row->date; ?></td>
                            <td><?php echo $row->permasalahan; ?></td>
                            <td><?php echo $row->penyelesaian; ?></td>
                            <td>Detail</td>
                        </tr>
                      <?php $data->free_result(); endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
</div>
<script>
  $('#example23').DataTable({
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
  });
  $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
</script>