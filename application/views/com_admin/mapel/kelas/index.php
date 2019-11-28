<div class="col-12">
    <div class="card">
        <div class="card-body">
            <?php 
                $value=$this->session->flashdata('change_box');
                $temp = str_replace("_", " ", $value);
                $label = ucfirst($temp);
            ?>      
            <h4 class="card-title">Mata Pelajaran Kelas</h4>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <a title="Tambah Data" href="<?php echo site_url('mapel-kelas/add')?>" class="btn btn-primary btn-rounded m-t-10 float-right"><i class="fa fa-plus"></i> Add</a>

            <div class="page-header">
                <form class="form-inline" method="POST" action="<?php echo site_url('mapel-kelas/search'); ?>" >
                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                    <input type="text" class="form-control" name="search_box" value="<?php echo $this->session->flashdata('search_box'); ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Filter/Cari</button>
                        <a class="btn btn-danger" href="<?php echo site_url('mapel-kelas')?>" ><i class="fa fa-refresh"></i> Refresh</a>
                </form>   
            </div> 
            <hr/>
            <div class="table-responsive">
                <table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Pelajran</th>
                <th>Nama Guru</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </thead>
     
        <tfoot>
            <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>Mata Pelajran</th>
                <th>Nama Guru</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </tfoot>
     
        <tbody>
                <?php $no=$offset; foreach ($data->result() as $row) : $no++; 

                    // $tanggal = $row->created_modified;
                    // $gambar = $row->foto;
                    // $tahun = substr($tanggal, 0,4);
                    // $bulan = substr($tanggal, 5,2);
                    // $dir   = base_url('images/'.$tahun.'/'.$bulan.'/thumbnails/'.$gambar);

                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                  
                    <td><?php echo $row->nama_kelas; ?> 
                    <td><?php echo $row->nama_mapel; ?> </td>
                    <td><?php echo $row->nama_guru; ?> </td>
                    
                    <td>
					<button id-mapel="<?php echo $row->id; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>
					<a href="<?php echo site_url('mapel_kelas/edit/'.$row->id); ?>" class="button-edit btn btn-info btn-rounded"><i class="fa fa-edit"></i> Edit</a>
					
                    </td>
                    <td><?php echo $row->id; ?></td>
                </tr>   
                <?php $data->free_result(); endforeach; ?>   
                <?php 
                    $data=$data->result();
                    if(!$data || $data=="NULL") { echo "<tr><td colspan='14' align='center'>Belum ada data.</td></tr>"; } ?>  
                     
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
							window.location.href = "<?php echo site_url(); ?>mapel-kelas/delete/"+id_mapel;
						}
				})
		});

	});

</script>