<?php
class Model_jam extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
    }

    public function validation_field($action)
    {
        $this->model_message->conv_validasi_to_indonesia();

        $jam          = $this->input->post('jam');
        $waktu_mulai          = $this->input->post('waktu_mulai');
        $waktu_akhir          = $this->input->post('waktu_akhir');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('jam', 'jam', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'waktu_mulai', 'required');
            $this->form_validation->set_rules('waktu_akhir', 'waktu_akhir', 'required');
        }
        else
        {
            $this->form_validation->set_rules('jam', 'jam', 'required');
            $this->form_validation->set_rules('waktu_mulai', 'waktu_mulai', 'required');
            $this->form_validation->set_rules('waktu_akhir', 'waktu_akhir', 'required');
        }

        $this->session->set_flashdata('jam', $jam);
        $this->session->set_flashdata('waktu_mulai', $waktu_mulai);
        $this->session->set_flashdata('waktu_akhir', $waktu_akhir);

    }

    public function get_data_jam()
    {
        $sql = "select * from master_jam";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $jam          = $this->input->post('jam',TRUE);
        $waktu_mulai          = $this->input->post('waktu_mulai',TRUE);
        $waktu_akhir          = $this->input->post('waktu_akhir',TRUE);

        $url            = site_url('master-jam/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('jam',$jam);
        $this->mydb1->set('waktu_mulai',$waktu_mulai);
        $this->mydb1->set('waktu_akhir',$waktu_akhir);
        $this->mydb1->insert('master_jam');

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
        $this->mydb1->delete('master_jam');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_jam WHERE id = '$id'");
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
                                            id,
                                            jam,
                                            waktu_mulai,
                                            waktu_akhir
                                        from 
                                            master_jam
                                        WHERE 
                                            id='$id'");
        return $data;
    }

    public function cek_exist_nama($tabel,$field1,$field2,$value1,$value2)
    {
        $query = $this->mydb1->query("SELECT count(".$field1.") as exist FROM ".$tabel." where ".$field1."='$value1' and ".$field2." <> $value2");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id             = $this->format_data->string($this->input->post('id',TRUE));
        $jam          = $this->input->post('jam',TRUE);
        $waktu_mulai          = $this->input->post('waktu_mulai',TRUE);
        $waktu_akhir          = $this->input->post('waktu_akhir',TRUE);

        $url            = site_url('master-jam/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('jam',$jam);
        $this->mydb1->set('waktu_mulai',$waktu_mulai);
        $this->mydb1->set('waktu_akhir',$waktu_akhir);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_jam');

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

    // function init_status_jam($id)
    // {
    //     $sql = "select id, status_guru from status_guru where id !=?";
    //     $queryRec = $this->db->query($sql, array($id));
    //     return $queryRec;
    // }

    // function init_jurusan($id)
    // {
    //     $sql = "select id, nama_jurusan from master_jurusan where id !=?";
    //     $queryRec = $this->db->query($sql, array($id));
    //     return $queryRec;
    // }

    // function init_status_guru($id)
    // {
    //     $sql = "select id, status_guru from status_guru where id !=?";
    //     $queryRec = $this->db->query($sql, array($id));
    //     return $queryRec;
    // }

}