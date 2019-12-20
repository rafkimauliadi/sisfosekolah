<div class="col-12">
    <div class="card">
        <div class="card-body">
        <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

        <?php 
                $value=$this->session->flashdata('change_box');
                $temp = str_replace("_", " ", $value);
                $label = ucfirst($temp);
            ?>      
            <h4 class="card-title">Master Jadwal Pelajaran</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <a title="Tambah Data" href="<?php echo site_url('master-jadwal-pelajaran/add')?>" class="btn btn-primary btn-rounded m-t-10 float-right"><i class="fa fa-plus"></i> Add</a>
            <div class="page-header">
                <form class="form-inline" method="POST" action="<?php echo site_url('master-jadwal-pelajaran/search'); ?>" >
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
                        <a class="btn btn-danger" href="<?php echo site_url('master-jadwal-pelajaran')?>" ><i class="fa fa-refresh"></i> Refresh</a>
             
        
                </form>   
            </div>
            <hr/>
            <div class="table-responsive">
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th colspan=2> Jam</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Nama Guru</th>
                            <th>Absen 1</th>
                            <th>Absen 2</th>
                            <th>Nis</th>
                            <th>Keterangan Materi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="data_mobil">
						<?php $no = 0; foreach ($data->result() as $row){
												$no++;
											?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->created_date; ?></td>
                            <td><?php echo $row->hari; ?></td>
                            <td><?php echo $row->jam; ?></td>
                            <td><?php echo $row->waktu_mulai; ?> - <?php echo $row->waktu_akhir; ?></td>
                            <td><?php echo $row->nama_kelas; ?> <?php echo $row->nama_jurusan; ?></td>
                            <td><?php echo $row->nama_mapel; ?></td>
                            <td><?php echo $row->gelar_depan; ?> <?php echo $row->nama_lengkap; ?> <?php echo $row->gelar_belakang; ?></td>
                            <!-- <td><?php echo $row->absen1; ?></td>
                            <td><?php echo $row->absen2; ?></td> -->
                            <!-- <td><?php echo $row->id; ?></td> -->

                            <td><?php if($row->absen1=="Ada Guru"){
                            echo '<button type="button" class="button-edit btn btn-info btn-rounded">Ada Guru</button>';
                            } else{
                                echo '<button type="button" class="button-edit btn btn-danger btn-rounded">Tidak Ada Guru</button>';

                            }
                            ?></td>
                                     <td><?php if($row->absen2=="Ada Guru"){
                            echo '<button type="button" class="button-edit btn btn-info btn-rounded">Ada Guru</button>';
                            } else{
                                echo '<button type="button" class="button-edit btn btn-danger btn-rounded">Tidak Ada Guru</button>';

                            }
                            ?></td>
                            
                            <td><?php echo $row->nis; ?></td>
                            <td><?php echo $row->keterangan_materi; ?></td>
                            <td>
                            <button id-mapel="<?php echo $row->id; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> 
                            <a href="<?php echo site_url('master_jadwal_pelajaran/delete/'.$row->id); ?>">Hapus
                            </button>
		                        <a href="<?php echo site_url('master_jadwal_pelajaran/edit/'.$row->id); ?>" class="button-edit btn btn-info btn-rounded"><i class="fa fa-edit"></i> Edit</a>
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
							window.location.href = "<?php echo site_url(); ?>master-jadwal-pelajaran/delete/"+id_mapel;
						}
				})
		});

	});

</script>