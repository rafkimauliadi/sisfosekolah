<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Master Mata Pelajaran</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <h6 class="card-subtitle"></h6>
            <a title="Tambah Data" href="<?php echo site_url('mata-pelajaran/add')?>" class="btn btn-primary btn-rounded m-t-10 float-right"><i class="fa fa-plus"></i> Add</a>
            <div class="table-responsive">
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Kode</th>
                            <th>Kelompok</th>
                            <th>Peminatan</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_mobil">
											<?php $no = 0; foreach ($data->result() as $row){
												$no++;
											?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->nama_mapel; ?></td>
                            <td><?php echo $row->kode_mapel; ?></td>
                            <td><?php echo $row->nama_kelompok; ?></td>
                            <td><?php echo $row->nama_peminatan; ?></td>
                            <td><?php echo $row->created_at; ?></td>
                            <td>
															<button id-mapel="<?php echo $row->id_mata_pelajaran; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
															<a href="<?php echo site_url('mata-pelajaran/edit/'.$row->id_mata_pelajaran); ?>" class="button-edit btn btn-info btn-rounded"><i class="fa fa-edit"></i> Edit</a>
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
				var id_mapel = $(this).attr('id-mapel');
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
							window.location.href = "<?php echo site_url(); ?>mata-pelajaran/delete/"+id_mapel;
						}
				})
		});

	});

</script>