<div class="col-12">
    <div class="card">
        <div class="card-body">
            <?php 
                $value=$this->session->flashdata('change_box');
                $temp = str_replace("_", " ", $value);
                $label = ucfirst($temp);
            ?>      
            <h4 class="card-title">Bahan Ajar Siswa</h4>
            <h6 class="card-subtitle">Semua Kelas</h6>
            <p><?php echo $this->session->flashdata('pesan'); ?></p>
            <a title="Tambah Data" href="<?php echo site_url('bahan-ajar/add')?>" class="btn btn-primary btn-rounded m-t-10 float-right"><i class="fa fa-plus"></i> Tambah Guru</a>

            <div class="page-header">
                <form class="form-inline" method="POST" action="<?php echo site_url('bahan-ajar/search'); ?>" >
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
                        <a class="btn btn-danger" href="<?php echo site_url('bahan-ajar')?>" ><i class="fa fa-refresh"></i> Refresh</a>
                </form>   
            </div> 
            <hr/>
            <div class="table-responsive">
                <!-- <table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> -->
                <table id="data-mobil-table" class="table table-bordered m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7">

                    <!-- VIEW -->
                   
               
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nip</th>
                            <th>Nama Guru</th>
                            <th>Nama Kelas</th>
                            <th>Nama Jurusan</th>
                            <th>File Bahan Ajar</th>
                            <th>Action</th>
                            <th>#ID</th>
                        </tr>
                    </thead>
                 
                    <tfoot>
                        <tr>
                        <th>No</th>
                            <th>Nip</th>
                            <th>Nama Guru</th>
                            <th>Nama Kelas</th>
                            <th>Nama Jurusan</th>
                            <th>File Bahan Ajar</th>
                            <th>Action</th>
                            <th>#ID</th>
                        </tr>
                    </tfoot>
                 
                    <tbody>
                            <?php $no=$offset; foreach ($data->result() as $row) : $no++; 

                                $tanggal = $row->created_modified;
                                $gambar = $row->foto;
                                $tahun = substr($tanggal, 0,4);
                                $bulan = substr($tanggal, 5,2);
                                $dir   = base_url('images/'.$tahun.'/'.$bulan.'/thumbnails/'.$gambar);

                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><a class="confirm-edit" href="<?php echo site_url('bahan-ajar/edit/'.$row->id); ?>"><?php echo $row->nip; ?></a>
                                <!-- <?php echo $row->nip; ?> -->
                                </td>
                                <td><?php echo $row->nama_lengkap; ?></td>
                                <td><?php echo $row->nama_kelas; ?> </td>
                                <td><?php echo $row->nama_jurusan; ?> </td>
                                <td>
                                    <!-- <?php if ($gambar != "") {  ?> <center><img width="80px" class="img-thumbnail" src="<?php echo $dir; ?>"> <?php } ?></center> -->
                                    <?php echo $row->foto; ?>

                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <ul class="dropdown-menu animated flipInX">
                                            <li>
                                                <a class="confirm-edit dropdown-item" href="<?php echo site_url('bahan-ajar/edit/'.$row->id); ?>">Edit</a>
                                            </li>

                                            <li>
                                                <!-- <a class="confirm-delete dropdown-item" href="<?php echo site_url('bahan-ajar/delete/'.$row->id); ?>">Delete</a> -->
                                                <button id-mapel="<?php echo $row->id; ?>" type="button" class="button-delete btn btn-danger btn-rounded"><i class="fa fa-trash"></i> Hapus</button>

                                            </li>

                                            <li>
                                                <a class="confirm-delete dropdown-item" href="<?php echo site_url('bahan-ajar/gambar/'.$row->id); ?>">Hapus Gambar</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td><?php echo $row->id; ?></td>
                            </tr>   
                            <?php $data->free_result(); endforeach; ?>   
                            <?php 
                                $data=$data->result();
                                if(!$data) { echo "<tr><td colspan='14' align='center'>Belum ada data.</td></tr>"; } ?>  
                       
                    </tbody>
                </table>
                <div class="space-6"></div>
                <?php echo $pagination; ?>
            </div>
            
        </div>
    </div>
</div>

<!-- <script>
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
                            window.location.href = "<?php echo site_url(); ?>bahan-ajar/delete/"+id_mapel;
                        }
                })
        });

    });

</script> -->


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
							window.location.href = "<?php echo site_url(); ?>bahan-ajar/delete/"+id_mapel;
						}
				})
		});

	});

</script>