<div class="card">
<div class="card-body">
	<p><?php echo $this->session->flashdata('pesan'); ?></p>
    <form class="form-horizontal" method="POST" action="<?php echo site_url('administrator/update-profile'); ?>">
    
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nama</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="nama" id="Nama" placeholder="Nama" value="<?php echo $nama =$this->model_hook->init_profile_user()->full_name; ?>">
                    </div>
              </div>
        </div>
            
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Email</label>
                <div class="col-md-6"><input type="hidden" name="MAX_FILE_SIZE" value="21474836480" />
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email =$this->model_hook->init_profile_user()->email; ?>">
                    </div>
              </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Telepon</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                        <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon =$this->model_hook->init_profile_user()->telp; ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Alamat</label>
                <div class="col-md-6">
                    <textarea style="width:500px; height: 100px;" name="alamat"><?php echo filter_var($alamat =$this->model_hook->init_profile_user()->alamat, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); ?></textarea>
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

</div>
</div>