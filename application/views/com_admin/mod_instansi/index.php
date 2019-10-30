<?php 
    $value=$this->session->flashdata('change_box');
    $temp = str_replace("_", " ", $value);
    $label = ucfirst($temp);
?>
<p><?php echo $this->session->flashdata('pesan'); ?></p>
<div class="page-header">
       <a title="Tambah Data" href="<?php echo site_url('instansi/add/0')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
</div>   

<div class="page-header">
    <form class="form-inline" method="POST" action="<?php echo site_url('instansi/search'); ?>" >
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
    <a href="<?php echo site_url('instansi')?>" ><i class="fa fa-refresh"></i> Refresh</a>
    </form>   
</div>                        
<div class="table-responsive">
    <?php 

        function child_instansi($id_instansi)
        {
            $CI =& get_instance();
            $tabel_instansi='';

            $data = $CI->model_instansi->init_view_child($id_instansi);

            $no=0; foreach ($data->result() as $row) : $no++; 
                    $id_instansi    = $row->id_instansi;
                    $parent_id      = $row->parent_id;
                    $nama_instansi  = $row->nama_instansi;

                    
            $tabel_instansi.='<tr class="treegrid-'.$id_instansi.' treegrid-parent-'.$parent_id.'" >
                        <td>&nbsp;</td>
                        <td><a class="confirm-edit" href="'.site_url('instansi/edit/'.$id_instansi).'">'.$nama_instansi.'</a></td>
                        <td>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                                    Action
                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="confirm-edit" href="'.site_url('instansi/add/'.$id_instansi).'">Add Sub</a>
                                    </li>
                                    <li>
                                        <a class="confirm-edit" href="'.site_url('instansi/edit/'.$id_instansi).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete" href="'.site_url('instansi/delete/'.$id_instansi).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_instansi.'</td>
                    </tr>';   
            $exis = $CI->model_instansi->count_exists($id_instansi);
                if(count($exis != 0))
                    $tabel_instansi .= child_instansi($id_instansi);
                    $data->free_result(); endforeach;
            return $tabel_instansi;
        }

        $tabel_instansi='';
        $tabel_instansi.='<table id="tree" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>           
                    <th>Action</th>
                    <th>#ID</th>
                </tr>
            </thead>
         
            <tfoot>
                <tr>
                    <th width="5%">No</th>
                    <th>Title</th>           
                    <th>Action</th>
                    <th>#ID</th>
                </tr>
            </tfoot>
         
            <tbody>';
                    $no=$offset; foreach ($data->result() as $row) : $no++; 
                        $id_instansi    = $row->id_instansi;
                        $parent_id      = $row->parent_id;
                        $nama_instansi  = $row->nama_instansi;

                        
            $tabel_instansi.='<tr class="treegrid-'.$id_instansi.'">
                        <td>'.$no.'</td>
                        <td><a class="confirm-edit" href="'.site_url('instansi/edit/'.$id_instansi).'">'.$nama_instansi.'</a></td>
                        <td>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle">
                                    Action
                                    <i class="ace-icon fa fa-angle-down icon-on-right"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="confirm-edit" href="'.site_url('instansi/add/'.$id_instansi).'">Add Sub</a>
                                    </li>
                                    <li>
                                        <a class="confirm-edit" href="'.site_url('instansi/edit/'.$id_instansi).'">Edit</a>
                                    </li>

                                    <li>
                                        <a class="confirm-delete" href="'.site_url('instansi/delete/'.$id_instansi).'">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td>.'.$id_instansi.'</td>
                    </tr>';   

                    

                    $tabel_instansi.=child_instansi($id_instansi);
                        $data->free_result(); endforeach;    
                    
                        $data=$data->result();
                        if(!$data) { $tabel_instansi.='<tr><td colspan="9" align="center">Belum ada data.</td></tr>'; }   
                         
            $tabel_instansi.='</tbody>
        </table>';

        echo $tabel_instansi;
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
