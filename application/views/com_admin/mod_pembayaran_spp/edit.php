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

      <form class="form-horizontal" method="POST" action="<?php echo site_url('pembayaran-spp/edit'); ?>">
          <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
          <div class="form-group">
              <label class="col-md-2 control-label" for="textinput">NIS</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="nis" id="nis" placeholder="Nomor Induk Siswa" title="nis" value="<?php echo $details->row()->nis; ?>" readonly>
                      </div>
                </div>
          </div>

          <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Kelas</label>
                                <select class="form-control select2 custom-select" name="id_kelas" data-placeholder="Choose a Gender" tabindex="1">
                                  <option value="<?php echo $details->row()->id_kelas; ?>"><?php echo $details->row()->nama_kelas; ?></option>
                                <?php 
                                    $id = $details->row()->id_kelas; 
                                    $cb_kelas = $CI->model_combo_r->init_cb_kelas($id);

                                    foreach ($cb_kelas->result() as $row) : ?>
                                        <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas ?></option>
                                    <?php $cb_kelas->free_result(); endforeach; ?>
                                </select>
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
              <label class="col-md-2 control-label" for="textinput">Uang SPP</label>
                  <div class="col-md-6">
                      <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                          <input type="text" class="form-control" name="total_bayar" id="total_bayar" placeholder="800000 (Rupiah)" title="total_bayar" value="<?php echo $details->row()->total_bayar; ?>">
                      </div>
                </div>
          </div>

          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('pembayaran-spp'); ?>" class="btn btn-primary">Back</a>
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
                source: "<?php echo site_url('pembayaran-spp/get_autocomplete');?>",
     
                select: function (event, ui) {
                    $('[name="nis"]').val(ui.item.label); 
                    $('[name="nama_lengkap"]').val(ui.item.nama_lengkap); 
                }
            });

    });
</script>  