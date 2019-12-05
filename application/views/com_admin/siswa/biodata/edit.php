
<div class="col-12">
    <div class="card">
        <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Lengkapi Form Data Siswa</h4>

        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('biodata-siswa/edit'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
                <div class="form-body">
                    <h3 class="card-title">Identitas Peserta didik</h3>
                    <?php $CI =& get_instance(); echo $this->session->flashdata('pesan'); ?>
                    <hr>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor induk Siswa</label>
                                <input type="text" id="nis" name="nis" class="form-control" placeholder="NIS" value="<?php echo $details->row()->nis; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor Induk Siswa Nasional</label>
                                <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN" value="<?php echo $details->row()->nisn; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-success">
                                <label class="control-label">Nama Lengkap Peserta Didik</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?php echo $details->row()->nama_lengkap; ?>">
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $details->row()->tempat_lahir; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="yyyy-mm-dd" value="<?php echo $details->row()->tanggal_lahir; ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Kelamin</label>
                                <select class="form-control select2 custom-select" name="jenis_kelamin" data-placeholder="Choose a Gender" tabindex="1">
                                <option value="<?php echo $details->row()->jenis_kelamin ?>"><?php echo $details->row()->nm_jenis_kelamin ?></option>
                                <?php 
                                    $id=$details->row()->jenis_kelamin;
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
                                <select class="form-control select2 custom-select" name="id_agama" data-placeholder="Choose a Agama" tabindex="1">
                                    <option value="<?php echo $details->row()->agama; ?>"><?php echo $details->row()->nama_agama; ?></option>
                                <?php 
                                    $id=$details->row()->agama;
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
                                    <option value="<?php echo $details->row()->status_dalam_keluarga; ?>"><?php echo $details->row()->status_anak; ?></option>
                                    <?php 
                                    $id=$details->row()->status_dalam_keluarga;
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
                                <input class="vertical-spin" type="text" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline" value="<?php echo $details->row()->anak_ke ?>" name="anak_ke">
                            </div>
                        </div>

                        <div class="col-md-6 has-success">
                            <div class="form-group">
                                <label class="control-label">Alamat Peserta Didik</label>
                                <input type="text" class="form-control" name="alamat_peserta_didik" id="alamat_peserta_didik" placeholder="Alamat Peserta Didik" value="<?php echo $details->row()->alamat ?>">
                            </div>
                        </div>

                        <div class="col-md-6 has-success">
                            <div class="form-group">
                                <label class="control-label">Nomor Telepon Rumah</label>
                                <input type="text" class="form-control" name="telp_rumah" id="telp_rumah" placeholder="Telepon Rumah" value="<?php echo $details->row()->no_telepon; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Sekolah Asal  (SMP/MTs)</label>
                                <input type="text" class="form-control" name="sekolah_asal" id="sekolah_asal" placeholder="Sekolah Asal" value="<?php echo $details->row()->asal_sekolah; ?>">
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
                                <input type="text" class="form-control" name="di_kelas" id="di_kelas" placeholder="Sekolah Asal" value="<?php echo $details->row()->kelas_diterima;; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Pada Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_diterima" id="tanggal_diterima" placeholder="yyyy-mm-dd" value="<?php echo $details->row()->tanggal_diterima; ?>">
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
                                <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?php echo $details->row()->nama_ayah; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label class="control-label">Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?php echo $details->row()->nama_ibu; ?>">
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label>Alamat </label>
                                <input name="alamat_orang_tua" type="text" class="form-control" placeholder="Alamat Orang Tua" value="<?php echo $details->row()->alamat_orang_tua; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-warning">
                                <label class="control-label">Nomor Telepon/HP</label>
                                <input type="text" class="form-control" name="telp_orang_tua" id="telp_orang_tua" placeholder="Telepon Orang Tua" value="<?php echo $details->row()->telp_orang_tua; ?>">
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
                                <input type="text" class="form-control" placeholder="Pekerjaan Ayah" name="pekerjaan_ayah" value="<?php echo $details->row()->pekerjaan_ayah; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-danger">
                                <label class="control-label">Ibu</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan Ibu" name="pekerjaan_ibu" value="<?php echo $details->row()->pekerjaan_ibu; ?>" >
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
                                <input type="text" class="form-control" placeholder="Nama Wali" name="nama_wali" value="<?php echo $details->row()->nama_wali; ?>">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nomor Telepon/HP</label>
                                <input type="text" class="form-control" name="telp_wali" id="telp_wali" placeholder="Telepon Wali" value="<?php echo $details->row()->telp_wali; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Alamat Wail</label>
                                <input type="text" class="form-control" name="alamat_wali" id="alamat_wali" placeholder="Alamat Wali" value="<?php echo $details->row()->alamat_wali; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Pekerjaan Wali</label>
                                <input type="text" class="form-control" name="pekerjaan_wali" id="pekerjaan_wali" placeholder="Pekerjaan Wali" value="<?php echo $details->row()->pekerjaan_wali; ?>">
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
                                    <option value="<?php echo $details->row()->id_status_peserta_didik; ?>"><?php echo $details->row()->status_peserta_didik ?></option>
                                    <?php 
                                    $id=$details->row()->id_status_peserta_didik;
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
                    <button type="submit" class="btn btn-primary" name="update" value='update' id="update">Perbarui</button>
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