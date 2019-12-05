<?php
class Model_absensi_guru extends CI_Model
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

        $id_guru          = $this->input->post('id_guru');
        $absen          = $this->input->post('absen');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
            $this->form_validation->set_rules('absen', 'absen', 'required');
        }
        else
        {
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
            $this->form_validation->set_rules('absen', 'absen', 'required');
        }

        $this->session->set_flashdata('id_guru', $id_guru);
        $this->session->set_flashdata('absen', $absen);

    }

    public function get_data_absensi_guru()
    {
        $sql = "select a.*, b.nip,b.nama_lengkap from master_absensi_guru a left join master_guru b on a.id_guru = b.id";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $id_guru          = $this->input->post('id_guru',TRUE);
        $absen          = $this->input->post('absen',TRUE);

        $url            = site_url('master-absensi-guru/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('absen',$absen);
        $this->mydb1->insert('master_absensi_guru');

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
        $this->mydb1->delete('master_absensi_guru');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_absensi_guru WHERE id = '$id'");
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
                                            a.absen,
                                            b.id,b.nip,b.nama_lengkap
                                        from 
                                            master_absensi_guru a
                                        left join 
                                            master_guru b
                                            on a.id_guru= b.id
                                        WHERE 
                                            a.id='$id'");
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
        $id_guru          = $this->input->post('id_guru',TRUE);
        $absen          = $this->input->post('absen',TRUE);

        $url            = site_url('master-absensi-guru/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('absen',$absen);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_absensi_guru');

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

    function init_guru($id)
    {
        $sql = "select id, nip, nama_lengkap from master_guru where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

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