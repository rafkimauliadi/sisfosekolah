<?php
class Model_mapel extends CI_Model
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

        $nama_mapel          = $this->input->post('nama_mapel');
        $kode_mapel          = $this->input->post('kode_mapel');
        $id_kelompok          = $this->input->post('id_kelompok');
        $id_peminatan          = $this->input->post('id_peminatan');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required');
            $this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required');
            $this->form_validation->set_rules('id_kelompok', 'Kelompok Mata Pelajaran', 'required');
            $this->form_validation->set_rules('id_peminatan', 'Peminatan Mata Pelajaran', 'required');
        }
        else
        {
            $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required');
            $this->form_validation->set_rules('kode_mapel', 'Kode Mata Pelajaran', 'required');
            $this->form_validation->set_rules('id_kelompok', 'Kelompok Mata Pelajaran', 'required');
            $this->form_validation->set_rules('id_peminatan', 'Peminatan Mata Pelajaran', 'required');
        }

        $this->session->set_flashdata('nama_mapel', $nama_mapel);
        $this->session->set_flashdata('kode_mapel', $kode_mapel);
        $this->session->set_flashdata('id_kelompok', $id_kelompok);
        $this->session->set_flashdata('id_peminatan', $id_peminatan);

    }

    public function get_data_mapel()
    {
        $sql = "select a.*, b.nama_kelompok, c.nama_peminatan from master_mata_pelajaran a left join master_kelompok_mapel b on a.kelompok_mapel = b.id
        left join master_peminatan_mapel c on a.id_peminatan = c.id";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);


        $nama_mapel       = $this->input->post('nama_mapel',TRUE);
        $kode_mapel       = $this->input->post('kode_mapel',TRUE);
        $id_kelompok       = $this->input->post('id_kelompok',TRUE);
        $id_peminatan       = $this->input->post('id_peminatan',TRUE);
        

        $url            = site_url('mata-pelajaran/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_mapel',$nama_mapel);
        $this->mydb1->set('kode_mapel',$kode_mapel);
        $this->mydb1->set('kelompok_mapel',$id_kelompok);
        $this->mydb1->set('id_peminatan',$id_peminatan);
        $this->mydb1->set('created_at',$created_time);
        $this->mydb1->set('last_update',$created_time);
        $this->mydb1->insert('master_mata_pelajaran');

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

        $this->mydb1->where('id_mata_pelajaran',$id);
        $this->mydb1->delete('master_mata_pelajaran');

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
        $query = $this->mydb1->query("SELECT count(id_mata_pelajaran) as exist FROM master_mata_pelajaran WHERE id_mata_pelajaran = '$id'");
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
                                            a.id_mata_pelajaran,
                                            a.nama_mapel,
                                            a.kode_mapel,
                                            a.kelompok_mapel,
                                            b.nama_kelompok,
                                            a.id_peminatan,
                                            c.nama_peminatan
                                        from 
                                            master_mata_pelajaran a
                                        left join 
                                            master_kelompok_mapel b
                                            on a.kelompok_mapel = b.id
                                        left join 
                                            master_peminatan_mapel c
                                            on a.id_peminatan = c.id
                                        WHERE 
                                            id_mata_pelajaran='$id'");
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
        $nama_mapel       = $this->input->post('nama_mapel',TRUE);
        $kode_mapel       = $this->input->post('kode_mapel',TRUE);
        $id_kelompok       = $this->input->post('id_kelompok',TRUE);
        $id_peminatan       = $this->input->post('id_peminatan',TRUE);

        $url            = site_url('mata-pelajaran/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama_mapel',$nama_mapel);
        $this->mydb1->set('last_update',$created_time);
        $this->mydb1->set('kode_mapel',$kode_mapel);
        $this->mydb1->set('kelompok_mapel',$id_kelompok);
        $this->mydb1->set('id_peminatan',$id_peminatan);
        $this->mydb1->where('id_mata_pelajaran',$id);
        $this->mydb1->update('master_mata_pelajaran');

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

    function init_kelompok_mapel($id)
    {
        $sql = "select id, nama_kelompok from master_kelompok_mapel where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_peminatan_mapel($id)
    {
        $sql = "select id, nama_peminatan from master_peminatan_mapel where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

}