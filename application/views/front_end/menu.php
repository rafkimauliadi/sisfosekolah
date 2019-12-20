
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
                      <!-- <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo base_url('logo.png'); ?>" alt="<?php echo $identitas->row()->title; ?>"></a> -->
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
                            <li><a href="#" ><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
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
                                          <input type="text" class="form-control" name="search" placeholder="Cari topik yang anda butuhkan disini..." required="" value="<?php if (isset($search)) { echo $search;} ?>">
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
			<br/>
			<div class="container">
            <div class="row">
			<div class="col-md-9">