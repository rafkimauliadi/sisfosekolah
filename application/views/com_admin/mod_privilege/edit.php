<div class="card">
                            <div class="card-body">
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
    <form class="form-horizontal" method="POST" action="<?php echo site_url('privilege/edit'); ?>">
        <input type="hidden" name="id" value="<?php echo $details->row()->id_white; ?>">
        
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title Group" title="Title Group" value="<?php echo $details->row()->module_name; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">_Controller</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="_controller" id="_Controller" placeholder="_Controller" title="_Controller" value="<?php echo $details->row()->_controller; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">_Function</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="_function" id="_Function" placeholder="_Function" title="_Function" value="<?php echo $details->row()->_function; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Order No.</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="_order_no" id="_order_no" value="<?php echo $details->row()->order_no; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Parent Group</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="parent_id">
                        <?php
                            $set_parent_white_list = $this->model_privilege->get_parent_privilege($details->row()->parent_id)
                        ?>
                        <option value="<?php echo $details->row()->parent_id; ?>"><?php echo $set_parent_white_list; ?></option>
                        <option value="0">Root</option>
                        <?php echo $cb_white_list; ?>
                    </select>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Status</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="id_status">
                        <option value="<?php echo $details->row()->id_status; ?>"><?php echo $details->row()->nm_status; ?></option>
                        <?php
                        $id = $details->row()->id_status; 
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
                <a href="<?php echo site_url('privilege'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>
</div>
</div>