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
      <h4 class="card-title">Edit Pembayaran SPP</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('pembayaran-spp-kelas/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Kelas</label>
                  <div class="col-md-6">
                    <select class="form-control select-single" name="id_kelas">
                         <option value="<?php echo $details->row()->id_kelas; ?>"><?php echo $details->row()->nama_kelas; ?></option>
                          <?php
                          $id = $details->row()->nama_kelas; 
                          $cb_status = $CI->model_pembayaran_spp_kelas->init_kelas($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_pembayaran_spp_kelas->init_kelas($id); ?>
                              <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>  
                      </select>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Nama Guru</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="id_guru" id="id_guru" placeholder="Nama Guru" title="id_guru" value="<?php echo $details->row()->id_guru; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Bulan</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <select class="form-control" name="bulan">
                          <option value="<?php echo $details->row()->bulan; ?>"><?php echo $details->row()->bulan; ?></option>
                          <option value="Januari">Januari</option>
                          <option value="Februari">Februari</option>
                          <option value="Maret">Maret</option>
                          <option value="April">April</option>
                          <option value="Mei">Mei</option>
                          <option value="Juni">Juni</option>
                          <option value="Juli">Juli</option>
                          <option value="Agustus">Agustus</option>
                          <option value="September">September</option>
                          <option value="Oktober">Oktober</option>
                          <option value="November">November</option>
                          <option value="Desember">Desember</option>
                        </select>
                          
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Tahun</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <select class="form-control" name="tahun">
                          <option value="<?php echo $details->row()->tahun; ?>"><?php echo $details->row()->tahun; ?></option>
                          <option value="2019">2019</option>
                          <option value="2018">2018</option>
                          <option value="2017">2017</option>
                          <option value="2016">2016</option>
                          <option value="2015">2015</option>
                          
                        </select>
                          
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Jumlah yang sudah dibayar</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="jml_bayar" id="jml_bayar" placeholder="800000 (Rupiah)" title="jml_bayar" value="<?php echo $details->row()->jml_bayar; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Total Dana Total Sebenarnya</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="jml_keseluruhan" id="jml_keseluruhan" placeholder="1000000 (Rupiah)" title="jml_keseluruhan" value="<?php echo $details->row()->jml_keseluruhan; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">Status</label>
                  <div class="col-md-6">
                      <select class="form-control select-single" name="id_status_spp_kelas">
                         <option value="<?php echo $details->row()->id_status_spp_kelas; ?>"><?php echo $details->row()->status_spp_kelas; ?></option>
                          <?php
                          $id = $details->row()->status_spp_kelas; 
                          $cb_status = $CI->model_pembayaran_spp_kelas->init_status_pembayaran($id);
                          foreach ($cb_status->result() as $row) : 
                          $CI->model_pembayaran_spp_kelas->init_status_pembayaran($id); ?>
                              <option value="<?php echo $row->id_status_spp_kelas ?>"><?php echo $row->status_spp_kelas ?></option>
                          <?php $cb_status->free_result(); endforeach; ?>
                      </select>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('pembayaran-spp-kelas'); ?>" class="btn btn-primary">Back</a>
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