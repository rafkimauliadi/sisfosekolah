<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Supir</h4>
            <h6 class="card-subtitle"></h6>
            <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" id="tambah-supir" data-toggle="modal" data-target="#add-contact" data-backdrop="static" data-keyboard="false">Tambahkan Supir Baru</button>
            <!-- Add Contact Popup Model -->
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                            <h4 class="modal-title" id="myModalLabel">Tambahkan Supir Baru</h4>
                        </div>
												<form class="form-horizontal form-material">
												<input type="hidden" class="form-control" name="mode" id="mode" value='add'>
												<input type="hidden" class="form-control" name="mode" id="id_supir" value=''>
                        <div class="modal-body">
															<div class="form-group">
																<div class="col-md-12 m-b-20">
																	<label for="nama_supir">Nama Supir</label>
																	<input type="text" class="form-control" placeholder="Nama Supir" name="nama_supir" id="nama_supir" required>
																	<label class="error text-danger" for="nama_supir" id="name_error">Nama harus diisi.</label>
																</div>
																<div class="col-md-12 m-b-20">
																	<label for="tanggal_bergabung">Tanggal Bergabung</label>
																	<input type="date" class="form-control" placeholder="Tanggal Bergabung" name="tanggal_bergabung" id="tanggal_bergabung" required>
																	<label class="error text-danger" for="tanggal_bergabung" id="tanggal_error">Tanggal harus diisi.</label>
																</div>
																<div class="col-md-12 m-b-20">
																	<label for="no_handphone">Nomor Handphone</label>
																	<input type='tel' pattern='^\+?\d{0,12}' class="form-control" placeholder="No Handphone" id="no_handphone" name="no_handphone" required> 
																	<label class="error text-danger" for="no_handphone" id="hp_error">No HP harus diisi.</label>
																</div>
															</div>
                        </div>
                        </form>
												<div class="modal-footer">
                            <button type="button" class="btn btn-info waves-effect" id="button-save">Save</button>
                            <button type="button" class="btn btn-default waves-effect modal_cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="table-responsive">
                <table id="data-supir-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supir</th>
                            <th>Tanggal Bergabung</th>
                            <th>No Handphone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_supir">
											<?php $no = 0; foreach ($data->result() as $row){
												$no++;
											?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td>
                                <a href="javascript:void(0)"> <?php echo $row->nama_supir; ?></a>
                            </td>
                            <td><?php echo $row->tanggal_bergabung; ?></td>
                            <td><?php echo $row->no_hp; ?></td>
                            <td>
															<button id-supir="<?php echo $row->id_supir; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
															<button id-supir="<?php echo $row->id_supir; ?>" type="button" class="button-edit btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i> Edit</button>
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
		$('#data-supir-table').DataTable();
		$('.error').hide();
		
		$(".button-delete").click(function () {
				var id_supir = $(this).attr('id-supir');
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
							$.ajax({
								type: "POST",
								url: "<?php echo base_url() ?>supir/delete",
								data: {'id_supir':id_supir},
								success: function() {
									Swal.fire(
										'Deleted!',
										'Data berhasil dihapus.',
										'success'
									)
									setTimeout(function(){ refresh_table(); }, 1000);
								}
							});
						}
				})
		});

		$(".button-edit").click(function () {
				var id_supir = $(this).attr('id-supir');
				$("input#mode").val('edit');
				$("input#id_supir").val(id_supir);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>supir/get_supir",
					data: {'id_supir':id_supir},
					success: function(response) {
						$("input#nama_supir").val(response.nama_supir);
						$("input#tanggal_bergabung").val(response.tanggal_bergabung);
						$("input#no_handphone").val(response.no_hp);
					}
				});
		});

		$("#tambah-supir").click(function () {
				$("input#mode").val('add');
		});

    $("#button-save").click(function() {
			// validate and process form here
      $('.error').hide();
			var mode = $("input#mode").val();

			var name = $("input#nama_supir").val();
  		if (name == "") {
        $("label#name_error").show();
        $("input#nama_supir").focus();
        return false;
      }
  		var tanggal_bergabung = $("input#tanggal_bergabung").val();
  		if (tanggal_bergabung == "") {
        $("label#tanggal_error").show();
        $("input#tanggal_bergabung").focus();
        return false;
      }
  		var phone = $("input#no_handphone").val();
  		if (phone == "") {
        $("label#hp_error").show();
        $("input#no_handphone").focus();
        return false;
      }
			
			if(mode == 'add')
			{
				add_supir();
			}else if(mode == 'edit')
			{
				edit_supir();
			}

			// end validation
			return false;
		});

		$(".modal_cancel").click(function () {
			$("input#nama_supir").val('');
			$("input#tanggal_bergabung").val('');
			$("input#no_handphone").val('');
		});

	});
	
	function add_supir() {
		var name = $("input#nama_supir").val();
		var tanggal_bergabung = $("input#tanggal_bergabung").val();
		var phone = $("input#no_handphone").val();

		$.ajax({
			type: "POST",
			url: "<?php echo base_url() ?>supir/save",
			data: {'nama_supir':name,'tanggal_bergabung':tanggal_bergabung, 'no_handphone':phone},
			success: function() {
				$('#add-contact').modal('toggle');
				$("input#nama_supir").val('');
				$("input#tanggal_bergabung").val('');
				$("input#no_handphone").val('');
				$.toast({
						heading: 'Sukses Menyimpan'
						, text: 'Data Berhasil disimpan..'
						, position: 'top-right'
						, loaderBg: '#ff6849'
						, icon: 'info'
						, hideAfter: 1000
						, stack: 6
				})
				setTimeout(function(){ refresh_table(); }, 1000);
			}
		});
	}

	function edit_supir() {
		var id_supir = $("input#id_supir").val();
		var name = $("input#nama_supir").val();
		var tanggal_bergabung = $("input#tanggal_bergabung").val();
		var phone = $("input#no_handphone").val();

		$.ajax({
			type: "POST",
			url: "<?php echo base_url() ?>supir/edit",
			data: {'id_supir':id_supir,'nama_supir':name,'tanggal_bergabung':tanggal_bergabung, 'no_handphone':phone},
			success: function() {
				$('#add-contact').modal('toggle');
				$("input#nama_supir").val('');
				$("input#tanggal_bergabung").val('');
				$("input#no_handphone").val('');
				$.toast({
						heading: 'Sukses Mengupdate'
						, text: 'Data Berhasil diupdate..'
						, position: 'top-right'
						, loaderBg: '#ff6849'
						, icon: 'info'
						, hideAfter: 1000
						, stack: 6
				})
				setTimeout(function(){ refresh_table(); }, 1000);
			}
		});
	}

	function refresh_table()
	{
		location.reload();
	}
</script>