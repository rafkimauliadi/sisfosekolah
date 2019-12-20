<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('content/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('content/search'); ?>" >
        <div class="form-group">
            <label class="sr-only" for="exampleInputEmail3">Email address</label>
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
    <button type="submit" class="btn btn-default">Filter/Cari</button>
    <a href="<?php echo site_url('content')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Category</th>
                <th>Post Date</th>
                <th>Created By</th>
                <th>Foto</th>
                <th>Hits</th>
                <th>Status</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </thead>
     
        <tfoot>
            <tr>
                <th width="5%">No</th>
                <th>Title</th>
                <th>Category</th>
                <th>Post Date</th>
                <th>Created By</th>
                <th>Foto</th>
                <th>Hits</th>
                <th>Status</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </tfoot>
     
        <tbody>
                <?php $no=$offset; foreach ($data->result() as $row) : $no++; 

                    $tanggal = $row->created_modified;
                    $gambar = $row->gambar;
                    $tahun = substr($tanggal, 0,4);
                    $bulan = substr($tanggal, 5,2);
                    $dir   = base_url('images/'.$tahun.'/'.$bulan.'/thumbnails/'.$gambar);

                    if ($row->id_status=="4")
                        $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                    else
                        $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><a class="confirm-edit" href="<?php echo site_url('content/edit/'.$row->id_content); ?>"><?php echo $row->title; ?></a></td>
                    <td><?php echo $row->title_category; ?></td>
                    <td><?php echo $row->created_date; ?></td>
                    <td><?php echo $row->full_name; ?></td>
                    <td><?php if ($gambar != "") {  ?> <center><img width="40px" class="img-thumbnail" src="<?php echo $dir; ?>"> <?php } ?></center></td>
                    <td><?php echo $row->hits; ?></td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                
                            </button>
                            <ul class="dropdown-menu animated flipInX">
                                <li>
                                    <a class="confirm-edit dropdown-item" href="<?php echo site_url('group/edit/'.$row->id_group); ?>">Edit</a>
                                </li>

                                <li>
                                    <a class="confirm-delete dropdown-item" href="<?php echo site_url('group/delete/'.$row->id_group); ?>">Hapus Data</a>
                                </li>
                                <li>
                                    <a class="confirm-delete" href="<?php echo site_url('content/gambar/'.$row->id_content); ?>">Hapus Foto</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td><?php echo $row->id_content; ?></td>
                </tr>   
                <?php $data->free_result(); endforeach; ?>   
                <?php 
                    $data=$data->result();
                    if(!$data) { echo "<tr><td colspan='9' align='center'>Belum ada data.</td></tr>"; } ?>  
                     
        </tbody>
    </table>

    
    <div class="space-6"></div>
    <?php echo $pagination; ?>
</div>