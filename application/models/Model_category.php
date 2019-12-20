<?php
class Model_category extends CI_Model
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

        $this->session->set_flashdata('title_category', $title);

        $this->form_validation->set_rules('title', 'Title', 'required');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_category) as exist FROM category WHERE id_category = '$id'");
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
                                        a.id_category,
                                        a.title,
                                        a.id_status,

                                        b.id_status,
                                        b.nm_status 
                                    from 
                                    category a
                                    LEFT JOIN _status_system b on (a.id_status=b.id_status)");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_category,
                                            a.title
                                        from 
                                            category a
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
                                            a.id_category,
                                            a.title,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            category a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_category,
                                            a.title,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            category a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        order by id_category desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_category,
                                            a.title,
                                            a.id_status,

                                            b.nm_status
                                        from 
                                            category a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        WHERE 
                                            a.id_category='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id       = $this->format_data->string($this->input->post('id',TRUE));
        $title          = $this->input->post('title',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);

        $url            = site_url('category/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('title',$title);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('created_by',$id_user);
        $this->mydb1->where('id_category',$id);
        $this->mydb1->update('category');

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
            $this->model_message->messege_proses('Berhasil memperbarui category.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_save()
    {
        $max=$this->model_combo->id_max('id_category','category');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $title          = $this->input->post('title',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);

        $url            = site_url('category/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_category',$id);
        $this->mydb1->set('title',$title);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('created_by',$id_user);
        $this->mydb1->insert('category');

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
            $this->model_message->messege_proses('Berhasil Menambah Category.','edit',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_delete()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $url='';

        $this->mydb1->trans_start();

        $this->mydb1->where('id_category',$id);
        $this->mydb1->delete('category');

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
            $this->model_message->messege_proses('Category Berhasil dihapus.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }
}