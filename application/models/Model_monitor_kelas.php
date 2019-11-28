<?php
class Model_monitor_kelas extends CI_Model
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

        $tanda_guru          = $this->input->post('tanda_guru');
        $id_kelas          = $this->input->post('id_kelas');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('tanda_guru', 'tanda_guru', 'required');
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
        }
        else
        {
          
            $this->form_validation->set_rules('tanda_guru', 'tanda_guru', 'required');
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
        }

        $this->session->set_flashdata('tanda_guru', $tanda_guru);
        $this->session->set_flashdata('id_kelas', $id_kelas);

    }

    public function get_data_kelas()
    {
        $sql = "select a.*, b.nama_kelas from master_monitor_kelas a left join master_kelas b on a.id_kelas = b.id_kelas";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $tanda_guru          = $this->input->post('tanda_guru',TRUE);
        $id_kelas          = $this->input->post('id_kelas',TRUE);

        $url            = site_url('master-monitor-kelas/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('tanda_guru',$tanda_guru);
        $this->mydb1->insert('master_monitor_kelas');

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
        $this->mydb1->delete('master_monitor_kelas');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_monitor_kelas WHERE id = '$id'");
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
                                            a.tanda_guru,
                                            b.id_kelas,
                                            b.nama_kelas
                                        from 
                                            master_monitor_kelas a
                                        left join 
                                            master_kelas b
                                            on a.id_kelas = b.id_kelas
                                       
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
        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $tanda_guru          = $this->input->post('tanda_guru',TRUE);

        $url            = site_url('master-monitor-kelas/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('tanda_guru',$tanda_guru);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_monitor_kelas');

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
        $sql = "select id, nama_kelas from master_monitor_kelas where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

}