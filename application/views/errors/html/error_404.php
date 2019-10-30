<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>404 Page Not Found</title>
<?php $base_url = load_class('Config')->config['base_url']; ?>
<?php $link_error = $base_url.'block.gif' ?>
<link href="<?php echo $base_url.'assets/login/css/bootstrap.min.css' ?>" rel="stylesheet">
<link href="<?php echo $base_url.'assets/login/css/style.css' ?>" rel="stylesheet">
<link href="<?php echo $base_url.'assets/login/css/mediascreen.css'; ?>" rel="stylesheet">

<style type="text/css">
  html{
  }
  body{
      margin: 0;
      padding: 0;
      background: #e7ecf0;
      font-family: Arial, Helvetica, sans-serif;
  }
  *{
      margin: 0;
      padding: 0;
  }
  p{
      font-size: 12px;
      color: #373737;
      font-family: Arial, Helvetica, sans-serif;
      line-height: 18px;
  }
  p a{
      color: #218bdc;
      font-size: 12px;
      text-decoration: none;
  }
  a{
      outline: none;
  }
  .f-left{
      float:left;
  }
  .f-right{
      float:right;
  }
  .clear{
      clear: both;
      overflow: hidden;
  }
  #block_error{
      width: 845px;
      height: 384px;
      border: 1px solid #cccccc;
      margin: 72px auto 0;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      border-radius: 4px;
      background: #fff url(<?php echo $link_error; ?>) no-repeat 0 51px;
  }
  #block_error div{
      padding: 100px 40px 0 186px;
  }
  #block_error div h2{
      color: #218bdc;
      font-size: 24px;
      display: block;
      padding: 0 0 14px 0;
      border-bottom: 1px solid #cccccc;
      margin-bottom: 12px;
      font-weight: normal;
  }
</style>
</head>
<body marginwidth="0" marginheight="0">
    <div id="block_error">
      
        <div>
         <h2>Error 404. &nbsp; Oops sepertinya ada kesalahan</h2>
        <p>
        Halaman tidak bisa dikunjungi atau mengalami kerusakan tautan atau anda tidak memiliki akses.
        </p>
        </div>
        <p class="text-center"><a href="<?php echo $base_url; ?>"  class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span> Kembali ke halaman utama</a></p>
    </div>
</body>
    <script src="<?php echo $base_url.'assets/login/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo $base_url.'assets/login/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo $base_url.'assets/login/js/scripts.js'; ?>"></script>
    <script>
        function backtohome()
        {
            // window.history.go(-1)

        }
    </script>
</html>