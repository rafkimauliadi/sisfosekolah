<div class="card">
<div class="card-body">

<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('session_site/delete')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Restart Session</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('session_site/search'); ?>" >
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
    <a href="<?php echo site_url('session_site')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Value</th>
                <th>IP Address</th>
                <th>Time</th>     
            </tr>
        </thead>
     
        <tfoot>
            <tr>
                <th width="5%">No</th>
                <th>Value</th>
                <th>IP Address</th>
                <th>Time</th>          
            </tr>
        </tfoot>
     
        <tbody>
                <?php $no=$offset; foreach ($data->result() as $row) : $no++; ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->ip_address; ?></td>
                    <td><span class="label label-success arrowed"><?php echo date('d-m-Y H:i:s', $row->timestamp); ?></span></td>
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
</div>
</div>