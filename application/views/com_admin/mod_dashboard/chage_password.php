<script src="<?php echo base_url('assets/backend/password_metter.js'); ?>"></script>
<script type="text/javascript"></script>
	<p><?php echo $this->session->flashdata('pesan'); ?></p>

	<form class="form-horizontal" method="POST" action="<?php echo site_url('administrator/save-password'); ?>">
    
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Password Baru</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		                <input type="text" class="form-control" name="password" id="password" placeholder="Password"  data-toggle="popover" title="Password Strength" data-content="Enter Password...">
		            </div>
              </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary" name="submit" value='Update' id="Update">Update</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('administrator'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>