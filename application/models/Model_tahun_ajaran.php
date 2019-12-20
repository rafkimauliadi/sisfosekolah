<?php
class Model_tahun_ajaran extends CI_Model
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

        $tahun          = $this->input->post('tahun');
        $bulan          = $this->input->post('bulan');
        $smester          = $this->input->post('semester');
        $status          = $this->input->post('status');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('bulan', 'bulan', 'required');
            $this->form_validation->set_rules('semester', 'semester', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

        }
        else
        {
            $this->form_validation->set_rules('tahun', 'tahun', 'required');
            $this->form_validation->set_rules('bulan', 'bulan', 'required');
            $this->form_validation->set_rules('semester', 'semester', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

        }

        $this->session->set_flashdata('tahun', $tahun);
        $this->session->set_flashdata('bulan', $bulan);
        $this->session->set_flashdata('semester', $smester);
        $this->session->set_flashdata('status', $status);

    }

    public function get_data_tahun_ajaran()
    {
        $sql = "select * from tahun_ajaran";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $tahun          = $this->input->post('tahun',TRUE);
        $bulan          = $this->input->post('bulan',TRUE);
        $semester          = $this->input->post('semester',TRUE);
        $status          = $this->input->post('status',TRUE);

        $url            = site_url('tahun-ajaran/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('semester',$semester);
        $this->mydb1->set('status',$status);
        $this->mydb1->insert('tahun_ajaran');

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
        $this->mydb1->delete('tahun_ajaran');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM tahun_ajaran WHERE id = '$id'");
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
                                            tahun,bulan,semester,status
                                            
                                        from 
                                            tahun_ajaran
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
        $tahun          = $this->input->post('tahun',TRUE);
        $bulan          = $this->input->post('bulan',TRUE);
        $semester          = $this->input->post('semester',TRUE);
        $status          = $this->input->post('status',TRUE);

        $url            = site_url('tahun-ajaran/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('semester',$semester);
        $this->mydb1->set('status',$status);

        $this->mydb1->where('id',$id);
        $this->mydb1->update('tahun_ajaran');

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