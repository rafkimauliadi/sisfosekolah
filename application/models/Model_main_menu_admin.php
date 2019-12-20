<?php
class Model_main_menu_admin extends CI_Model
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
        $query =$this->mydb1->query("SELECT _menu_admin.id_menu, (SELECT GROUP_CONCAT(DISTINCT(_group.nm_group) ORDER BY id_group ASC SEPARATOR ', ') FROM _group WHERE FIND_IN_SET(_group.id_group, _menu_admin.id_group)) as nama_group FROM _menu_admin where _menu_admin.id_menu='$values'");

        $data = $query->row();
        return $data;
    }

    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();

        $title          = $this->input->post('title');
        $link    = $this->input->post('link');

        $this->session->set_flashdata('title_menu', $title);
        $this->session->set_flashdata('link', $link);

        $this->form_validation->set_rules('title', 'Title Menu', 'required|min_length[3]');
        $this->form_validation->set_rules('link', 'Link', 'required');
        $this->form_validation->set_rules('id_group[]', 'Group', 'required');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_menu) as exist FROM _menu_admin WHERE id_menu = '$id'");
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

    public function checked_group($id_menu,$id_group,$tabel)
    {
        $query = $this->mydb1->query("SELECT count(*) as exist FROM ".$tabel." where id_menu='$id_menu' and FIND_IN_SET($id_group,id_group) <> 0");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function get_parent($values)
    {
        $query = $this->mydb1->query("SELECT 
                                            menu_name as exist
                                    FROM 
                                            _menu_admin
                                    WHERE 
                                            id_menu = '$values'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,

                                            b.id_status,
                                            b.nm_status
                                        from 
                                            _menu_admin a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                        where 
                                            a.parent_id='0'");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.menu_name,
                                            a.link
                                        from 
                                            _menu_admin a
                                        ");
        return $query->field_data();
    }

    public function cb_main_menu_admin()
    {
        $query=$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name
                                        from 
                                            _menu_admin a
                                        where 
                                            a.parent_id='0'
                                        order by a.order_no");
        $cb_main_menu_admin='';
        foreach ($query->result() as $row) {
            $id_menu = $row->id_menu;
            $menu_name = $row->menu_name;

            $ct=$this->count_exists($id_menu);
            if ($ct > 0)
            {
                $cb_main_menu_admin.='<option value="'.$id_menu.'">'.$menu_name.'</option>';
                $cb_main_menu_admin.=$this->cb_child_parent($id_menu);
            }
            else
            {
                $cb_main_menu_admin.='<option value="'.$id_menu.'">'.$menu_name.'</option>';
            }
            
        }
            
        return $cb_main_menu_admin;
    }


    public function cb_child_parent($id_menu)
    {
        static $i = 2;
        $tab = str_repeat("",$i);
        static $a = 1;
        //$pusher = "&#8594;";
        $pusher = "&#x02013;";
        $showPusher = str_repeat($pusher,$a);

        $query=$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name
                                        from 
                                            _menu_admin a
                                        where 
                                            a.parent_id='$id_menu'
                                        
                                        order by a.id_menu desc");

        $cb_main_menu_admin='';

        foreach ($query->result() as $row) {  $a++;
            $id_menu = $row->id_menu;
            $menu_name = $row->menu_name;

            $child = $this->cb_child_parent($id_menu);

            $cb_main_menu_admin.='<option value="'.$id_menu.'">'.$showPusher.'&#x022A3; '.$menu_name.'</option>';
            $a--;
            if($child)
            {
                $cb_main_menu_admin .= $child;
            }
            
            
        }
        return $cb_main_menu_admin;
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name,
                                            a.link,
                                            a.icon_menu,
                                            a.order_no,
                                            a.id_group,
                                            a.display,

                                            b.id_status,
                                            b.nm_status,

                                            c.title
                                        from 
                                            _menu_admin a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _display c on (a.display=c.id)
                                        where 
                                            (a.".$change_box." LIKE '%$search_box%')
                                        AND     
                                            a.parent_id='0'
                                        and 
                                            a.position='1'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name,
                                            a.link,
                                            a.icon_menu,
                                            a.order_no,
                                            a.id_group,
                                            a.display,

                                            b.id_status,
                                            b.nm_status,

                                            c.title
                                        from 
                                            _menu_admin a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _display c on (a.display=c.id)
                                        where 
                                            a.parent_id='0'
                                        and 
                                            a.position='1'
                                        order by a.id_menu desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function count_exists($id_menu)
    {
        $query = $this->mydb1->query("select count(*) as exist  from _menu_admin where parent_id='$id_menu'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_view_child($id_menu)
    {
        return $this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name,
                                            a.link,
                                            a.icon_menu,
                                            a.order_no,
                                            a.id_group,
                                            a.display,

                                            b.id_status,
                                            b.nm_status,

                                            c.title
                                        from 
                                            _menu_admin a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _display c on (a.display=c.id)
                                        where 
                                            a.parent_id='$id_menu'
                                        
                                        order by a.id_menu desc");
    }

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_menu,
                                            a.parent_id,
                                            a.menu_name,
                                            a.link,
                                            a.icon_menu,
                                            a.order_no,
                                            a.id_group,
                                            a.display,
                                            a.type_menu,
                                            a._target,

                                            b.id_status,
                                            b.nm_status,

                                            c.title as display_dashboard,

                                            d.title as title_type_menu,

                                            
                                            e.title as title_target
                                        from 
                                            _menu_admin a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _display c on (a.display=c.id)
                                            LEFT JOIN _type_menu d on (a.type_menu=d.id)
                                            LEFT JOIN _target_menu e on (a._target=e.id)
                                        where 
                                            a.id_menu='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id             = $this->format_data->string($this->input->post('id',TRUE));
        $title          = $this->input->post('title',TRUE);
        $link           = $this->input->post('link',TRUE);
        $icon_menu      = $this->input->post('icon_menu',TRUE);
        $type_menu      = $this->input->post('type_menu',TRUE);
        $target_menu      = $this->input->post('target_menu',TRUE);
        $display_dashboard      = $this->input->post('display_dashboard',TRUE);

        $id_status      = $this->input->post('id_status',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);
        $_order_no      = $this->input->post('_order_no',TRUE);

        $all_group      = $this->input->post('id_group',TRUE);
        $id_group       = implode(',',$all_group);
        if ($all_group==NULL)
            $id_group='1';
        else
            $id_group       = implode(',',$all_group);


        $url            = site_url('main-menu-admin/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('menu_name',$title);
        $this->mydb1->set('link',$link);
        $this->mydb1->set('icon_menu',$icon_menu);
        $this->mydb1->set('type_menu',$type_menu);
        $this->mydb1->set('_target',$target_menu);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_group',$id_group);
        $this->mydb1->set('display',$display_dashboard);
        $this->mydb1->set('position','1');
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->where('id_menu',$id);
        $this->mydb1->update('_menu_admin');

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
        $max=$this->model_combo->id_max('id_menu','_menu_admin');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user                 = $this->model_hook->init_online_exist();

        $title                  = $this->input->post('title',TRUE);
        $link                   = $this->input->post('link',TRUE);
        $icon_menu              = $this->input->post('icon_menu',TRUE);
        $type_menu              = $this->input->post('type_menu',TRUE);
        $target_menu            = $this->input->post('target_menu',TRUE);
        $display_dashboard      = $this->input->post('display_dashboard',TRUE);
        $_order_no              = $this->input->post('_order_no',TRUE);

        $id_status      = $this->input->post('id_status',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);

        $all_group      = $this->input->post('id_group',TRUE);
        $id_group       = implode(',',$all_group);
        if ($all_group==NULL)
            $id_group='1';
        else
            $id_group       = implode(',',$all_group);        

        $url            = site_url('main-menu-admin/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_menu',$id);
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('menu_name',$title);
        $this->mydb1->set('link',$link);
        $this->mydb1->set('icon_menu',$icon_menu);
        $this->mydb1->set('type_menu',$type_menu);
        $this->mydb1->set('_target',$target_menu);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->set('id_group',$id_group);
        $this->mydb1->set('display',$display_dashboard);
        $this->mydb1->set('position','1');
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->insert('_menu_admin');

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
        $url="";

        $this->mydb1->trans_start();

        $this->mydb1->where('id_menu',$id);
        $this->mydb1->delete('_menu_admin');

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