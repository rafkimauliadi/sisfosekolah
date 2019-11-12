<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Legalisir Ijazah</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('legalisir-ijazah/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIS</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor Induk Siswa" title="nis" value="<?php echo $details->row()->nis; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nomor Ijazah</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="no_ijazah" id="no_ijazah" placeholder="Nomor Ijazah" title="no_ijazah" value="<?php echo $details->row()->no_ijazah; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tahun Terbit Ijazah</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="tahun_ijazah" id="tahun_ijazah" placeholder="Tahun Ijazah" title="tahun_ijazah" value="<?php echo $details->row()->tahun_ijazah; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Masuk Legalisir</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_masuk_legalisir" id="tgl_masuk_legalisir" placeholder="Tanggal Masuk Legalisir" title="tgl_masuk_legalisir" value="<?php echo $details->row()->tgl_masuk_legalisir; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Selesai Legalisir</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_selesai_legalisir" id="tgl_selesai_legalisir" placeholder="Tanggal Selesai Legalisir" title="tgl_selesai_legalisir" value="<?php echo $details->row()->tgl_selesai_legalisir; ?>">
                      </div>
                </div>
          </div>
          
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('legalisir-ijazah'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>