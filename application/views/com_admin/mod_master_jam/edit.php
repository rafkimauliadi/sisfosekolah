<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Master Jam</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('master-jam/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jam</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="jam" id="jam" placeholder="Jam" title="jam" value="<?php echo $details->row()->jam; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Waktu Mulai</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="waktu_mulai" id="waktu_mulai" placeholder="waktu_mulai" title="waktu_mulai" value="<?php echo $details->row()->waktu_mulai; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">WAktu Akhir</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="waktu_akhir" id="waktu_akhir" placeholder="waktu_akhir" title="waktu_akhir" value="<?php echo $details->row()->waktu_akhir; ?>">
                      </div>
                </div>
          </div>



          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('master-jam'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>