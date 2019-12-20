<?php
class Model_session_site extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                        a.id,
                                        a.ip_address,
                                        a.timestamp,
                                        a.data
                                    from 
                                    ci_sessions a");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.ip_address
                                        from 
                                            ci_sessions a
                                        ");
        return $query->field_data();
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.ip_address,
                                            a.timestamp
                                        from 
                                            ci_sessions a
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.ip_address,
                                            a.timestamp
                                        from 
                                            ci_sessions a
                                        order by a.timestamp desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	


    public function init_delete()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $url='';

        $this->mydb1->trans_start();
        $this->db->empty_table('ci_sessions');

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
            $this->model_message->messege_proses('Data Berhasil dihapus.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }
}