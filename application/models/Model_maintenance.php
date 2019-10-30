<?php
class Model_maintenance extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    public function status_site()
    {
        $query = $this->mydb1->query("SELECT 
                                            id_status as exist
                                    FROM 
                                            _maintenance");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function value_offline()
    {
        $query = $this->mydb1->query("select group_concat(id_white) as id_white from _white_list where id_status='1'");    

        $data = $query->row();
        return $data;
    }

    public function init_offline()
    {
        $url="";
        $data    = $this->value_offline();
        $setting = $data->id_white;
        
        $this->mydb1->trans_start();
        $this->mydb1->set('setting',$setting);
        $this->mydb1->set('id_status','offline');
        $this->mydb1->update('_maintenance');

        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            $this->update_offline($setting);
            $this->model_message->messege_proses('Sistem Publik di non aktifkan.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
        
    }

    public function update_offline($setting)
    {
        $url="";
        $array  = explode(',', $setting);
        $this->mydb1->trans_start();
        $this->mydb1->set('id_status','2');
        $this->mydb1->where_in('id_white',$array);
        $this->mydb1->update('_white_list');

        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            //$this->model_message->messege_proses('Data Berhasil diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }


    public function value_online()
    {
        $query = $this->mydb1->query("select setting as id_white from _maintenance");    

        $data = $query->row();
        return $data;
    }

    public function init_online()
    {
        $url="";
        $data    = $this->value_online();
        $setting = $data->id_white;



        $this->mydb1->trans_start();
        $this->mydb1->set('id_status','online');        
        $this->mydb1->update('_maintenance');

        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            $this->update_online($setting);
            $this->model_message->messege_proses('Sistem Publik telah online.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
        
    }

    public function update_online($setting)
    {
        $url="";
        $array  = explode(',', $setting);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_status','1');
        $this->mydb1->where_in('id_white',$array);
        $this->mydb1->update('_white_list');

        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            //$this->model_message->messege_proses('Data Berhasil diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

}