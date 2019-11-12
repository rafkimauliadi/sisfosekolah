<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Izin Tata Usaha</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('izin-tata-usaha/add'); ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIS</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor Induk Siswa" title="nis" value="<?php echo $this->session->flashdata('nis'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIP Guru</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nip_guru" id="nip_guru" placeholder="NIP Guru" title="nip_guru" value="<?php echo $this->session->flashdata('nip_guru'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Izin</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_izin" id="tgl_izin" placeholder="Tanggal Izin" title="tgl_izin" value="<?php echo $this->session->flashdata('tgl_izin'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Urusan</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="urusan" id="urusan" placeholder="urusan Izin" title="urusan" value="<?php echo $this->session->flashdata('urusan'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Status Izin</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="status_izin" id="status_izin" placeholder="Status Izin" title="status_izin" value="<?php echo $this->session->flashdata('status_izin'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('izin-tata-usaha'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>