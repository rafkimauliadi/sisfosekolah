<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Izin Tata Usaha</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('izin-tata-usaha/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Lengkap</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Tamu" title="nama" value="<?php echo $details->row()->nama; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Instansi / Asal</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="asal" id="asal" placeholder="Instansi atau Asal" title="asal" value="<?php echo $details->row()->asal; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Keperluan</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="keperluan" id="keperluan" placeholder="Keperluan" title="keperluan" value="<?php echo $details->row()->keperluan; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Urusan Menemui</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_urusan" id="tgl_urusan" placeholder="Tanggal Urusan Menemui" title="tgl_urusan" value="<?php echo $details->row()->tgl_urusan; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jam Urusan Menemui</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="time" class="form-control" name="jam_urusan" id="jam_urusan" placeholder="Jam Urusan Menemui" title="jam_urusan" value="<?php echo $details->row()->jam_urusan; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Status</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="status_izin">
                        <option value="<?php echo $details->row()->status_izin; ?>"><?php echo $details->row()->status_izin; ?></option>
                          <?php
                          $id = $details->row()->status_izin; 
                          $cb_status = $CI->model_izin_tata_usaha->init_status_izin($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_izin_tata_usaha->init_status_izin($id); ?>
                              <option value="<?php echo $row->id_status_izin ?>"><?php echo $row->status_izin ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('izin-tata-usaha'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>