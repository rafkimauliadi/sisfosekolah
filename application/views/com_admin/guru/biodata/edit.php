
<div class="col-12">
    <div class="card">
        <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Lengkapi Form Data Guru</h4>

        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('biodata-guru/edit'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
                <div class="form-body">
                    <h3 class="card-title">Identitas Peserta didik</h3>
                    <?php $CI =& get_instance(); echo $this->session->flashdata('pesan'); ?>
                    <hr>
                    <div class="row p-t-20">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">NIP</label>
                                <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="<?php echo $details->row()->nip; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Nama Lengkap</label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?php echo $details->row()->nama_lengkap; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Gelar Depan</label>
                                <input type="text" id="gelar_depan" name="gelar_depan" class="form-control" placeholder="Gelar Depan" value="<?php echo $details->row()->gelar_depan; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Gelar Belakang</label>
                                <input type="text" id="gelar_belakang" name="gelar_belakang" class="form-control" placeholder="Gelar Belakang" value="<?php echo $details->row()->gelar_belakang; ?>">
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    <div class="row">
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tempat Lahir</label>
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo $details->row()->tempat_lahir; ?>">
                            </div>
                        </div>
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
                                <option value="<?php echo $details->row()->jenis_kelamin ?>"><?php echo $details->row()->jenis_kelamin ?></option>
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
                                    <option value="<?php echo $details->row()->id_agama; ?>"><?php echo $details->row()->nama_agama; ?></option>
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
                                <label class="control-label">Alamat Guru</label>
                                <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat Guru" value="<?php echo $details->row()->alamat; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Status Pegawai</label>
                                <select class="form-control select2 custom-select" name="id_status_pegawai" data-placeholder="Choose a Status" tabindex="1">
                                    <option value="<?php echo $details->row()->id_status_pegawai; ?>"><?php echo $details->row()->status_pegawai; ?></option>
                                <?php 
                                    $id=$details->row()->status_pegawai;
                                    $cb_status_pegawai = $CI->model_combo_r->init_cb_status_pegawai($id);

                                    foreach ($cb_status_pegawai->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->status_pegawai; ?></option>
                                    <?php $cb_status_pegawai->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h3 class="box-title m-t-40">Jabatan Guru</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto </label>
                                <input type="file" name="img">
                                <small class="text-success">*Maksimal ukuran Foto 3Mb </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Mulai Mengajar</label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="yyyy-mm-dd" value="<?php echo $details->row()->tanggal_masuk; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Guru</label>
                                <select class="form-control select2 custom-select" name="status_guru" data-placeholder="Choose a Agama" tabindex="1">
                                    <option value="<?php echo $details->row()->status_guru; ?>"><?php echo $details->row()->status_guru; ?></option>
                                <?php 
                                    $id=$details->row()->status_guru;
                                    $cb_status_guru = $CI->model_combo_r->init_cb_status_guru($id);

                                    foreach ($cb_status_guru->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->status_guru; ?></option>
                                    <?php $cb_status_guru->free_result(); endforeach; ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jabatan Guru</label>
                                <select name="id_jabatan" id="id_jabatan_guru" class="form-control select2 custom-select" data-placeholder="Choose a Jabatan Guru" tabindex="1">
                                    <option value="<?php echo $details->row()->id_jabatan; ?>"><?php echo $details->row()->nama_jabatan ?></option>
                                    <?php 
                                    $id=$details->row()->id_jabatan_guru;
                                    $cb_jabatan_guru = $CI->model_combo_r->jabatan_guru($id);

                                    foreach ($cb_jabatan_guru->result() as $row) : ?>
                                        <option value="<?php echo $row->id_status ?>"><?php echo $row->nm_status; ?></option>
                                    <?php $cb_jabatan_guru->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Pendidikan Terakhir</label>
                                <input type="text" id="pendidikan" name="pendidikan" class="form-control" placeholder="Pendidikan Terakhir" value="<?php echo $details->row()->pendidikan; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Jurusan</label>
                                <input type="text" id="jurusan" name="jurusan" class="form-control" placeholder="Jurusan" value="<?php echo $details->row()->jurusan; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Tahun Tamat</label>
                                <input type="text" id="tamat" name="tamat" class="form-control" placeholder="Tahun Tamat" value="<?php echo $details->row()->tamat; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-success">
                                <label class="control-label">Unit Kerja</label>
                                <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" placeholder="Unit Kerja" value="<?php echo $details->row()->unit_kerja; ?>">
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