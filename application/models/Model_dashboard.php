<?php
class Model_dashboard extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    public function show_dashboard()
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
                                        a.id_group,

                                        b.title as target_menu
                                    FROM 
                                        _menu_admin a
                                        LEFT JOIN _target_menu b on (a._target=b.id)
                                    WHERE 
                                        a.id_status='1'
                                    and 
                                        a.display='1'
                                    and
                                        a.position='1'
                                    and
                                    FIND_IN_SET($id_group,a.id_group)
                                    order by a.order_no asc");
    }
}