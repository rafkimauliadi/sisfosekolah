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
                          <input type="text" class="form-control" name="tanda_guru" id="tanda_guru" placeholder="tanda_guru" title="tanda_guru" value="<?php echo $this->session->flashdata('tanda_guru'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kelas</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_kelas">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_monitor_kelas->init_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_monitor_kelas->init_kelas($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_kelas ?></option>
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