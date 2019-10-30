<?php
class Model_instansi extends CI_Model
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
        $_order_no      = $this->input->post('_order_no');

        $this->session->set_flashdata('title_instansi', $title);
        $this->session->set_flashdata('_order_no', $_order_no);

        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_instansi) as exist FROM instansi WHERE id_instansi = '$id'");
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

 
    public function get_parent($values)
    {
        $query = $this->mydb1->query("SELECT 
                                            nama_instansi as exist
                                    FROM 
                                            instansi
                                    WHERE 
                                            id_instansi = '$values'");    
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id
                                        from 
                                            instansi a
                                        where 
                                            a.parent_id='0'");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.nama_instansi
                                        from 
                                            instansi a
                                        ");
        return $query->field_data();
    }

    public function cb_parent()
    {
        $query=$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi
                                        from 
                                            instansi a
                                        where 
                                            a.parent_id='0'
                                        order by a.order_no");
        $cb_parent='';
        foreach ($query->result() as $row) {
            $id_instansi = $row->id_instansi;
            $nama_instansi = $row->nama_instansi;

            $ct=$this->count_exists($id_instansi);
            if ($ct > 0)
            {
                $cb_parent.='<option value="'.$id_instansi.'">'.$nama_instansi.'</option>';
                $cb_parent.=$this->cb_child_parent($id_instansi);
            }
            else
            {
                $cb_parent.='<option value="'.$id_instansi.'">'.$nama_instansi.'</option>';
            }
            
        }
            
        return $cb_parent;
    }


    public function cb_child_parent($id_instansi)
    {
        static $i = 2;
        $tab = str_repeat("",$i);
        static $a = 1;
        //$pusher = "&#8594;";
        $pusher = "&#x02013;";
        $showPusher = str_repeat($pusher,$a);

        $query=$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi
                                        from 
                                            instansi a
                                        where 
                                            a.parent_id='$id_instansi'
                                        
                                        order by a.id_instansi desc");

        $cb_parent='';

        foreach ($query->result() as $row) {  $a++;
            $id_instansi = $row->id_instansi;
            $nama_instansi = $row->nama_instansi;

            $child = $this->cb_child_parent($id_instansi);

            $cb_parent.='<option value="'.$id_instansi.'">'.$showPusher.'&#x022A3; '.$nama_instansi.'</option>';
            $a--;
            if($child)
            {
                $cb_parent .= $child;
            }
            
            
        }
        return $cb_parent;
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi

                                        from 
                                            instansi a
                                        where 
                                            (a.".$change_box." LIKE '%$search_box%')
                                        AND     
                                            a.parent_id='0'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi
                                        from 
                                            instansi a
                                        where 
                                            a.parent_id='0'
                                        order by a.id_instansi desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function count_exists($id_instansi)
    {
        $query = $this->mydb1->query("select count(*) as exist  from instansi where parent_id='$id_instansi'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_view_child($id_instansi)
    {
        return $this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi
                                        from 
                                            instansi a
                                        where 
                                            a.parent_id='$id_instansi'
                                        
                                        order by a.id_instansi desc");
    }

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_instansi,
                                            a.parent_id,
                                            a.nama_instansi,
                                            a.order_no
                                        from 
                                            instansi a
                                        where 
                                            a.id_instansi='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id             = $this->format_data->string($this->input->post('id',TRUE));
        $title          = $this->input->post('title',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);
        $_order_no      = $this->input->post('_order_no',TRUE);

        $url            = site_url('instansi/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('nama_instansi',$title);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->where('id_instansi',$id);
        $this->mydb1->update('instansi');

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
        $max=$this->model_combo->id_max('id_instansi','instansi');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user                 = $this->model_hook->init_online_exist();

        $title                  = $this->input->post('title',TRUE);
        $_order_no              = $this->input->post('_order_no',TRUE);
        $parent_id      = $this->input->post('parent_id',TRUE);
 

        $url            = site_url('instansi/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_instansi',$id);
        $this->mydb1->set('nama_instansi',$title);
        $this->mydb1->set('parent_id',$parent_id);
        $this->mydb1->set('order_no',$_order_no);
        $this->mydb1->insert('instansi');

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

        $this->mydb1->where('id_instansi',$id);
        $this->mydb1->delete('instansi');

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