<div class="card">
                            <div class="card-body">
<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('module/add/0')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('module/search'); ?>" >
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
    <a href="<?php echo site_url('module')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <?php 

        function child_white_list($id_white)
        {
            $CI =& get_instance();
            $tabel='';

            $data = $CI->model_module->init_view_child($id_white);

            $no=0; foreach ($data->result() as $row) : $no++; 
                    $id_module       = $row->id_module;
                    $parent_id      = $row->parent_id;
                    $module_name    = $row->module_name;
                    $_controller    = $row->_controller;
                    $_function      = $row->_function;
                    $order_no       = $row->order_no;
                    $id_group       = $row->id_group;

                    $ct = $CI->model_module->label_group($id_module);

                    $nm_group = $ct->nama_group;

                        if ($row->id_status=="1")
                            $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                        else
                            $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";
                    
            $tabel.='<tr class="treegrid-'.$id_module.' treegrid-parent-'.$parent_id.'" >
                        <td>&nbsp;</td>
                        <td><a class="confirm-edit" href="'.site_url('module/edit/'.$id_module).'">'.$module_name.'</a></td>
                        <td>'.$_controller.'</td>
                        <td>'.$_function.'</td>
                        <td>'.$nm_group.'</td>
                        <td>'.$status.'</td>
                        <td>'.$order_no.'</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu animated flipInX">
                                    <li>
                                        <a class="confirm-edit dropdown-item" href="'.site_url('module/edit/'.$id_module).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete dropdown-item" href="'.site_url('module/delete/'.$id_module).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_module.'</td>
                    </tr>';   
            $exis = $CI->model_module->count_exists($id_module);
                if(count($exis != 0))
                    $tabel .= child_white_list($id_module);
                    $data->free_result(); endforeach;
            return $tabel;
        }

        $tabel='';
        $tabel.='<table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>_Controller</th>
                    <th>_Function</th>
                    <th>Group</th>
                    <th>Status</th>               
                    <th>Order No.</th>               
                    <th>Action</th>
                    <th>#ID</th>
                </tr>
            </thead>
         
            <tfoot>
                <tr>
                    <th width="5%">No</th>
                    <th>Title</th>
                    <th>_Controller</th>
                    <th>_Function</th>
                    <th>Group</th>
                    <th>Status</th>  
                    <th>Order No.</th>             
                    <th>Action</th>
                    <th>#ID</th>
                </tr>
            </tfoot>
         
            <tbody>';
                    $no=$offset; foreach ($data->result() as $row) : $no++; 
                        $id_module        = $row->id_module;
                        $parent_id      = $row->parent_id;
                        $module_name    = $row->module_name;
                        $_controller    = $row->_controller;
                        $_function      = $row->_function;
                        $order_no       = $row->order_no;
                        $id_group       = $row->id_group;


                        if ($row->id_status=="1")
                            $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                        else
                            $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";
                        $ct = $this->model_module->label_group($id_module);

                        $nm_group = $ct->nama_group;
                        //echo $a=$ct->nm_group;
                        
            $tabel.='<tr class="treegrid-'.$id_module.'">
                        <td>'.$no.'</td>
                        <td><a class="confirm-edit" href="'.site_url('module/edit/'.$id_module).'">'.$module_name.'</a></td>
                        <td>'.$_controller.'</td>
                        <td>'.$_function.'</td>
                        <td>'.$nm_group.'</td>
                        <td>'.$status.'</td>
                        <td>'.$order_no.'</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu animated flipInX">
                                    <li>
                                        <a class="confirm-edit dropdown-item" href="'.site_url('module/add/'.$id_module).'">Add Sub</a>
                                    </li>
                                    <li>
                                        <a class="confirm-edit dropdown-item" href="'.site_url('module/edit/'.$id_module).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete dropdown-item" href="'.site_url('module/delete/'.$id_module).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_module.'</td>
                    </tr>';   

                    

                    $tabel.=child_white_list($id_module);
                        $data->free_result(); endforeach;    
                    
                        $data=$data->result();
                        if(!$data) { $tabel.='<tr><td colspan="9" align="center">Belum ada data.</td></tr>'; }   
                         
            $tabel.='</tbody>
        </table>';

        echo $tabel;
    ?>    
    <div class="space-6"></div>
    <?php echo $pagination; ?>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/backend/cookies/jquery.treegrid.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/backend/cookies/jquery.cookie.js'); ?>"></script>
<script type="text/javascript">
     $(document).ready(function() {
    $('#tree').treegrid({
      'initialState': 'collapsed',
      'saveState': true,
    });
  });
</script>
</div>
</div>