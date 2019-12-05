<div class="col-12">
    <div class="card">
        <div class="card-body">
        <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

        <?php 
                $value=$this->session->flashdata('change_box');
                $temp = str_replace("_", " ", $value);
                $label = ucfirst($temp);
            ?>      
            <h4 class="card-title">Nilai Siswa</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <a title="Tambah Data" href="<?php echo site_url('nilai-siswa/add')?>" class="btn btn-primary btn-rounded m-t-10 float-right"><i class="fa fa-plus"></i> Add</a>

            <div class="page-header">
                <form class="form-inline" method="POST" action="<?php echo site_url('nilai-siswa/search'); ?>" >
                    <!-- <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail3">Filter by</label>
                        <select id="change_box" name="change_box" class="form-control select-single">
                            <?php
                                foreach( $search as $row)
                                {
                                  $value = $row->name;
                                  $temp = str_replace("_", " ", $value);
                                  $label = ucfirst($temp);

                                  echo '<option value="'.$value.'">'.$label.'</option>';
                                }
                            ?>
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                    <input type="text" class="form-control" name="search_box" value="<?php echo $this->session->flashdata('search_box'); ?>">
                    </div> -->
                         
          <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Kelas</label>
                  <div class="col-md-4">
                  <select class="form-control select-single" name="id_kelas">
                  <option><-- Select Kelas --></option>
                          <?php
                          $id=0;
                          $cb_status = $CI->model_jadwal_pelajaran->init_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_jadwal_pelajaran->init_kelas($id); ?>
                              <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?> <?php echo $row->nama_jurusan ?> </option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                    <button type="submit" class="btn btn-success">Filter/Cari</button>
                        <a class="btn btn-danger" href="<?php echo site_url('nilai-siswa')?>" ><i class="fa fa-refresh"></i> Refresh</a>
             
        
                </form>   
            </div>
            
            <hr/>
            <div class="table-responsive">
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Nama Mapel</th>
                            <th>Nip Guru</th>
                            <th>Nilai Siswa</th>
                            <th>Nama Siswa</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_mobil">
											<?php $no = 0; foreach ($data->result() as $row){
												$no++;
											?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->nama_kelas; ?></td>
                            <td><?php echo $row->nama_mapel; ?></td>
                            <td><?php echo $row->nip; ?></td>
                            <td><?php echo $row->nilai_siswa; ?></td>
                            <td><?php echo $row->nama_siswa; ?></td>
                            <td><?php echo $row->tahun; ?></td>
                            <td>
							<button id-mapel="<?php echo $row->id; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
							<a href="<?php echo site_url('nilai_siswa/edit/'.$row->id); ?>" class="button-edit btn btn-info btn-rounded"><i class="fa fa-edit"></i> Edit</a>
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
							window.location.href = "<?php echo site_url(); ?>nilai-siswa/delete/"+id_mapel;
						}
				})
		});

	});

</script>

