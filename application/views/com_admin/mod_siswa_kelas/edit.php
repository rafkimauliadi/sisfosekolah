<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Siswa</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('siswa-kelas/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
         
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kelas</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_kelas">
                      <option value="<?php echo $details->row()->id_kelas ?>"><?php echo $details->row()->nama_kelas ?> | <?php echo $details->row()->nama_jurusan ?></option>

            <?php
          $id=$details->row()->id_kelas;
                          $cb_status = $CI->model_combo_r->init_cb_kelas2($id);
                          foreach ($cb_status->result() as $row) : 
                      ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_kelas ?> | <?php echo $row->nama_jurusan ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>


          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Siswa</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_siswa">
                      <option value="<?php echo $details->row()->id_siswa ?>"><?php echo $details->row()->nis ?> | <?php echo $details->row()->nama_lengkap ?></option>

<?php
          $id=$details->row()->id_siswa;
                          $cb_status = $CI->model_combo_r->init_cb_siswa($id);
                          foreach ($cb_status->result() as $row) : 
 ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nis ?> | <?php echo $row->nama_lengkap ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tahun Ajaran</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_tahun_ajaran">
                      <option value="<?php echo $details->row()->id_tahun_ajaran ?>"><?php echo $details->row()->tahun ?></option>

                          <?php
                                    $id=$details->row()->id_tahun_ajaran;
                                    $cb_status = $CI->model_combo_r->init_cb_tahun_ajaran($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_combo->init_status($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->tahun ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
      
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-jam'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>