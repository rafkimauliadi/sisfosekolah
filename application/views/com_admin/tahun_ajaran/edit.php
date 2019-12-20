<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Master Tahun Ajaran</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('tahun-ajaran/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tahun Ajaran</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="tahun" id="tahun" placeholder="tahun" title="tahun" value="<?php echo $details->row()->tahun; ?>">
                      </div>
                </div>
          </div>
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput"> Bulan Periode Tahun</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="bulan" id="bulan" placeholder="bulan" title="bulan" value="<?php echo $details->row()->bulan; ?>">
                      </div>
                </div>
          </div><div class="form-group">
              <label class="col-md-2 control-label" for="textinput"> Semester</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="semester" id="semester" placeholder="semester" title="semester" value="<?php echo $details->row()->semester; ?>">
                      </div>
                </div>
          </div> 
          </div><div class="form-group">
              <label class="col-md-2 control-label" for="textinput"> Status</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="status" id="status" placeholder="status" title="status" value="<?php echo $details->row()->status; ?>">
                      </div>
                </div>
          </div>   
         
          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('tahun-ajaran'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>