<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
	<title><?php echo $identitas->row()->title; ?></title>

	<link href="<?php echo base_url('favicon.png'); ?>" rel="shortcut icon">
	<link href="<?php echo base_url('assets/login/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/login/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/login/css/mediascreen.css'); ?>" rel="stylesheet">
    
    <meta property="og:url"           content="<?php echo site_url(); ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $identitas->row()->title; ?>" />
    <meta property="og:description"   content="<?php echo $identitas->row()->keterangan; ?>" />
    <meta property="og:keyword"   content="<?php echo $identitas->row()->keyword; ?>" />
    <meta property="og:image"         content="<?php echo base_url('favicon.png'); ?>" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>"><img style="width:60px;height:60px;" src="<?php echo base_url('favicon.png'); ?>"></a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
			      <form id="signin" class="navbar-form navbar-right" role="form" method="POST" action="<?php echo site_url('management/cek_login'); ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="username" type="text" class="form-control" name="username" value="<?php echo $this->session->flashdata('username'); ?>" placeholder="Username">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Login</button>
                      <a class="text" href="<?php echo site_url('reset'); ?>" ><small>Lupa Akun ?</small></a>
                   </form>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
        	<div class="col-md-8">
                <p><?php echo $this->session->flashdata('pesan'); ?></p>
                
                <h2>Informasi/Quote Hari ini <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span></h2>
                
                <?php $no=0; foreach ($info_pesan->result() as $row) : $no++; ?>
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                           <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $row->title; ?></h4>
                        <?php echo $row->pesan; ?>
                    </div>
                </div>
                <hr/>

            <?php $info_pesan->free_result(); endforeach; ?>
            <?php if ($info_pesan->result()==NULL) echo "tidak ada pesan hari ini." ?>
            </div>

			<div class="col-md-4">
              <h4><?php echo $identitas->row()->title; ?> </h4>
              <p><?php echo $identitas->row()->keterangan; ?></p>
            </div>
        </div>
    </div>
    <br/>
    <footer id="footer" class="navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="col-md-12">
           Copyright &copy; <span class="info">2010 - <?php echo $versi->row()->tahun; ?></span>. | <span class="info"><?php echo $identitas->row()->title; ?></span> |

            Versi : <span class="info"><?php echo $versi->row()->title; ?></span> || Page rendered in <strong>{elapsed_time}</strong> seconds.
            </div>
        </div>
    </footer>
    <script src="<?php echo base_url('assets/login/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/login/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/login/js/scripts.js'); ?>"></script>
</body>

</html>