<?php
class Model_group extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    
    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();

        $title          = $this->input->post('title');

        $this->session->set_flashdata('title_group', $title);

        $this->form_validation->set_rules('title', 'Title Group', 'required|min_length[3]');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_group) as exist FROM _group WHERE id_group = '$id'");
        $cek = $query->row();
        if (is_null($cek)==false) 
        {
            if($cek->exist == 1)
                return true;
            else
                return false;
        }   
        else
            return false;
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                        a.id_group,
                                        a.nm_group,
                                        a.id_status,
                                        a.id_user,

                                        b.id_status,
                                        b.nm_status 
                                    from 
                                    _group a
                                    LEFT JOIN _status_system b on (a.id_status=b.id_status)");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_group,
                                            a.nm_group
                                        from 
                                            _group a
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
                                            a.id_group,
                                            a.nm_group,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            _group a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_group,
                                            a.nm_group,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            _group a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        order by id_group desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_group,
                                            a.nm_group,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            _group a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        WHERE 
                                            a.id_group='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id       = $this->format_data->string($this->input->post('id',TRUE));
        $title          = $this->input->post('title',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);

        $url            = site_url('group/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nm_group',$title);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->where('id_group',$id);
        $this->mydb1->update('_group');

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
            $this->model_message->messege_proses('Data Berhasil diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_save()
    {
        $max=$this->model_combo->id_max('id_group','_group');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $title          = $this->input->post('title',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);

        $url            = site_url('group/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_group',$id);
        $this->mydb1->set('nm_group',$title);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->insert('_group');

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
            $this->model_message->messege_proses('Data Berhasil disimpan.','edit',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_delete()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $url='';

        $this->mydb1->trans_start();

        $this->mydb1->where('id_group',$id);
        $this->mydb1->delete('_group');

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