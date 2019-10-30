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
    <form class="form-horizontal" method="POST" action="<?php echo site_url('instansi/edit'); ?>">
        <input type="hidden" name="id" value="<?php echo $details->row()->id_instansi; ?>">
        
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" title="Title" value="<?php echo $details->row()->nama_instansi; ?>">
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Parent</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="parent_id">
                        <?php
                            $set_parent = $this->model_instansi->get_parent($details->row()->parent_id)
                        ?>
                        <option value="<?php echo $details->row()->parent_id; ?>"><?php echo $set_parent; ?></option>
                        <option value="0">Root</option>
                        <?php echo $cb_parent; ?>
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
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('instansi'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>