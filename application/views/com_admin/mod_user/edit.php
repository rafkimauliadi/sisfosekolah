<p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('user/edit'); ?>">
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $details->row()->id_user; ?>">
            <input type="hidden" name="password_lama" value="<?php echo $details->row()->password; ?>">
            <label class="col-md-2 control-label" for="textinput">Username</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" title="Username" value="<?php echo $details->row()->username; ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Password</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="password" id="password" placeholder="Password" title="Password">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Email</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" title="Email" value="<?php echo $details->row()->email; ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nomor Identitas</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" placeholder="Nomor Identitas" title="Nomor Identitas" value="<?php echo $details->row()->nomor_identitas; ?>">
                    </div>
                    <span><i>ex : Nik/Nobp/No.Sim/Nip/dll</i></span>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Group</label>
                <div class="col-md-6">
                    
                    <select name="id_group" class="form-control select-single" >
                        <option value="<?php echo $details->row()->id_group; ?>"><?php echo $details->row()->nm_group; ?></option>
                        <?php 
                                $id = $details->row()->id_group; 
                                $cb_group = $CI->model_combo->init_group_set($id); 
                        ?>
                        <?php foreach ($cb_group->result() as $row) : ?>
                            <option value="<?php echo $row->id_group ?>"><?php echo $row->nm_group ?></option>
                        <?php $cb_group->free_result(); endforeach; ?>
                    </select>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Parent</label>
                <div class="col-md-6">
                <?php $set_parent = $this->model_instansi->get_parent($details->row()->id_instansi); ?>
                    <select class="form-control select-single" name="parent_id">
                        <option value="<?php echo $details->row()->id_instansi; ?>"><?php echo $set_parent; ?></option>
                        <?php echo $cb_parent; ?>
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
                <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>