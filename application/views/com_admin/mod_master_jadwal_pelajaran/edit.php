<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Master Jadwal Mapel</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-jadwal-pelajaran/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput"> Hari</label>
              <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="hari" id="hari" placeholder="Hari" title="hari" value="<?php echo $details->row()->hari; ?>">
                      </div>
                </div>
          </div>
       
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jam</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_jam">
                      <option value="<?php echo $details->row()->id_jam ?>"><?php echo $details->row()->waktu_mulai ?> - <?php echo $details->row()->waktu_akhir ?> </option>

                          <?php
                          $id = $details->row()->id_jam; 
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
                  <option value="<?php echo $details->row()->id_kelas; ?>"><?php echo $details->row()->nama_kelas; ?></option>

                          <?php
                          $id = $details->row()->id_kelas; 
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
                  <option value="<?php echo $details->row()->id_mapel_kelas; ?>"><?php echo $details->row()->nama_mapel; ?></option>

                          <?php
                          $id = $details->row()->id_mapel_kelas; 
                          $cb_status = $CI->model_jadwal_pelajaran->init_mapel($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_jadwal_pelajaran->init_mapel($id); ?>
                              <option value="<?php echo $row->id ?>"><?php echo $row->nama_mapel ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
        </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Absen 1</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="absen1" id="absen1" placeholder="absen1" title="absen1" value="<?php echo $details->row()->absen1; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Absen 2</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="absen2" id="absen2" placeholder="absen2" title="absen2" value="<?php echo $details->row()->absen2; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nis Siswa</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="nis" title="nis" value="<?php echo $details->row()->nis; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Keterangan Materi</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="keterangan_materi" id="keterangan_materi" placeholder="keterangan_materi" title="keterangan_materi" value="<?php echo $details->row()->keterangan_materi; ?>" readonly>
                      </div>
                </div>
          </div>
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-jadwal-pelajaran'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>