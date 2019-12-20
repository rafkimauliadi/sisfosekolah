<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>sMedia Upload</title>

		<!-- Section CSS -->
		<!-- jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/elFinder-2.1.49/css/elfinder.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/lib/elFinder-2.1.49/css/theme.css') ?>">

		<!-- Section JavaScript -->
		<!-- jQuery and jQuery UI (REQUIRED) -->
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--<![endif]-->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<!-- elFinder JS (REQUIRED) -->
		<script src="<?php echo base_url('assets/lib/elFinder-2.1.49/js/elfinder.min.js') ?>"></script>

		<!-- Extra contents editors (OPTIONAL) -->
		<script src="<?php echo base_url('assets/lib/elFinder-2.1.49/js/extras/editors.default.min.js') ?>"></script>

		<!-- GoogleDocs Quicklook plugin for GoogleDrive Volume (OPTIONAL) -->
		<!--<script src="js/extras/quicklook.googledocs.js"></script>-->

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript">
  var FileBrowserDialogue = {
    init: function() {
      // Here goes your code for setting your custom things onLoad.
    },
    mySubmit: function (URL) {
      // pass selected file path to TinyMCE
      parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);
      // force the TinyMCE dialog to refresh and fill in the image dimensions
      var t = parent.tinymce.activeEditor.windowManager.windows[0];
      t.find('#src').fire('change');
      // close popup window
      parent.tinymce.activeEditor.windowManager.close();
    }
  }
  $().ready(function() {
    var elf = $('#elfinder').elfinder({
      // set your elFinder options here
      url: '<?php echo site_url('media-upload/elfinder_connector'); ?>',  // connector URL
      getFileCallback: function(file) { // editor callback
        // file.url - commandsOptions.getfile.onlyURL = false (default)
        // file     - commandsOptions.getfile.onlyURL = true
        FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE 
      }
    }).elfinder('instance');      
  });
</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
