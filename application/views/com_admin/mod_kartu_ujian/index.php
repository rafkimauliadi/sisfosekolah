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
      <h4 class="card-title">Cetak Kartu Ujian</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>
      <br>
      <form class="form-horizontal" method="POST" action="<?php echo site_url('kartu-ujian/cetak_kartu'); ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIS</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor Induk Siswa" title="nis" value="<?php echo $this->session->flashdata('nis'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Lengkap</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" title="nama_lengkap" value="<?php echo $this->session->flashdata('nama_lengkap'); ?>" readonly>
                      </div>
                </div>
          </div>
          <div class="form-group">
              <div class="col-md-6">
                  <div class="form-group has-success">
                      <label class="control-label">Tahun Ajaran</label>
                        <select class="form-control select2 custom-select" name="tahun" data-placeholder="Choose a tahun" tabindex="1">
                                <?php 
                                    $id=0;
                                    $cb_tahun = $CI->model_combo_r->init_cb_tahun_ajaran($id);

                                    foreach ($cb_tahun->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->tahun; ?></option>
                                    <?php $cb_tahun->free_result(); endforeach; ?>
                         </select>
              </div>
            </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Cetak</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('kartu-ujian'); ?>" class="btn btn-primary">Back</a>
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

<script type="text/javascript">
    $(".select2").select2();

    $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    var vspinTrue = $(".vertical-spin").TouchSpin({
        verticalbuttons: true
    });
    if (vspinTrue) {
        $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
    }
</script>