<?php
class Model_mapel_kelas extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.nama_kelas
                                            from 
                                            master_kelas a
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
                                            a.id_kelas,
                                            a.id_mata_pelajaran,
                                            a.id_guru,

                                            b.nama_kelas,
                                            c.nama_mapel,
                                            d.nama_lengkap as nama_guru
                                        from 
                                            master_mapel_kelas a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_mata_pelajaran c on (a.id_mata_pelajaran=c.id_mata_pelajaran)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)
                                            
                                        where 
                                            (b.".$change_box." like '%$search_box%')
                                        order by a.id desc
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_kelas,
                                            a.id_mata_pelajaran,
                                            a.id_guru,

                                            b.nama_kelas,
                                            c.nama_mapel,
                                            d.nama_lengkap as nama_guru
                                        from 
                                            master_mapel_kelas a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_mata_pelajaran c on (a.id_mata_pelajaran=c.id_mata_pelajaran)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)
                                            
                                        order by a.id desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_kelas,
                                            a.id_mata_pelajaran,
                                            a.id_guru,

                                            b.nama_kelas,
                                            c.nama_mapel,
                                            d.nama_lengkap as nama_guru
                                        from 
                                            master_mapel_kelas a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_mata_pelajaran c on (a.id_mata_pelajaran=c.id_mata_pelajaran)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)");
            return $data->num_rows();
    }



    public function init_save()
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_mata_pelajaran          = $this->input->post('id_mata_pelajaran',TRUE);
        $id_guru          = $this->input->post('id_guru',TRUE);

        $url            = site_url('mapel-kelas/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mata_pelajaran',$id_mata_pelajaran);
        $this->mydb1->set('id_guru',$id_guru);
        // $this->mydb1->set('created_at',$created_time);
        $this->mydb1->insert('master_mapel_kelas');

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

        $this->mydb1->where('id',$id);
        $this->mydb1->delete('master_mapel_kelas');

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

    
    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_mapel_kelas WHERE id = '$id'");
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
    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_kelas,
                                            a.id_mata_pelajaran,
                                            a.id_guru,
                                            b.nama_kelas,
                                            c.nama_mapel,
                                            d.nama_lengkap as nama_guru
                                        from 
                                            master_mapel_kelas a
                                        left join 
                                            master_kelas b
                                            on a.id_kelas = b.id_kelas
                                        left join 
                                            master_mata_pelajaran c
                                            on a.id_mata_pelajaran = c.id_mata_pelajaran
                                        left join 
                                            master_guru d
                                            on a.id_guru = d.id
                                        WHERE 
                                            a.id='$id'");
        return $data;
    }
    public function validation_field($action)
    {
        $this->model_message->conv_validasi_to_indonesia();

        $id_kelas          = $this->input->post('id_kelas');
        $id_mata_pelajaran         = $this->input->post('id_mata_pelajaran');
        $id_guru          = $this->input->post('id_guru');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mata_pelajaran', 'id_mata_pelajaran', 'required');
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
        }
        else
        {
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mata_pelajaran', 'id_mata_pelajaran', 'required');
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
        }

        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('id_mata_pelajaran', $id_mata_pelajaran);
        $this->session->set_flashdata('id_guru', $id_guru);

    }
    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id             = $this->format_data->string($this->input->post('id',TRUE));
        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_mata_pelajaran          = $this->input->post('id_mata_pelajaran',TRUE);
        $id_guru          = $this->input->post('id_guru',TRUE);

        $url            = site_url('mapel-kelas/edit/'.$id);

        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mata_pelajaran',$id_mata_pelajaran);
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_mapel_kelas');

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

    function init_kelas($id)
    {
        $sql = "select id_kelas,nama_kelas  from master_kelas where id_kelas !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_mapel($id)
    {
        $sql = "select id_mata_pelajaran, nama_mapel from master_mata_pelajaran where id_mata_pelajaran !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_guru($id)
    {
        $sql = "select id, nama_lengkap from master_guru where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }
}