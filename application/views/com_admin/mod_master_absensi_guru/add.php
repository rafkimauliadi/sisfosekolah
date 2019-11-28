<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan absensi guru</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-absensi-guru/add'); ?>">
          

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIp dan Nama Guru</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_guru">
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
                      
                      <select class="form-control select-single" name="absen">
                         
                              <option value="Hadir">Hadir</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Tidak Hadir">Tidak Hadir</option>
                      </select>
                </div>
          </div>
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-absensi-guru'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>