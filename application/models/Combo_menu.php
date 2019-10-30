<?php
class Combo_menu extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }

    
    public function init_type_menu($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id,
                                        title
                                    FROM 
                                        _type_menu
                                    WHERE   
                                        id != $id
                                    ");
        return $data;
    }

    public function init_target_menu($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id,
                                        title
                                    FROM 
                                        _target_menu
                                    WHERE   
                                        id != $id
                                    ");
        return $data;
    }

    public function init_display_menu($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id,
                                        title
                                    FROM 
                                        _display
                                    WHERE   
                                        id != $id
                                    ");
        return $data;
    }
}