<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Mobil</h4>
            <h6 class="card-subtitle"></h6>
            <button type="button" class="btn btn-info btn-rounded m-t-10 float-right" id="tambah-supir" data-toggle="modal" data-target="#add-contact" data-backdrop="static" data-keyboard="false">Tambahkan Supir Baru</button>
            <!-- Add Contact Popup Model -->
            <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                            <h4 class="modal-title" id="myModalLabel">Tambahkan Mobil Baru</h4>
                        </div>
												<form class="form-horizontal form-material">
												<input type="hidden" class="form-control" name="mode" id="mode" value='add'>
												<input type="hidden" class="form-control" name="mode" id="id_mobil" value=''>
                        <div class="modal-body">
															<div class="form-group">
																<div class="col-md-12 m-b-20">
																	<label for="plat_nomor">Plat Nomor</label>
																	<input type="text" class="form-control" placeholder="Plat Nomor" name="plat_nomor" id="plat_nomor" required>
																	<label class="error text-danger" for="plat_nomor" id="plat_nomor_error">Plat Nomor harus diisi.</label>
																</div>
																<div class="col-md-12 m-b-20">
																	<label for="tanggal_bergabung">Merk Mobil</label>
																	<input type="text" class="form-control" placeholder="Merk Mobil" name="merk_mobil" id="merk_mobil" required>
																	<label class="error text-danger" for="merk_mobil" id="merk_mobil_error">Merk Mobil harus diisi.</label>
																</div>
																<div class="col-md-12 m-b-20">
																	<label for="no_handphone">Tahun Mobil</label>
																	<input type="text" class="form-control" placeholder="Tahun Mobil" name="tahun_mobil" id="tahun_mobil" required>
																	<label class="error text-danger" for="tahun_mobil" id="tahun_mobil_error">Tahun Mobil harus diisi.</label>
																</div>
                                <div class="col-md-12 m-b-20">
																	<label for="no_handphone">Tahun Beli</label>
																	<input type="year" class="form-control" placeholder="Tahun Beli" name="tahun_beli" id="tahun_beli" required>
																	<label class="error text-danger" for="tahun_beli" id="tahun_beli_error">Tahun Beli harus diisi.</label>
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
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Merk Mobil</th>
                            <th>Tahun Mobil</th>
                            <th>Tahun Beli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_mobil">
											<?php $no = 0; foreach ($data->result() as $row){
												$no++;
											?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td>
                                <a href="javascript:void(0)"> <?php echo $row->nomor_plat; ?></a>
                            </td>
                            <td><?php echo $row->merk_mobil; ?></td>
                            <td><?php echo $row->tahun_mobil; ?></td>
                            <td><?php echo $row->tahun_beli; ?></td>
                            <td>
															<button id-mobil="<?php echo $row->id_mobil; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
															<button id-mobil="<?php echo $row->id_mobil; ?>" type="button" class="button-edit btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit"></i> Edit</button>
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
		$('.error').hide();
		
		$(".button-delete").click(function () {
				var id_mobil = $(this).attr('id-mobil');
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
								url: "<?php echo base_url() ?>mobil/delete",
								data: {'id_mobil':id_mobil},
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
				var id_mobil = $(this).attr('id-mobil');
				$("input#mode").val('edit');
				$("input#id_mobil").val(id_mobil);

				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>mobil/get_mobil",
					data: {'id_mobil':id_mobil},
					success: function(response) {
						$("input#plat_nomor").val(response.nomor_plat);
						$("input#merk_mobil").val(response.merk_mobil);
            $("input#tahun_mobil").val(response.tahun_mobil);
            $("input#tahun_beli").val(response.tahun_beli);
					}
				});
		});

		$("#tambah-mobil").click(function () {
				$("input#mode").val('add');
		});

    $("#button-save").click(function() {
			// validate and process form here
      $('.error').hide();
			var mode = $("input#mode").val();

			var plat_nomor = $("input#plat_nomor").val();
  		if (plat_nomor == "") {
        $("label#plat_nomor_error").show();
        $("input#plat_nomor").focus();
        return false;
      }
  		var merk_mobil = $("input#merk_mobil").val();
  		if (merk_mobil == "") {
        $("label#merk_mobil_error").show();
        $("input#merk_mobil").focus();
        return false;
      }
  		var tahun_mobil = $("input#tahun_mobil").val();
  		if (tahun_mobil == "") {
        $("label#tahun_mobil_error").show();
        $("input#tahun_mobil").focus();
        return false;
      }
      var tahun_beli = $("input#tahun_beli").val();
  		if (tahun_beli == "") {
        $("label#tahun_beli_error").show();
        $("input#tahun_beli").focus();
        return false;
      }
			
			if(mode == 'add')
			{
				add_mobil();
			}else if(mode == 'edit')
			{
				edit_mobil();
			}

			// end validation
			return false;
		});

		$(".modal_cancel").click(function () {
			$("input#plat_nomor").val('');
			$("input#merk_mobil").val('');
      $("input#tahun_mobil").val('');
      $("input#tahun_beli").val('');
		});

	});
	
	function add_mobil() {
		var plat_nomor = $("input#plat_nomor").val();
		var merk_mobil = $("input#merk_mobil").val();
    var tahun_mobil = $("input#tahun_mobil").val();
    var tahun_beli = $("input#tahun_beli").val();

		$.ajax({
			type: "POST",
			url: "<?php echo base_url() ?>mobil/save",
			data: {'plat_nomor':plat_nomor,'merk_mobil':merk_mobil, 'tahun_mobil':tahun_mobil, 'tahun_beli':tahun_beli},
			success: function() {
				$('#add-contact').modal('toggle');
				$("input#plat_nomor").val('');
				$("input#merk_mobil").val('');
        $("input#tahun_mobil").val('');
        $("input#tahun_beli").val('');
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

	function edit_mobil() {
		var id_mobil = $("input#id_mobil").val();
    var plat_nomor = $("input#plat_nomor").val();
    var merk_mobil = $("input#merk_mobil").val();
    var tahun_mobil = $("input#tahun_mobil").val();
    var tahun_beli = $("input#tahun_beli").val();

		$.ajax({
			type: "POST",
			url: "<?php echo base_url() ?>mobil/edit",
			data: {'id_mobil':id_mobil,'plat_nomor':plat_nomor,'merk_mobil':merk_mobil,'tahun_mobil':tahun_mobil, 'tahun_beli':tahun_beli},
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