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
    <form class="form-horizontal" method="POST" action="<?php echo site_url('module/add'); ?>">
        <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title Module" title="Title Module" value="<?php echo $this->session->flashdata('title_module'); ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">_Controller</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="_controller" id="_Controller" placeholder="_Controller" title="_Controller" value="<?php echo $this->session->flashdata('_controller'); ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">_Function</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="_function" id="_Function" placeholder="_Function" title="_Function" value="<?php echo $this->session->flashdata('_function'); ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Order No.</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="_order_no" id="_order_no" value="<?php echo $order_no; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Group</label>
                <div class="col-md-6">
                    <?php foreach ($cb_group->result() as $row) : ?>
                    <div class="checkbox">
                        <label>
                            <input name="id_group[]" type="checkbox" class="ace" value="<?php echo $row->id_group ?>" />
                            <span class="lbl"> <?php echo $row->nm_group ?></span>
                        </label>
                    </div>
                    <?php $cb_group->free_result(); endforeach; ?>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Status</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="id_status">
                        <?php
                        $id=0;
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
                <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('module'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>
</div>
</div>