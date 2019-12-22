<?php
class Model_kelas extends CI_Model
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

        $nama_kelas          = $this->input->post('nama_kelas');
        $id_status          = $this->input->post('id_status');
        $id_jurusan          = $this->input->post('id_jurusan');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
            $this->form_validation->set_rules('id_status', 'Status', 'required');
            $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        }
        else
        {
          $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
          $this->form_validation->set_rules('id_status', 'Status', 'required');
          $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
        }

        $this->session->set_flashdata('nama_kelas', $nama_kelas);
        $this->session->set_flashdata('id_status', $id_status);
        $this->session->set_flashdata('id_jurusan', $id_jurusan);

    }

    public function get_data_kelas()
    {
        $sql = "select a.*, b.nama_status,c.nama_jurusan from master_kelas a left join master_status_kelas b on a.status = b.id_status
        left join master_jurusan c on a.id_jurusan = c.id";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $nama_kelas          = $this->input->post('nama_kelas',TRUE);
        $id_status          = $this->input->post('id_status',TRUE);
        $id_jurusan          = $this->input->post('id_jurusan',TRUE);

        $url            = site_url('master-kelas/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_kelas',$nama_kelas);
        $this->mydb1->set('status',$id_status);
        $this->mydb1->set('id_jurusan',$id_jurusan);
        $this->mydb1->set('created_at',$created_time);
        $this->mydb1->insert('master_kelas');

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

        $this->mydb1->where('id_kelas',$id);
        $this->mydb1->delete('master_kelas');

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
        $query = $this->mydb1->query("SELECT count(id_kelas) as exist FROM master_kelas WHERE id_kelas = '$id'");
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
                                            a.id_kelas,
                                            a.nama_kelas,
                                            a.status,
                                            b.nama_status,
                                            a.id_jurusan,
                                            c.nama_jurusan
                                        from 
                                            master_kelas a
                                        left join 
                                            master_status_kelas b
                                            on a.status = b.id_status
                                        left join 
                                            master_jurusan c
                                            on a.id_jurusan = c.id
                                        WHERE 
                                            id_kelas='$id'");
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

        $id             = $this->format_data->string($this->input->post('id_kelas',TRUE));
        $nama_kelas          = $this->input->post('nama_kelas',TRUE);
        $id_status          = $this->input->post('id_status',TRUE);
        $id_jurusan          = $this->input->post('id_jurusan',TRUE);

        $url            = site_url('master-kelas/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_kelas',$nama_kelas);
        $this->mydb1->set('status',$id_status);
        $this->mydb1->set('id_jurusan',$id_jurusan);
        $this->mydb1->where('id_kelas',$id);
        $this->mydb1->update('master_kelas');

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

    function init_status_kelas($id)
    {
        $sql = "select id_status, nama_status from master_status_kelas where id_status !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_jurusan($id)
    {
        $sql = "select id, nama_jurusan from master_jurusan where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_status_guru($id)
    {
        $sql = "select id, status_guru from status_guru where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

}