<?php
class Display_menu extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
        
    }

    
    public function main_menu_admin()
    {
    	$id_group    = $this->model_hook->init_profile_user()->id_group;

    	return $this->mydb1->query("SELECT 
                                        a.id_menu,
                                        a.parent_id, 
                                        a.menu_name, 
                                        a.link, 
                                        a.icon_menu, 
                                        a._target,
                                        a.type_menu,
                                        a.position,
                                        a.order_no, 
                                        a.id_status,

                                        b.title as target_menu
                                    FROM 
                                        _menu_admin a
                                        LEFT JOIN _target_menu b on (a._target=b.id)
                                    WHERE 
                                        a.id_status='1'
                                    and 
                                        a.parent_id='0'
                                    and
                                        a.position='1'
                                    and
                                    FIND_IN_SET($id_group,a.id_group)
                                    order by a.order_no ");
    }

    public function count_main_menu_admin($id_menu)
    {
    	$query = $this->mydb1->query("select count(*) as exist  from _menu_admin where parent_id='$id_menu' and id_status='1'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function sub_main_menu_admin($id_menu)
    {
        $id_group    = $this->model_hook->init_profile_user()->id_group;
        
    	return $this->mydb1->query("SELECT 
                                        a.id_menu,
                                        a.parent_id, 
                                        a.menu_name, 
                                        a.link, 
                                        a.icon_menu, 
                                        a._target,
                                        a.type_menu,
                                        a.position,
                                        a.order_no, 
                                        a.id_status,

                                        b.title as target_menu
                                    FROM 
                                        _menu_admin a
                                        LEFT JOIN _target_menu b on (a._target=b.id)
                                    WHERE 
                                        a.id_status='1'
                                    and 
                                        a.parent_id='$id_menu'
                                    and
                                        a.position='1'
                                    and
                                    FIND_IN_SET($id_group,a.id_group)
                                    order by a.order_no");
    }
    
    public function init_parent()
    {
        return $query=$this->mydb1->query("SELECT 
                                        a.id_menu,
                                        a.parent_id, 
                                        a.menu_name, 
                                        a.link, 
                                        a.icon_menu, 
                                        a._target,
                                        a.type_menu,
                                        a.position,
                                        a.order_no, 
                                        a.id_status,

                                        b.title as target_menu
                                    FROM 
                                        _menu a
                                        LEFT JOIN _target_menu b on (a._target=b.id)
                                    WHERE 
                                        a.id_status='1'
                                    and 
                                        a.parent_id='0'
                                    and
                                        a.position='1'
                                    order by a.order_no ");
    }
    
    public function count_child($id_menu)
    {
        $query = $this->mydb1->query("select count(*) as exist  from _menu where parent_id='$id_menu' and id_status='1'  and position='1'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_child($id_menu)
    {
        return $this->mydb1->query("SELECT 
                                        a.id_menu,
                                        a.parent_id, 
                                        a.menu_name, 
                                        a.link, 
                                        a.icon_menu, 
                                        a._target,
                                        a.type_menu,
                                        a.position,
                                        a.order_no, 
                                        a.id_status,

                                        b.title as target_menu
                                    FROM 
                                        _menu a
                                        LEFT JOIN _target_menu b on (a._target=b.id)
                                    WHERE 
                                        a.id_status='1'
                                    and 
                                        a.parent_id='$id_menu'
                                    and
                                        a.position='1'
                                    order by a.order_no");
    }

    	
}