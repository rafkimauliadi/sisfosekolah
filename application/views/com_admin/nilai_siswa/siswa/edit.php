<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Edit Nilai Siswa</h4>
      <p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

      <form class="form-horizontal" method="POST" action="<?php echo site_url('nilai-siswa/edit'); ?>">
      <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">

          <div class="row">

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Kelas</label>
                                <select class="form-control select2 custom-select" name="id_kelas" data-placeholder="Choose a Kelas" tabindex="1">
                                <option value="<?php echo $details->row()->id_kelas ?>"><?php echo $details->row()->nama_kelas ?> 
                                <!-- &nbsp; <?php echo $details->nama_jurusan; ?> -->
                                </option>
                                <?php 
                                    $id=$details->row()->id_kelas;
                                    $cb_kelas = $CI->model_combo_r->init_cb_kelas2($id);

                                    foreach ($cb_kelas->result() as $row) : ?>
                                    
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nama_kelas; ?> &nbsp; <?php echo $row->nama_jurusan; ?></option>
                                    <?php $cb_kelas->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Mata Pelajaran</label>
                                <select class="form-control select2 custom-select" name="id_mapel" data-placeholder="Choose a Mapel" tabindex="1">
                                <option value="<?php echo $details->row()->id_mapel ?>"><?php echo $details->row()->nama_mapel ?></option>
                                <?php 
                                    $id=$details->row()->id_mapel;
                                    $cb_mapel = $CI->model_combo_r->init_cb_mapel($id);

                                    foreach ($cb_mapel->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nama_mapel; ?></option>
                                    <?php $cb_mapel->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
          </div>
        
          <div class="row">

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nip Guru</label>
                                <select class="form-control select2 custom-select" name="id_guru" data-placeholder="Choose a Nip Guru" tabindex="1">
                                <option value="<?php echo $details->row()->id_guru ?>"><?php echo $details->row()->nip; ?> || <?php echo $details->row()->nama_lengkap; ?></option>
                                <?php 
                                    $id=$details->row()->id_guru;
                                    $cb_guru = $CI->model_combo_r->init_cb_guru($id);

                                    foreach ($cb_guru->result() as $row) : ?>
                                    
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nip; ?> || <?php echo $row->nama_lengkap; ?></option>
                                    <?php $cb_guru->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tahun Ajaran</label>
                                <select class="form-control select2 custom-select" name="id_tahun_ajaran" data-placeholder="Choose a Tahun Ajaran" tabindex="1">
                                <option value="<?php echo $details->row()->id_tahun_ajaran ?>"><?php echo $details->row()->tahun; ?></option>
                                <?php 
                                    $id=$details->row()->id_tahun_ajaran;
                                    $cb_tahun = $CI->model_combo_r->init_cb_tahun_ajaran($id);

                                    foreach ($cb_tahun->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->tahun; ?></option>
                                    <?php $cb_tahun->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
          </div>

<div class="row">

<div class="col-md-6">
    <div class="form-group has-success">
        <label class="control-label">Nis dan Nama Siswa</label>
        <select class="form-control select2 custom-select" name="id_siswa_kelas" data-placeholder="Choose a Nis dan Nama Siswa" tabindex="1">
        <option value="<?php echo $details->row()->id_siswa_kelas ?>"><?php echo $details->row()->nis; ?>
        <!-- || <?php echo $details->nama_siswa; ?> -->
        </option>
                                <?php 
                                    $id=$details->row()->id_siswa_kelas;
            $cb_siswa = $CI->model_combo_r->init_cb_siswa2($id);

            foreach ($cb_siswa->result() as $row) : ?>
            
                <option value="<?php echo $row->id ?>"><?php echo $row->nis; ?> || <?php echo $row->nama_lengkap; ?></option>
            <?php $cb_siswa->free_result(); endforeach; ?>
        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group has-success">
    <label class="control-label">Nilai Siswa</label>
        <input type="text" id="nilai_siswa" name="nilai_siswa" class="form-control" placeholder="nilai_siswa" value="<?php echo $details->row()->nilai_siswa; ?>">
     </div>
</div>

</div>


          <div class="form-group">
              <div class="col-xs-offset-2 col-xs-10">
                  <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Update</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <a href="<?php echo site_url('nilai-siswa'); ?>" class="btn btn-primary">Back</a>
              </div>
          </div>

      </form>
    </div>
  </div>
</div>
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