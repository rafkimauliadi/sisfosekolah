<?php
class Model_siswa_kelas extends CI_Model
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

        $id_kelas          = $this->input->post('id_kelas');
        $id_siswa         = $this->input->post('id_siswa');
        $id_tahun_ajaran          = $this->input->post('id_tahun_ajaran');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_siswa', 'id_siswa', 'required');
            $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'required');
        }
        else
        {
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_siswa', 'id_siswa', 'required');
            $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'required');
        }

        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('id_siswa', $id_siswa);
        $this->session->set_flashdata('id_tahun_ajaran', $id_tahun_ajaran);

    }

    public function get_data_siswa_kelas()
    {
        // $sql = "select * from master_siswa_kelas";
      $sql = "select master_siswa_kelas.id as id,
        master_siswa_kelas.id_kelas,
        master_siswa_kelas. id_siswa,
        master_kelas.nama_kelas,
        master_jurusan.nama_jurusan,
        nis,nama_lengkap,
        id_tahun_ajaran,tahun
    from 
        master_siswa_kelas, master_jurusan, master_kelas, master_siswa, tahun_ajaran
    WHERE 
    master_siswa_kelas.id_kelas=master_kelas.id_kelas 
    and master_siswa_kelas.id_siswa=master_siswa.id
    and master_kelas.id_jurusan=master_jurusan.id and
    master_siswa_kelas.id_tahun_ajaran=tahun_ajaran.id ";

        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_siswa          = $this->input->post('id_siswa',TRUE);
        $id_tahun_ajaran          = $this->input->post('id_tahun_ajaran',TRUE);

        $url            = site_url('siswa-kelas/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_siswa',$id_siswa);
        $this->mydb1->set('id_tahun_ajaran',$id_tahun_ajaran);
        $this->mydb1->insert('master_siswa_kelas');

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
        $this->mydb1->delete('master_siswa_kelas');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_siswa_kelas WHERE id = '$id'");
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
                                            master_siswa_kelas.id as id,
                                            master_siswa_kelas.id_kelas,
                                            master_siswa_kelas. id_siswa,
                                            master_kelas.nama_kelas,
                                            master_jurusan.nama_jurusan,
                                            nis,nama_lengkap,
                                            id_tahun_ajaran,tahun
                                        from 
                                            master_siswa_kelas, master_jurusan, master_kelas, master_siswa, tahun_ajaran
                                        WHERE 
                                        master_siswa_kelas.id_kelas=master_kelas.id_kelas 
                                        and master_siswa_kelas.id_siswa=master_siswa.id
                                        and master_kelas.id_jurusan=master_jurusan.id and
                                        master_siswa_kelas.id_tahun_ajaran=tahun_ajaran.id and
                                            master_siswa_kelas.id='$id'");
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
        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_siswa          = $this->input->post('id_siswa',TRUE);
        $id_tahun_ajaran          = $this->input->post('id_tahun_ajaran',TRUE);

        $url            = site_url('master-siswa_kelas/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_siswa',$id_siswa);
        $this->mydb1->set('id_tahun_ajaran',$id_tahun_ajaran);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_siswa_kelas');

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

  

}