tinymce.init({
//------------------------------------------------
file_browser_callback: function(field, url, type, win) {
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
 tinyMCE.activeEditor.windowManager.open({
 file: 'http://localhost/system/myprogram/imgs/kc_tn/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
 title: 'KCFinder',
 width: 700,
 height: 500,
 inline: true,
 close_previous: false
 }, {
 window: win,
 input: field
 });
 return false;
 }, 
//------------------------------------------------
selector: "textarea",
relative_urls : false,
remove_script_host : false,
document_base_url : "",
theme: "modern",
width: 900,
height: 300,
plugins: [
"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
"save table contextmenu directionality emoticons template paste textcolor"
],
//content_css: "css/content.css",
content_css: "http://localhost/sumbar/imgs/kc_tn/tinymce/js/tinymce/skins/lightgray/skin.min.css",
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l ink image | print preview media fullpage | forecolor backcolor emoticons",
style_formats: [
{title: 'Bold text', inline: 'b'},
{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
{title: 'Example 1', inline: 'span', classes: 'example1'},
{title: 'Example 2', inline: 'span', classes: 'example2'},
{title: 'Table styles'},
{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
]
});