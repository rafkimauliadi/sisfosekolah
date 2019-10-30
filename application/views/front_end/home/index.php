<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <meta name="google-site-verification" content="EHgoJVNTZf35W6dFM5o-Hekx3N5GvjAlF06j7lplzOk" />
	<title><?php echo $identitas->row()->title; ?></title>

	<link href="<?php echo base_url('favicon.png'); ?>" rel="shortcut icon">
	<link href="<?php echo base_url('assets/homepage/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/homepage/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/homepage/css/mediascreen.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/homepage/css/custom.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('assets/homepage/js/jquery.min.js'); ?>"></script>

    

    
    <meta property="og:url"           content="<?php echo site_url(); ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $identitas->row()->title; ?>" />
    <meta property="og:description"   content="<?php echo $identitas->row()->keterangan; ?>" />
    <meta property="og:keyword"   content="<?php echo $identitas->row()->keyword; ?>" />
    <meta property="og:image"         content="<?php echo base_url('favicon.png'); ?>" />
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-31174417-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-31174417-2');
    </script>
    
</head>

<body>
    <div class="preloader">
        <div class="loading">
            <div class="sk-fading-circle">
                <div class="sk-circle1 sk-circle"></div>
                <div class="sk-circle2 sk-circle"></div>
                <div class="sk-circle3 sk-circle"></div>
                <div class="sk-circle4 sk-circle"></div>
                <div class="sk-circle5 sk-circle"></div>
                <div class="sk-circle6 sk-circle"></div>
                <div class="sk-circle7 sk-circle"></div>
                <div class="sk-circle8 sk-circle"></div>
                <div class="sk-circle9 sk-circle"></div>
                <div class="sk-circle10 sk-circle"></div>
                <div class="sk-circle11 sk-circle"></div>
                <div class="sk-circle12 sk-circle"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $(".preloader").fadeOut("slow");
        })
    </script>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
                      <!-- <a class="navbar-brand" href="<?php //echo site_url(); ?>"><i class="icon-home icon-white"> </i> <img style="max-width:150px; margin-top: -5px;" src="<?php //echo base_url('favicon.png'); ?>"></a> -->
                      <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url('logo.png'); ?>" alt="<?php echo $identitas->row()->title; ?>"></a>
					</div>
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
						    
						    <?php 
						        function child_menu($id_menu)
                                {
                                    $CI =& get_instance();
                                    $menu_public ='';   
                                    $menu_public.='<ul class="dropdown-menu">';
                                    
                                    $data_menu=$CI->display_menu->init_child($id_menu);
                                    
                                    foreach ($data_menu->result() as $row) :
                                        $ct=$CI->display_menu->count_child($row->id_menu);
                                        
                                        
                                        if ($ct > 0)
        						        {
        						            $dropdown='dropdown  dropdown-submenu';
        						            $attribut='class="dropdown-toggle" data-toggle="dropdown"';
        						        }
        						        else
        						        {
        						            $dropdown='';
        						            $attribut='';
        						        }
        						        
        						        if ($row->type_menu=="1")
        						            $link=site_url($row->link);
                                        else
                                            $link=$row->link;
                                        
                                        
                                        $menu_public.='<li class="menu-item '.$dropdown.'"><a '.$attribut.' href="'.$link.'" target="'.$row->target_menu.'"><i class="fa '.$row->icon_menu.'"></i> '.$row->menu_name.'</a>';
                                        
                                        if ($ct > 0)
                                            $menu_public.=child_menu($row->id_menu);
                                        
                                        $menu_public.='</li>';
                                            
                                        $data_menu->free_result(); endforeach;
                                        
                                        $menu_public.='</ul>';
                                        return $menu_public;
                                }
                                
						        $data_menu=$this->display_menu->init_parent(); 
						        $menu_public ='';
                                $active='';
						    
						        foreach ($data_menu->result() as $row) :
						        
						        $ct=$this->display_menu->count_child($row->id_menu);
						        
                                if ($row->order_no=='1')
                                {
                                    $active='active';
                                }
                                else
                                {
                                    $active='';   
                                }

						        if ($ct > 0)
						        {
						            $dropdown='dropdown';
						            $attribut='class="dropdown-toggle" data-toggle="dropdown"';
						            $caret='<b class="caret"></b>';
						        }
						        else
						        {
						            $dropdown='';
						            $attribut='';
						            $caret='';
						        }
						        
						        if ($row->type_menu=="1")
						            $link=site_url($row->link);
                                else
                                    $link=$row->link;
						        
						        $menu_public.='<li class="'.$active.' menu-item '.$dropdown.'"><a '.$attribut.' href="'.$link.'" target="'.$row->target_menu.'"><i class="fa '.$row->icon_menu.'"></i> '.$row->menu_name.' '.$caret.'</a>';
						        
						        if ($ct > 0)
                                    $menu_public.=child_menu($row->id_menu);
                                
						        $menu_public.='</li>';
						        
						        $data_menu->free_result(); endforeach;
						        echo $menu_public;
						    ?>
						    
                        </ul>
                        <!-- <ul class="nav navbar-nav navbar-right">
                            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul> -->
		  </div>
	   </div>
	</div>
	
    <div class="container-fluid" id="header_post">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="col-md-12">
                        <div class="line"></div>
                        <form class="form-horizontal" role="search" action="<?php echo site_url('home/search');?>" method="POST">
                            <div class="form-group">
                              <div id="custom-search-input">
                                <div class="input-group">
                                  <input type="text" class="form-control" name="search" placeholder="Cari topik yang anda butuhkan disini..." required="">
                                    <span class="input-group-btn">
                                      <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span> Temukan
                                      </button>
                                    </span>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <span class="glyphicon glyphicon-bookmark"></span> Kampus</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                              <a href="<?php echo site_url('management'); ?>" class="btn btn-success btn-lg btn-block" role="button"><span class="glyphicon glyphicon-user"></span> Mahasiswa</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <h4>Tags :</h4>
                <p>
                <?php 
                $color = array("primary","success","info","warning","danger");
                foreach ($tags->result() as $row) : ?>
                 <a href="<?php echo site_url('home/category/'.$row->id_category); ?>">
                    <button type="button" class="btn btn-<?php echo $color[array_rand($color)]; ?>">
                        <?php echo $row->title_category; ?> 
                        <span class="badge"><?php echo $row->jml; ?></span>
                    </button>
                </a>
                <?php $tags->free_result(); endforeach; ?> 
                </p>
            </div>
            <div class="col-md-6">
                
                <?php echo $this->session->flashdata('pesan'); ?>
                <div class="panel panel-success">
                    <div class="panel-heading panel-heading-custom1"><h3 class="panel-title"><i class="fa fa-spinner" aria-hidden="true"></i> <a href="#">Recent </a></h3> </div>
                    <?php 
                        $random=array("1","2","3","4","5");
                        $iklan = array_rand($random);
                        $no=0; foreach ($init_update->result() as $row) : $no++; 
                        $year = substr($row->created_modified,0,4);
                        $month = substr($row->created_modified,5,2);
                        
                        if ($row->gambar!=NULL)
                        {
                            $post_images=base_url().'images/'.$year.'/'.$month.'/thumbnails/'.$row->gambar;
                        }
                        else
                        {
                            $post_images =cek_img_tag($row->isi);
                        }
                        
                        
                        if ($post_images=="")
                            $post_images =base_url('logo.png');
                        
                        
                    ?>
                    <div class="panel-body">
                        <div class="col-sm-12 contpost">
                            <div class="row">
                              <div class="col PostTitle">
                                <h4><a href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>"><?php echo $row->title; ?></a></h4>
                                
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-6">
                                <a href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>" class="thumbnail">
                                    <img src="<?php echo $post_images; ?>" alt="<?php echo $row->title; ?>">
                                </a>
                              </div>
                              <div class="col-sm-6">  <p><b><i class="fa fa-calendar"></i> <?php echo time_post($row->created_date); ?></b></p>
                                <p><?php echo strip_tags(addslashes(trim(substr($row->isi,0,150)))); ?></p>
                                <p><a class="btn btn-sm btn-success" href="<?php echo site_url('home/read/'.$row->id_content.'-'.create_url($row->title)); ?>">Baca selengkapnya</a></p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col text-center small p-2">
                                <p>
                                  <i class="fa fa-user-circle"></i> by <a href="#"><?php echo $row->full_name; ?></a>
                                  | <i class="fa fa-search"></i> <a href="#"><?php echo number_format($row->hits,0); ?> view</a>
                                  | <i class="fa fa-tags"></i> Tags : <a href="<?php echo site_url('home/category/'.$row->id_category); ?>"><span class="badge badge-info"><?php echo $row->title_category; ?></span></a>
                                </p>
                              </div>
                            </div>
                          </div>
                          
                    </div>
                    <?php 
                        if ($no==$iklan)
                        {
                            echo '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                <ins class="adsbygoogle"
                                     style="display:block"
                                     data-ad-format="fluid"
                                     data-ad-layout-key="-go-1a+bv-am-kg"
                                     data-ad-client="ca-pub-1103260674484637"
                                     data-ad-slot="3901256143"></ins>
                                <script>
                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>';
                        }
                    ?>
                    <hr/>
                    
                    <?php $init_update->free_result(); endforeach; ?>
                    
                    <div class="panel-footer" style="text-align: center;"><?php echo $pagination; ?></div>
                </div>
            </div>
            
			<div class="col-md-3">
			    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- homepage_cakrawaladigital.com -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-1103260674484637"
                     data-ad-slot="1853677304"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div>
    

    <footer id="footer" class="navbar-default navbar-fixed-bottom">
        <div class="container">
            <div class="col-md-12">
           Copyright &copy; <span class="info">2010 - <?php echo $versi->row()->tahun; ?></span>. | <span class="info"><?php echo $identitas->row()->title_footer; ?></span> |

            Versi : <span class="info"><?php echo $versi->row()->title; ?></span> || Page rendered in <strong>{elapsed_time}</strong> seconds.
            </div>
        </div>
    </footer>
    <!---<script>
         (adsbygoogle = window.adsbygoogle || []).push({
              google_ad_client: "ca-pub-1103260674484637",
              enable_page_level_ads: true
         });
    </script> -->
    
    <script src="<?php echo base_url('assets/homepage/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/homepage/js/scripts.js'); ?>"></script>
    
    
</body>

</html>