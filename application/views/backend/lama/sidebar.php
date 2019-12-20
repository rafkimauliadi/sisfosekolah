 <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse" style="font-size: 90%;">
                    <ul class="nav navbar-nav side-nav">
                            <?php 

                                function sub_main_menu_admin($id_menu)
                                {
                                    $CI =& get_instance();
                                    $init_sidebar_menu_admin ='<ul id="submenu-'.$id_menu.'" class="collapse">';

                                    $sub_sideber_menu_admin = $CI->display_menu->sub_main_menu_admin($id_menu);

                                    foreach ($sub_sideber_menu_admin->result() as $row) :
                                    $ct                 =   $CI->display_menu->count_main_menu_admin($row->id_menu);

                                    if ($ct > 0)
                                    {
                                        $data_toggle ='data-toggle="collapse" data-target="#submenu-'.$row->id_menu.'"';
                                        $current='<i class="fa fa-fw fa-angle-down pull-right"></i>';
                                        $link='#';

                                    }
                                    else
                                    {
                                        $data_toggle ='';
                                        $current='';
                                        if ($row->type_menu=="1")

                                            $link=site_url($row->link);
                                        else
                                            $link=$row->link;
                                    }

                                    $init_sidebar_menu_admin.='<li style="list-style:none;"><a target="'.$row->target_menu.'" href="'.$link.'" '.$data_toggle.'> <i class="fa '.$row->icon_menu.'"></i>  '.$row->menu_name.' '.$current.'</a>';
                                    if ($ct>0)
                                        $init_sidebar_menu_admin.=sub_sidebar_menu_admin($row->id_menu);



                                    $sub_sideber_menu_admin->free_result(); endforeach;
                                    $init_sidebar_menu_admin.='</ul>';
                                    return $init_sidebar_menu_admin;
                                }
                                
                                $CI =& get_instance();
                                
                                $sideber_menu_admin =   $CI->display_menu->main_menu_admin();
                                $init_sidebar_menu_admin='';

                                foreach ($sideber_menu_admin->result() as $row) :
                                    $ct                 =   $CI->display_menu->count_main_menu_admin($row->id_menu);

                                    if ($ct > 0)
                                    {
                                        $data_toggle ='data-toggle="collapse" data-target="#submenu-'.$row->id_menu.'"';
                                        $current='<i class="fa fa-fw fa-angle-down pull-right"></i>';
                                        $link='#';

                                    }
                                    else
                                    {
                                        $data_toggle ='';
                                        $current='';
                                        if ($row->type_menu=="1")

                                            $link=site_url($row->link);
                                        else
                                            $link=$row->link;
                                    }

                                    $init_sidebar_menu_admin.='<li><a target="'.$row->target_menu.'" href="'.$link.'" '.$data_toggle.'> <i class="fa '.$row->icon_menu.'"></i>  '.$row->menu_name.' '.$current.'</a>';
                                    if ($ct>0)
                                        $init_sidebar_menu_admin.=sub_main_menu_admin($row->id_menu);



                                $sideber_menu_admin->free_result(); endforeach;

                                echo $init_sidebar_menu_admin;
                            ?>
                        </ul>                 
                </div>
                <!-- /.navbar-collapse -->
            </nav>

             <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row" id="main" >
                            <?php echo $this->breadcrumb->output(); ?>
                            <div class="col-sm-12 col-md-12" id="content">
                                <div class="row">
                                    <div class="col-lg-12">