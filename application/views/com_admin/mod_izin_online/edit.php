<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'?>">
</head>
<body>

<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Izin Online</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('izin-online/edit'); ?>">
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
              <label class="col-md-2 control-label" for="textinput">Tanggal Izin</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_izin" id="tgl_izin" placeholder="Tanggal Izin" title="tgl_izin" value="<?php echo $details->row()->tgl_izin; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Alasan</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <textarea type="text" class="form-control" name="alasan" id="alasan" placeholder="Alasan Izin" title="alasan"><?php echo $details->row()->alasan; ?></textarea>
                      </div>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('izin-online'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>

  <script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#nis').autocomplete({
                source: "<?php echo site_url('legalisir-ijazah/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $('[name="nis"]').val(ui.item.label); 
                    $('[name="nama_lengkap"]').val(ui.item.nama_lengkap);
                }
            });

    });
</script>  