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
    <form class="form-horizontal" method="POST" action="<?php echo site_url('instansi/add'); ?>">
        <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>">
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" title="Title" value="<?php echo $this->session->flashdata('title_instansi'); ?>">
              </div>
        </div>


       

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Order No.</label>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="_order_no" id="_order_no" value="<?php echo $order_no; ?>">
              </div>
        </div>

        
        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('instansi'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>