<p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>
<?php
    $id       = $this->format_data->string($this->uri->segment(3,0));

    if ($this->format_data->string($this->uri->segment(3,0))=="")
    {
        $parent_id =0;
    }
    else
    {
        $parent_id =$id;
    }
?>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('main-menu/edit'); ?>">
        <input type="hidden" name="id" value="<?php echo $details->row()->id_menu; ?>">
        
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title Group" title="Title Group" value="<?php echo $details->row()->menu_name; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Link</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="link" id="link" placeholder="Link" title="Link" value="<?php echo $details->row()->link; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Icon Menu</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon">fa-</span>
                        <input type="text" class="form-control" name="icon_menu" id="icon_menu" placeholder="Icon Menu" title="Icon Menu" value="<?php echo $details->row()->icon_menu; ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Type Menu</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="type_menu">
                        <option value="<?php echo $details->row()->type_menu ?>"><?php echo $details->row()->title_type_menu ?></option>
                        <?php
                        $id=$details->row()->type_menu;
                        $cb_type_menu = $CI->combo_menu->init_type_menu($id);
                        foreach ($cb_type_menu->result() as $row) : 
                        $CI->combo_menu->init_type_menu($id); ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->title ?></option>
                        <?php $cb_type_menu->free_result(); endforeach; ?>  
                    </select>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Target</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="target_menu">
                        <option value="<?php echo $details->row()->_target ?>"><?php echo $details->row()->title_target ?></option>
                        <?php
                        $id=$details->row()->_target;
                        $cb_target_menu = $CI->combo_menu->init_target_menu($id);
                        foreach ($cb_target_menu->result() as $row) : 
                        $CI->combo_menu->init_target_menu($id); ?>
                            <option value="<?php echo $row->id ?>"><?php echo $row->title ?></option>
                        <?php $cb_target_menu->free_result(); endforeach; ?>  
                    </select>
              </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Parent</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="parent_id">
                        <?php
                            $set_parent = $this->model_main_menu->get_parent($details->row()->parent_id)
                        ?>
                        <option value="<?php echo $details->row()->parent_id; ?>"><?php echo $set_parent; ?></option>
                        <option value="0">Root</option>
                        <?php echo $cb_main_menu; ?>
                    </select>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Order No.</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="_order_no" id="_order_no" value="<?php echo $details->row()->order_no; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Status</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="id_status">
                        <option value="<?php echo $details->row()->id_status ?>"><?php echo $details->row()->nm_status ?></option>
                        <?php
                        $id=$details->row()->id_status;
                        $cb_status = $CI->model_combo->init_status($id);
                        foreach ($cb_status->result() as $row) : 
                        $CI->model_combo->init_status($id); ?>
                            <option value="<?php echo $row->id_status ?>"><?php echo $row->nm_status ?></option>
                        <?php $cb_status->free_result(); endforeach; ?>  
                    </select>
              </div>
        </div>

        

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('main-menu'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>