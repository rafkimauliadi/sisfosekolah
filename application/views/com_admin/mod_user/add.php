<p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('user/add'); ?>">
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Username</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" title="Username" value="<?php echo $this->session->flashdata('username'); ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Password</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" title="Password" value="<?php echo $this->session->flashdata('password'); ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Email</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email" title="Email" value="<?php echo $this->session->flashdata('email'); ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Nomor Identitas</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="nomor_identitas" id="nomor_identitas" placeholder="Nomor Identitas" title="Nomor Identitas" value="<?php echo $this->session->flashdata('nomor_identitas'); ?>">
                    </div>
                    <span><i>ex : Nik/Nobp/No.Sim/Nip/dll</i></span>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Group</label>
                <div class="col-md-6">
                    
                    <select name="id_group" class="form-control select-single" >
                        <?php foreach ($cb_group->result() as $row) : ?>
                            <option value="<?php echo $row->id_group ?>"><?php echo $row->nm_group ?></option>
                        <?php $cb_group->free_result(); endforeach; ?>
                    </select>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Parent</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="parent_id">
                        <?php echo $cb_parent; ?>
                    </select>
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
                <a href="<?php echo site_url('user'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>