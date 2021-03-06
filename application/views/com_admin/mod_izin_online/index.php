<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Izin Online</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <h6 class="card-subtitle"></h6>
            <div class="d-flex no-block align-items-center">
                
                <div class="ml-auto">
                    <a href="<?php echo site_url('izin-online/add')?>"><button class="pull-right btn btn-circle btn-success" data-toggle="modal" data-target="#myModal"><i class="ti-plus"></i></button></a>
                </div>
            </div>
            <div class="table-responsive">
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Izin</th>
                            <th>Alasan Izin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_izin">
                      <?php $no = 0; foreach ($data->result() as $row){
                        $no++;
                      ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->nis; ?></td>
                            <td><?php echo $row->nama_siswa; ?></td>
                            <td><?php echo $row->tgl_izin; ?></td>
                            <td style="word-break:break-all;"><?php echo $row->alasan; ?></td>
                            <td>
                <button id="<?php echo $row->id; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
                <a href="<?php echo site_url('izin_online/edit/'.$row->id); ?>" class="button-edit btn btn-info btn-rounded"><i class="fa fa-edit"></i> Edit</a>
                            </td>
                        </tr>
            <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
  $(function() {
    $('#data-mobil-table').DataTable();
    
    $(".button-delete").click(function () {
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Anda Yakin menghapus data ini?',
            text: "data yang telah terhapus tidak dapat dikembalikan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
              window.location.href = "<?php echo site_url(); ?>izin-online/delete/"+id;
            }
        })
    });

  });

</script>