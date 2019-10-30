<div class="card">
                            <div class="card-body">
<p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('group/edit'); ?>">
        <input type="hidden" name="id" value="<?php echo $details->row()->id_group; ?>">
        
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title Group" title="Title Group" value="<?php echo $details->row()->nm_group; ?>">
                    </div>
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
                <a href="<?php echo site_url('group'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>
</div>
</div>