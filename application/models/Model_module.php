<?php
class Model_module extends CI_Model
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


    public function label_group($values)
    {
        $query =$this->mydb1->query("SELECT _module.id_module, (SELECT GROUP_CONCAT(DISTINCT(_group.nm_group) ORDER BY id_group ASC SEPARATOR ', ') FROM _group WHERE FIND_IN_SET(_group.id_group, _module.id_group)) as nama_group FROM _module where _module.id_module='$values'");

        $data = $query->row();
        return $data;
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
        $this->form_validation->set_rules('id_group[]', 'Group', 'required[]');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_module) as exist FROM _module WHERE id_module = '$id'");
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

    public function checked_group($id_module,$id_group,$tabel)
    {
        $query = $this->mydb1->query("SELECT count(*) as exist FROM ".$tabel." where id_module='$id_module' and FIND_IN_SET($id_group,id_group) <> 0");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function get_parent($values)
    {
        $query = $this->mydb1->query("SELECT 
                                            module_name as exist
                                    FROM 
                                            _module
                                    WHERE 
                                            id_module = '$values'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _module a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.module_name,
                                            a._controller,
                                            a._function
                                        from 
                                            _module a
                                        ");
        return $query->field_data();
    }

    public function cb_module()
    {
        $query=$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name
                                        from 
                                            _module a
                                        where 
                                            a.parent_id='0'
                                        order by a.order_no");
        $cb_module='';
        foreach ($query->result() as $row) {
            $id_module = $row->id_module;
            $module_name = $row->module_name;

            $ct=$this->count_exists($id_module);
            if ($ct > 0)
            {
                $cb_module.='<option value="'.$id_module.'">'.$module_name.'</option>';
                $cb_module.=$this->cb_child_parent($id_module);
            }
            else
            {
                $cb_module.='<option value="'.$id_module.'">'.$module_name.'</option>';
            }
            
        }
            
        return $cb_module;
    }


    public function cb_child_parent($id_module)
    {
        static $i = 2;
        $tab = str_repeat("",$i);
        static $a = 1;
        //$pusher = "&#8594;";
        $pusher = "&#x02013;";
        $showPusher = str_repeat($pusher,$a);

        $query=$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name
                                        from 
                                            _module a
                                        where 
                                            a.parent_id='$id_module'
                                        
                                        order by a.id_module desc");

        $id_module='';

        foreach ($query->result() as $row) {  $a++;
            $id_module = $row->id_module;
            $module_name = $row->module_name;

            $child = $this->cb_child_parent($id_module);

            $id_module.='<option value="'.$id_module.'">'.$showPusher.'&#x022A3; '.$module_name.'</option>';
            $a--;
            if($child)
            {
                $id_module .= $child;
            }
            
            
        }
        return $id_module;
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,
                                            a.id_group,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _module a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            (a.".$change_box." LIKE '%$search_box%')
                                        AND     
                                            a.parent_id='0'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,
                                            a.id_group,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _module a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'
                                        order by id_module desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function count_exists($id_module)
    {
        $query = $this->mydb1->query("select count(*) as exist  from _module where parent_id='$id_module'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_view_child($id_module)
    {
        return $this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,
                                            a.id_group,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _module a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='$id_module'
                                        
                                        order by a.id_module desc");
    }

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_module,
                                            a.parent_id,
                                            a.module_name,
                                            a._controller,
                                            a._function,
                                            a.order_no,
                                            a.id_group,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _module a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        WHERE 
                                            a.id_module='$id'");
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

        $all_group      = $this->input->post('id_group',TRUE);
        $id_group       = implode(',',$all_group);
        if ($all_group==NULL)
            $id_group='1';
        else
            $id_group       = implode(',',$all_group);


        $url            = site_url('module/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('module_name',$title);
        $this->mydb1->set('_controller',$_controller);
        $this->mydb1->set('_function',$_function);
        $this->mydb1->set('id_group',$id_group);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->where('id_module',$id);
        $this->mydb1->update('_module');

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
        $max=$this->model_combo->id_max('id_module','_module');
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

        $all_group = array();
        $all_group      = $this->input->post('id_group',TRUE);
        $id_group       = implode(',',$all_group);
        if ($all_group==NULL)
            $id_group='1';
        else
            $id_group       = implode(',',$all_group);        

        $url            = site_url('module/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_module',$id);
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('module_name',$title);
        $this->mydb1->set('_controller',$_controller);
        $this->mydb1->set('_function',$_function);
        $this->mydb1->set('id_group',$id_group);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->insert('_module');

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

        $this->mydb1->where('id_module',$id);
        $this->mydb1->delete('_module');

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