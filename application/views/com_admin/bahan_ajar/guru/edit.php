
<div class="col-12">
    <div class="card">
        <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">Lengkapi Form Data Guru</h4>

        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="<?php echo site_url('bahan-ajar/edit'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $details->row()->id; ?>">
                <div class="form-body">
                    <h3 class="card-title">Bahan Ajar Siswa</h3>
                    <?php $CI =& get_instance(); echo $this->session->flashdata('pesan'); ?>
                    <hr>
                   
                    <!--/row-->
                   
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">Nip Guru</label>
                                <select class="form-control select2 custom-select" name="id_guru" data-placeholder="Choose a nip guru" tabindex="1">
                                <option value="<?php echo $details->row()->id_guru ?>"><?php echo $details->row()->nip ?> / <?php echo $details->row()->nama_lengkap ?></option>

                                <?php 
                                    $id=$details->row()->id_guru;
                                    $cb_guru = $CI->model_combo_r->init_cb_guru($id);

                                    foreach ($cb_guru->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nip ?> / <?php echo $row->nama_lengkap ?></option>
                                    <?php $cb_guru->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">Kelas</label>
                                <select class="form-control select2 custom-select" name="id_kelas" data-placeholder="Choose a Kelas" tabindex="1">
                                <option value="<?php echo $details->row()->id_kelas ?>"><?php echo $details->row()->nama_kelas ?></option>
                                <?php 
                                    $id=$details->row()->id_kelas;
                                    $cb_kelas = $CI->model_combo_r->init_cb_kelas($id);

                                    foreach ($cb_kelas->result() as $row) : ?>
                                        <option value="<?php echo $row->id_kelas ?>"><?php echo $row->nama_kelas; ?></option>
                                    <?php $cb_kelas->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group has-success">
                                <label class="control-label">Jurusan</label>
                                <select class="form-control select2 custom-select" name="id_jurusan" data-placeholder="Choose a Jurusan" tabindex="1">
                                <option value="<?php echo $details->row()->id_jurusan ?>"><?php echo $details->row()->nama_jurusan ?></option>
                                <?php 
                                    $id=$details->row()->id_jurusan;
                                    $cb_jurusan = $CI->model_combo_r->init_cb_jurusan($id);

                                    foreach ($cb_jurusan->result() as $row) : ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->nama_jurusan; ?></option>
                                    <?php $cb_jurusan->free_result(); endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>



                   
                   <h3 class="box-title m-t-40">Input File Bahan Ajar</h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto </label>
                                <input type="file" name="img">
                                <small class="text-success">*Maksimal ukuran Foto 3Mb </small>
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