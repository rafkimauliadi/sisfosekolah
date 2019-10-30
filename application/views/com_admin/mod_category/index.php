<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('category/add')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('category/search'); ?>" >
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
    <a href="<?php echo site_url('category')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Status</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </thead>
     
        <tfoot>
            <tr>
                <th width="5%">No</th>
                <th>Title</th>
                <th>Status</th>               
                <th>Action</th>
                <th>#ID</th>
            </tr>
        </tfoot>
     
        <tbody>
                <?php $no=$offset; foreach ($data->result() as $row) : $no++; 
                    if ($row->id_status=="1")
                        $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                    else
                        $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><a class="confirm-edit" href="<?php echo site_url('category/edit/'.$row->id_category); ?>"><?php echo $row->title; ?></a></td>
                    <td><?php echo $status; ?></td>
                    <td>
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                                Action
                                <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="confirm-edit" href="<?php echo site_url('category/edit/'.$row->id_category); ?>">Edit</a>
                                </li>

                                <li>
                                    <a class="confirm-delete" href="<?php echo site_url('category/delete/'.$row->id_category); ?>">Delete</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td><?php echo $row->id_category; ?></td>
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