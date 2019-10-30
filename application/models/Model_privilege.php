<?php
class Model_privilege extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();

        $title          = $this->input->post('title');
        $_controller    = $this->input->post('_controller');
        $_function      = $this->input->post('_function');

        $this->session->set_flashdata('title_module', $title);
        $this->session->set_flashdata('_controller', $_controller);
        $this->session->set_flashdata('_function', $_function);

        $this->form_validation->set_rules('title', 'Title Module', 'required|min_length[3]');
        $this->form_validation->set_rules('_controller', '_Controller', 'required|min_length[3]');
        $this->form_validation->set_rules('_function', '_Function', 'required|min_length[3]');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_white) as exist FROM _white_list WHERE id_white = '$id'");
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

    public function cek_parent_update($field,$tabel,$id,$parent_id)
    {
        $query = $this->mydb1->query("SELECT count(".$field.") as exist FROM ".$tabel." where (".$field."='$parent_id' and ".$field."='$id' )");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function get_parent_privilege($values)
    {
        $query = $this->mydb1->query("SELECT 
                                            module_name as exist
                                    FROM 
                                            _white_list
                                    WHERE 
                                            id_white = '$values'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.module_name,
                                            a._controller,
                                            a._function
                                        from 
                                            _white_list a
                                        ");
        return $query->field_data();
    }

    public function cb_white_list()
    {
        $query=$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'
                                        order by a.order_no");
        $cb_white_list='';
        foreach ($query->result() as $row) {
            $id_white = $row->id_white;
            $module_name = $row->module_name;

            $ct=$this->count_exists($id_white);
            if ($ct > 0)
            {
                $cb_white_list.='<option value="'.$id_white.'">'.$module_name.'</option>';
                $cb_white_list.=$this->cb_child_white_list($id_white);
            }
            else
            {
                $cb_white_list.='<option value="'.$id_white.'">'.$module_name.'</option>';
            }
            
        }
            
        return $cb_white_list;
    }


    public function cb_child_white_list($id_white)
    {
        static $i = 2;
        $tab = str_repeat("",$i);
        static $a = 1;
        //$pusher = "&#8594;";
        $pusher = "&#x02013;";
        $showPusher = str_repeat($pusher,$a);

        $query=$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='$id_white'
                                        
                                        order by a.id_white desc");

        $cb_white_list='';

        foreach ($query->result() as $row) {  $a++;
            $id_white = $row->id_white;
            $module_name = $row->module_name;

            $child = $this->cb_child_white_list($id_white);

            $cb_white_list.='<option value="'.$id_white.'">'.$showPusher.'&#x022A3; '.$module_name.'</option>';
            $a--;
            if($child)
            {
                $cb_white_list .= $child;
            }
            
            
        }
        return $cb_white_list;
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            (a.".$change_box." LIKE '%$search_box%')
                                        AND     
                                            a.parent_id='0'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'
                                        order by id_white desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function count_exists($id_white)
    {
        $query = $this->mydb1->query("select count(*) as exist  from _white_list where parent_id='$id_white'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_view_child($id_white)
    {
        return $this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='$id_white'
                                        
                                        order by a.id_white desc");
    }

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_white,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _white_list a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        WHERE 
                                            a.id_white='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id       = $this->format_data->string($this->input->post('id',TRUE));
        $title          = $this->input->post('title',TRUE);
        $_controller    = $this->input->post('_controller',TRUE);
        $_function      = $this->input->post('_function',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);
        $_order_no      = $this->input->post('_order_no',TRUE);

        $url            = site_url('privilege/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('module_name',$title);
        $this->mydb1->set('_controller',$_controller);
        $this->mydb1->set('_function',$_function);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->where('id_white',$id);
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
            $this->model_message->messege_proses('Data Berhasil diperbarui.','edit',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_save()
    {
        $max=$this->model_combo->id_max('id_white','_white_list');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $title          = $this->input->post('title',TRUE);
        $_controller    = $this->input->post('_controller',TRUE);
        $_function      = $this->input->post('_function',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);
        $_order_no      = $this->input->post('_order_no',TRUE);

        $url            = site_url('privilege/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_white',$id);
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('module_name',$title);
        $this->mydb1->set('_controller',$_controller);
        $this->mydb1->set('_function',$_function);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->insert('_white_list');

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

        $this->mydb1->where('id_white',$id);
        $this->mydb1->delete('_white_list');

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