<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <?php 
            function sub_main_menu_admin($id_menu)
            {
                $CI =& get_instance();
                $init_sidebar_menu_admin ='<ul aria-expanded="false" class="collapse">';

                $sub_sideber_menu_admin = $CI->display_menu->sub_main_menu_admin($id_menu);

                foreach ($sub_sideber_menu_admin->result() as $row) :
                $ct                 =   $CI->display_menu->count_main_menu_admin($row->id_menu);

                if ($ct > 0)
                {
                    $link='javascript:void(0)';
                    $class = 'class="has-arrow waves-effect waves-dark"';
                    $expand = 'aria-expanded="false"';

                }
                else
                {
                    $class='';
                    $expand='';
                    if ($row->type_menu=="1")

                        $link=site_url($row->link);
                    else
                        $link=$row->link;
                }

                $init_sidebar_menu_admin.='<li><a '.$class.' '.$expand.' target="'.$row->target_menu.'" href="'.$link.'"> <i class="fa '.$row->icon_menu.'"></i>  '.$row->menu_name.'</a>';
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
                    
                    $link='javascript:void(0)';
                    $class = 'class="has-arrow waves-effect waves-dark"';
                    $expand = 'aria-expanded="false"';
                }
                else
                {
                    $class='';
                    $expand='';
                    if ($row->type_menu=="1")

                        $link=site_url($row->link);
                    else
                        $link=$row->link;
                }

                $init_sidebar_menu_admin.='<li><a '.$class.' '.$expand.'  href="'.$link.'" > <i class="fa '.$row->icon_menu.'"></i> <span class="hide-menu"> '.$row->menu_name.'</span></a>';
                if ($ct>0)
                    $init_sidebar_menu_admin.=sub_main_menu_admin($row->id_menu);



            $sideber_menu_admin->free_result(); endforeach;

            echo $init_sidebar_menu_admin;
        ?>
    </ul>
</nav>
                <!-- End Sidebar navigation -->
</div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor"></h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <?php echo $this->breadcrumb->output(); ?>
                            </ol>
                        </div>
                    </div>
                </div>
                
            