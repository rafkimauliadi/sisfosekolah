<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    relative_urls : false,
    remove_script_host : false,
    document_base_url : "",
    theme: "modern",
    width: 800,
    height: 300,
    file_browser_callback : elFinderBrowser,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor codesample"
    ],

    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons codesample",
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]

});

function elFinderBrowser (field_name, url, type, win) {
  tinymce.activeEditor.windowManager.open({
    file: '<?php echo site_url('media_upload'); ?>',// use an absolute path!
    title: 'elFinder 2.0',
    width: 900,  
    height: 450,
    resizable: 'yes'
  }, {
    setUrl: function (url) {
      win.document.getElementById(field_name).value = url;
    }
  });
  return false;
}
</script>
<p><?php $CI =& get_instance();  echo $this->session->flashdata('pesan'); ?></p>

    <form class="form-horizontal" method="POST" action="<?php echo site_url('content/add'); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Title</label>
                <div class="col-md-6">
                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></span>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title" title="Title" value="<?php echo $this->session->flashdata('title_content'); ?>">
                    </div>
              </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label" for="id_category">Category</label>
          <div class="col-md-6"> 
                <select name="id_category" class="select-single form-control" id="id_category" data-placeholder="Pilih Category..." >
                    <option value="">--Pilih Category--</option>
                    <?php
                        $id=0;
                        $cb_category = $CI->model_combo->init_category($id);
                        foreach ($cb_category->result() as $row) : ?>
                            <option value="<?php echo $row->id_category ?>"><?php echo $row->title ?></option>
                        <?php $cb_category->free_result(); endforeach; ?>
                </select> 
          </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Foto</label>
                <div class="col-md-6"><input type="hidden" name="MAX_FILE_SIZE" value="21474836480" />
                    <input type="file" name="img"><span class="help-block"><i>*Maksimal ukuran image 3Mb !</i></span>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Text</label>
                <div class="col-md-6">
                    <textarea id="editor1" name="content" rows="15" cols="80"><?php echo $this->session->flashdata('content'); ?></textarea>
              </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label" for="textinput">Status</label>
                <div class="col-md-6">
                    <select class="form-control select-single" name="id_status">
                        <?php
                        $id=0;
                        $cb_status = $CI->model_combo->init_status_publish($id);
                        foreach ($cb_status->result() as $row) : 
                        $CI->model_combo->init_status($id); ?>
                            <option value="<?php echo $row->id_status ?>"><?php echo $row->nm_status ?></option>
                        <?php $cb_status->free_result(); endforeach; ?>  
                    </select>
              </div>
        </div>

        <div class="form-group">
            <div class="col-xs-offset-2 col-xs-10">
                <button type="submit" class="btn btn-primary" name="save" value='save' id="save">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="<?php echo site_url('content'); ?>" class="btn btn-primary">Back</a>
            </div>
        </div>

    </form>