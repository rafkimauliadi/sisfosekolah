<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Tambahkan Tiket Bimbingan Konseling</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('bimbingan-konseling/add'); ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIS</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor Induk Siswa" title="nis" value="<?php echo $this->session->flashdata('nis'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIP GURU</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nip_guru" id="nip_guru" placeholder="Nomor Induk Pokok" title="nip_guru" value="<?php echo $this->session->flashdata('nip_guru'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Konsultasi</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="date" id="date" placeholder="Tanggal Konsultasi" title="date" value="<?php echo $this->session->flashdata('date'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Permasalahan</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <TextArea type="text" class="form-control" name="permasalahan" id="permasalahan" placeholder="Permasalahan" title="permasalahan" value="<?php echo $this->session->flashdata('permasalahan'); ?>"></TextArea>
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Penyelesaian</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <TextArea type="text" class="form-control" name="penyelesaian" id="penyelesaian" placeholder="Penyelesaian" title="penyelesaian" value="<?php echo $this->session->flashdata('penyelesaian'); ?>"></TextArea>
                      </div>
                </div>
          </div>


          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('bimbingan-konseling'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>