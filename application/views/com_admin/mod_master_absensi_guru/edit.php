<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Master absensi guru</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-absensi-guru/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
         
          
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Guru</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_guru">
                          <option value="<?php echo $details->row()->id; ?>"><?php echo $details->row()->nama_lengkap; ?></option>
                          <?php
                          $id=0;
                          $cb_status = $CI->model_absensi_guru->init_guru($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_absensi_guru->init_guru($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nip ?>    ||    <?php echo $row->nama_lengkap ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
          
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Absen</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="absen" id="absen" placeholder="Absen" title="absen" value="<?php echo $details->row()->absen; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-absensi-guru'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>