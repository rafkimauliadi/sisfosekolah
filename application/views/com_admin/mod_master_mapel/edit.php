<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Mata Pelajaran</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('mata-pelajaran/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id_mata_pelajaran; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Mata Pelajaran</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" placeholder="Nama Mata Pelajaran" title="nama_mapel" value="<?php echo $details->row()->nama_mapel; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kode Mata Pelajaran</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="kode_mapel" id="kode_mapel" placeholder="Kode Mata Pelajaran" title="kode_mapel" value="<?php echo $details->row()->kode_mapel; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kelompok</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_kelompok">
                          <option value="<?php echo $details->row()->kelompok_mapel; ?>"><?php echo $details->row()->nama_kelompok; ?></option>
                          <?php
                          $id = $details->row()->kelompok_mapel; 
                          $cb_status = $CI->model_mapel->init_kelompok_mapel($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_combo->init_status($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_kelompok ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Peminatan</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_peminatan">
                          <option value="<?php echo $details->row()->id_peminatan; ?>"><?php echo $details->row()->nama_peminatan; ?></option>
                          <?php
                          $id = $details->row()->id_peminatan; 
                          $cb_status = $CI->model_mapel->init_peminatan_mapel($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_combo->init_status($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_peminatan ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('mata-pelajaran'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>