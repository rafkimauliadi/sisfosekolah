<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Mata Pelajaran</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('mapel-kelas/add'); ?>">
      <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Kelas</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_kelas">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_mapel_kelas->init_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_mapel_kelas->init_kelas($id); ?>
                              <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Mata Pelajaran</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_mata_pelajaran">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_mapel_kelas->init_mapel($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_mapel_kelas->init_mapel($id); ?>
                              <option value="<?php echo $row->id_mata_pelajaran ?>"><?php echo $row->nama_mapel ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Guru</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_guru">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_mapel_kelas->init_guru($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_mapel_kelas->init_guru($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_lengkap ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('mapel-kelas'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>