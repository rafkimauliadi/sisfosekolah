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
      <h4 class="card-title">Tambahkan Legalisir Ijazah</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('legalisir-ijazah/add'); ?>">
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
              <label class="col-md-2 control-label" for="textinput">Nomor Ijazah</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="no_ijazah" id="no_ijazah" placeholder="Nomor Ijazah" title="no_ijazah" value="<?php echo $this->session->flashdata('no_ijazah'); ?>" readonly>
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tahun Terbit Ijazah</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="tahun_ijazah" id="tahun_ijazah" placeholder="Tahun Ijazah" title="tahun_ijazah" value="<?php echo $this->session->flashdata('tahun_ijazah'); ?>" readonly>
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Masuk Legalisir</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_masuk_legalisir" id="tgl_masuk_legalisir" placeholder="Tanggal Masuk Legalisir" title="tgl_masuk_legalisir" value="<?php echo $this->session->flashdata('tgl_masuk_legalisir'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tanggal Selesai Legalisir</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="date" class="form-control" name="tgl_selesai_legalisir" id="tgl_selesai_legalisir" placeholder="Tanggal Selesai Legalisir" title="tgl_selesai_legalisir" value="<?php echo $this->session->flashdata('tgl_selesai_legalisir'); ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Status</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="status_legalisir">
                          <?php
                          $id=0;
                          $cb_status = $CI->model_legalisir->init_status_legalisir($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_legalisir->init_status_legalisir($id); ?>
                              <option value="<?php echo $row->id_status_legalisir ?>"><?php echo $row->status_legalisir ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('legalisir-ijazah'); ?>" class="btn btn-primary">Back</a>
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
                    $('[name="no_ijazah"]').val(ui.item.no_ijazah); 
                    $('[name="tahun_ijazah"]').val(ui.item.tahun_ijazah); 
                }
            });

    });
</script>  
