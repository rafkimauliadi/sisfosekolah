<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('main-menu-admin/add/0')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('main-menu-admin/search'); ?>" >
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
    <a href="<?php echo site_url('main-menu-admin')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <?php 

        function child_main_menu_admin($id_menu)
        {
            $CI =& get_instance();
            $tabel_main_menu_admin='';

            $data = $CI->model_main_menu_admin->init_view_child($id_menu);

            $no=0; foreach ($data->result() as $row) : $no++; 
                    $id_menu        = $row->id_menu;
                    $parent_id      = $row->parent_id;
                    $menu_name      = $row->menu_name;
                    $link           = $row->link;
                    $icon_menu      = $row->icon_menu;
                    $order_no       = $row->order_no;
                    $id_group       = $row->id_group;
                    $display        = $row->display;


                    if ($row->id_status=="1")
                        $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                    else
                        $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";


                    if ($row->display=="1")
                        $display="<span class=\"label label-primary\">$row->title</span>";
                    else
                        $display="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->title</span>";

                    $ct = $CI->model_main_menu_admin->label_group($id_menu);

                    $nm_group = $ct->nama_group;
                    
            $tabel_main_menu_admin.='<tr class="treegrid-'.$id_menu.' treegrid-parent-'.$parent_id.'" >
                        <td>&nbsp;</td>
                        <td><a class="confirm-edit" href="'.site_url('main-menu-admin/edit/'.$id_menu).'">'.$menu_name.'</a></td>
                        <td>'.$link.'</td>
                        <td>'.$display.'</td>
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
                                        <a class="confirm-edit dropdown-item" href="'.site_url('main-menu-admin/edit/'.$id_menu).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete dropdown-item" href="'.site_url('main-menu-admin/delete/'.$id_menu).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_menu.'</td>
                    </tr>';   
            $exis = $CI->model_main_menu_admin->count_exists($id_menu);
                if(count($exis != 0))
                    $tabel_main_menu_admin .= child_main_menu_admin($id_menu);
                    $data->free_result(); endforeach;
            return $tabel_main_menu_admin;
        }

        $tabel_main_menu_admin='';
        $tabel_main_menu_admin.='<table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Display Dashboard</th>
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
                    <th>Link</th>
                    <th>Display Dashboard</th>
                    <th>Group</th>
                    <th>Status</th>               
                    <th>Order No.</th>               
                    <th>Action</th>
                    <th>#ID</th>
                </tr>
            </tfoot>
         
            <tbody>';
                    $no=$offset; foreach ($data->result() as $row) : $no++; 
                        $id_menu        = $row->id_menu;
                        $parent_id      = $row->parent_id;
                        $menu_name      = $row->menu_name;
                        $link           = $row->link;
                        $icon_menu      = $row->icon_menu;
                        $order_no       = $row->order_no;
                        $id_group       = $row->id_group;
                        $display        = $row->display;


                        if ($row->id_status=="1")
                            $status="<span class=\"label label-success arrowed\">$row->nm_status</span>";
                        else
                            $status="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->nm_status</span>";


                        if ($row->display=="1")
                            $display="<span class=\"label label-primary\">$row->title</span>";
                        else
                            $display="<span class=\"label label-warning\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> $row->title</span>";

                        $ct = $this->model_main_menu_admin->label_group($id_menu);

                        $nm_group = $ct->nama_group;
                        //echo $a=$ct->nm_group;
                        
            $tabel_main_menu_admin.='<tr class="treegrid-'.$id_menu.'">
                        <td>'.$no.'</td>
                        <td><a class="confirm-edit" href="'.site_url('main-menu-admin/edit/'.$id_menu).'">'.$menu_name.'</a></td>
                        <td>'.$link.'</td>
                        <td>'.$display.'</td>
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
                                        <a class="confirm-edit dropdown-item" href="'.site_url('main-menu-admin/add/'.$id_menu).'">Add Sub</a>
                                    </li>
                                    <li>
                                        <a class="confirm-edit dropdown-item" href="'.site_url('main-menu-admin/edit/'.$id_menu).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete dropdown-item" href="'.site_url('main-menu-admin/delete/'.$id_menu).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_menu.'</td>
                    </tr>';   

                    

                    $tabel_main_menu_admin.=child_main_menu_admin($id_menu);
                        $data->free_result(); endforeach;    
                    
                        $data=$data->result();
                        if(!$data) { $tabel_main_menu_admin.='<tr><td colspan="9" align="center">Belum ada data.</td></tr>'; }   
                         
            $tabel_main_menu_admin.='</tbody>
        </table>';

        echo $tabel_main_menu_admin;
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
