<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Kelas</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-monitor-kelas/add'); ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Kelas</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" title="nama_kelas" value="<?php echo $this->session->flashdata('nama_kelas'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Status</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_status">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_kelas->init_status_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_kelas->init_status_kelas($id); ?>
                              <option value="<?php echo $row->id_status ?>"><?php echo $row->nama_status ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jurusan</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_jurusan">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_kelas->init_jurusan($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_kelas->init_jurusan($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_jurusan ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-monitor-kelas'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>