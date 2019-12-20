
<div class="col-12">
    <div class="card">
        <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Lengkapi Form Data Siswa</h4>

        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('biodata-siswa/add'); ?>" enctype="multipart/form-data">
                <div class="form-body">
                    <h3 class="card-title">Identitas Peserta didik</h3>
                    <?php $CI =& get_instance(); echo $this->session->flashdata('pesan'); ?>
                    <hr>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor induk Siswa</label>
                                <input type="text" id="nis" name="nis" class="form-control" placeholder="NIS" value="<?php echo $this->session->flashdata('nis'); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor Induk Siswa Nasional</label>
                                <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN" value="<?php echo $this->session->flashdata('nisn'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label">Nama Lengkap Peserta Didik</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?php echo $this->session->flashdata('nama_lengkap'); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $this->session->flashdata('tempat_lahir'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="yyyy-mm-dd" value="<?php echo $this->session->flashdata('tanggal_lahir'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Kelamin</label>
                                <select class="form-control select2 custom-select" name="gender" data-placeholder="Choose a Gender" tabindex="1">
                                <?php 
                                    $id=0;
                                    $cb_gender = $CI->model_combo_r->init_cb_gender($id);

                                    foreach ($cb_gender->result() as $row) : ?>
                                        <option value="<?php echo $row->id_gender ?>"><?php echo $row->jenis_kelamin ?></option>
                                    <?php $cb_gender->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Agama</label>
                                <select class="form-control select2 custom-select" name="agama" data-placeholder="Choose a Agama" tabindex="1">
                                <?php 
                                    $id=0;
                                    $cb_agama = $CI->model_combo_r->init_cb_agama($id);

                                    foreach ($cb_agama->result() as $row) : ?>
                                        <option value="<?php echo $row->kd_agama ?>"><?php echo $row->agama; ?></option>
                                    <?php $cb_agama->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Status dalam Keluarga</label>
                                <select name="status_anak" class="form-control select2 custom-select" data-placeholder="Choose a Status Anak" tabindex="1">
                                    <?php 
                                    $id=0;
                                    $cb_status_anak = $CI->model_combo_r->init_cb_status_anak($id);

                                    foreach ($cb_status_anak->result() as $row) : ?>
                                        <option value="<?php echo $row->id_status_anak ?>"><?php echo $row->status_anak; ?></option>
                                    <?php $cb_status_anak->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Anak ke-</label>
                                <input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline" value="1" name="anak_ke">
                            </div>
                        </div>

                        <div class="col-md-6 has-success">
                            <div class="form-group">
                                <label class="control-label">Alamat Peserta Didik</label>
                                <input type="text" class="form-control" name="alamat_peserta_didik" id="alamat_peserta_didik" placeholder="Alamat Peserta Didik" value="<?php echo $this->session->flashdata('alamat_peserta_didik'); ?>">
                            </div>
                        </div>

                        <div class="col-md-6 has-success">
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon Rumah</label>
                                <input type="text" class="form-control" name="telp_rumah" id="telp_rumah" placeholder="Telepon Rumah" value="<?php echo $this->session->flashdata('telp_rumah'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Sekolah Asal  (SMP/MTs)</label>
                                <input type="text" class="form-control" name="sekolah_asal" id="sekolah_asal" placeholder="Sekolah Asal" value="<?php echo $this->session->flashdata('sekolah_asal'); ?>">
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <h3 class="box-title m-t-40">Di Terima di MA ini</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 has-danger">
                            <div class="form-group">
                                <label>Di Kelas</label>
                                <input type="text" class="form-control" name="di_kelas" id="di_kelas" placeholder="Terima di Kelas" value="<?php echo $this->session->flashdata('di_kelas'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Pada Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_diterima" id="tanggal_diterima" placeholder="yyyy-mm-dd" value="<?php echo $this->session->flashdata('tanggal_diterima'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <h3 class="box-title m-t-40">Orang Tua</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label>Ayah </label>
                                <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?php echo $this->session->flashdata('nama_ayah'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label class="control-label">Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?php echo $this->session->flashdata('nama_ibu'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label>Alamat </label>
                                <input name="alamat_orang_tua" type="text" class="form-control" placeholder="Alamat Orang Tua" value="<?php echo $this->session->flashdata('alamat_orang_tua'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label class="control-label">Nomor Telepon/HP</label>
                                <input type="text" class="form-control" name="telp_orang_tua" id="telp_orang_tua" placeholder="Telepon Orang Tua" value="<?php echo $this->session->flashdata('telp_orang_tua'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <h3 class="box-title m-t-40">Pekerjaan Orang Tua</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label>Ayah </label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Ayah" name="pekerjaan_ayah" value="<?php echo $this->session->flashdata('pekerjaan_ayah'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Ibu</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Ibu" name="pekerjaan_ibu" value="<?php echo $this->session->flashdata('pekerjaan_ibu'); ?>" >
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    
                    <h3 class="box-title m-t-40">Wali Peserta Didik</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label>Nama Wali </label>
                                <input type="text" class="form-control" placeholder="Nama Wali" name="nama_wali" value="<?php echo $this->session->flashdata('nama_wali'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor Telepon/HP</label>
                                <input type="text" class="form-control" name="telp_wali" id="telp_wali" placeholder="Telepon Wali" value="<?php echo $this->session->flashdata('telp_wali'); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Alamat Wail</label>
                                <input type="text" class="form-control" name="alamat_wali" id="alamat_wali" placeholder="Alamat Wali" value="<?php echo $this->session->flashdata('alamat_wali'); ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="Pekerjaan Wali" value="<?php echo $this->session->flashdata('pekerjaan_wali'); ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <h3 class="box-title m-t-40">Foto Peserta Didik</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto </label>
                                <input type="file" name="img">
                                <small class="text-success">*Maksimal ukuran Foto 3Mb </small>
                            </div>
                        </div>
                        
                        <div class="col-md-6 has-danger">
                            <div class="form-group">
                                <label>Status Siswa</label>
                                <select name="id_status_peserta_didik" id="init_cb_satus_peserta_didik" class="form-control select2 custom-select" data-placeholder="Choose a Status Status Siswa" tabindex="1">
                                    <?php 
                                    $id=0;
                                    $cb_peserta_didik = $CI->model_combo_r->init_cb_satus_peserta_didik($id);

                                    foreach ($cb_peserta_didik->result() as $row) : ?>
                                        <option value="<?php echo $row->id_status ?>"><?php echo $row->nm_status; ?></option>
                                    <?php $cb_peserta_didik->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Simpan</button>
                    <button type="button" class="btn btn-inverse">Batal</button>
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