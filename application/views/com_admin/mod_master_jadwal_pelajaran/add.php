<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Jadwal Pelajaran</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-jadwal-pelajaran/add'); ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput"> Hari</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="hari" id="hari" placeholder="hari" title="hari" value="<?php echo $this->session->flashdata('hari'); ?>">
                      </div>
                </div>
          </div>
       
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jam</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_jam">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_jadwal_pelajaran->init_jam($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_jadwal_pelajaran->init_jam($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->waktu_mulai ?> - <?php echo $row->waktu_akhir ?> </option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kelas</label>
                  <div class="col-md-6">
                  <select class="form-control select-single" name="id_kelas">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_jadwal_pelajaran->init_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_jadwal_pelajaran->init_kelas($id); ?>
                              <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?> <?php echo $row->nama_jurusan ?> </option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

        <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Mapel</label>
                  <div class="col-md-6">
                  <select class="form-control select-single" name="id_mapel_kelas">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_jadwal_pelajaran->init_mapel($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_jadwal_pelajaran->init_mapel($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_mapel ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanda Guru</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="tanda_guru" id="tanda_guru" placeholder="tanda_guru" title="tanda_guru" value="<?php echo $this->session->flashdata('tanda_guru'); ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-jadwal-pelajaran'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>
