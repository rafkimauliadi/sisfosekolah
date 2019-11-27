<?php
class Model_izin_kepala_sekolah extends CI_Model
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

        $nama             = $this->input->post('nama');
        $asal             = $this->input->post('asal');
        $keperluan        = $this->input->post('keperluan');
        $tgl_urusan       = $this->input->post('tgl_urusan');
        $jam_urusan       = $this->input->post('jam_urusan');
        $status_izin      = $this->input->post('status_izin');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('asal', 'Asal/Instansi yang bersangkutan', 'required');
            $this->form_validation->set_rules('keperluan', 'Keperluan yang bersangkutan', 'required');
            $this->form_validation->set_rules('tgl_urusan', 'Tanggal Urusan Izin', 'required');
            $this->form_validation->set_rules('jam_urusan', 'Jam Urusan Izin', 'required');
            $this->form_validation->set_rules('status_izin', 'Status Izin', 'required');
        }
        else
        {
            $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
            $this->form_validation->set_rules('asal', 'Asal/Instansi yang bersangkutan', 'required');
            $this->form_validation->set_rules('keperluan', 'Keperluan yang bersangkutan', 'required');
            $this->form_validation->set_rules('tgl_urusan', 'Tanggal Urusan Izin', 'required');
            $this->form_validation->set_rules('jam_urusan', 'Jam Urusan Izin', 'required');
            $this->form_validation->set_rules('status_izin', 'Status Izin', 'required');
        }

        $this->session->set_flashdata('nama', $nama);
        $this->session->set_flashdata('asal', $asal);
        $this->session->set_flashdata('keperluan', $keperluan);
        $this->session->set_flashdata('tgl_urusan', $tgl_urusan);
        $this->session->set_flashdata('jam_urusan', $jam_urusan);
        $this->session->set_flashdata('status_izin', $status_izin);

    }

    public function get_list_izin()
    {
        $sql = "
        SELECT 
            a.id,
            a.nama,
            a.asal,
            a.keperluan,
            a.tgl_urusan,
            a.jam_urusan,
            b.status_izin as status_izin

            FROM izin_kepala_sekolah a
            LEFT JOIN _status_izin b on a.status_izin = b.id_status_izin
            ORDER BY a.tgl_urusan DESC";

        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $nama           = $this->input->post('nama',TRUE);
        $asal           = $this->input->post('asal',TRUE);
        $keperluan      = $this->input->post('keperluan',TRUE);
        $tgl_urusan     = $this->input->post('tgl_urusan',TRUE);
        $jam_urusan     = $this->input->post('jam_urusan',TRUE);
        $status_izin    = $this->input->post('status_izin',TRUE);

        $url            = site_url('izin-kepala-sekolah/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('asal',$asal);
        $this->mydb1->set('keperluan',$keperluan);
        $this->mydb1->set('tgl_urusan',$tgl_urusan);
        $this->mydb1->set('jam_urusan',$jam_urusan);
        $this->mydb1->set('status_izin',$status_izin);
        $this->mydb1->set('created_at',$created_time);
        $this->mydb1->insert('izin_kepala_sekolah');

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
        $this->mydb1->delete('izin_kepala_sekolah');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM izin_kepala_sekolah WHERE id = '$id'");
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
        $data =$this->mydb1->query("
            SELECT 
            a.id,
            a.nama,
            a.asal,
            a.keperluan,
            a.tgl_urusan,
            a.jam_urusan,
            a.status_izin,
            b.status_izin as status_izin

            FROM izin_kepala_sekolah a 

            LEFT JOIN _status_izin b on a.status_izin = b.id_status_izin

            WHERE a.id='$id'");

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

        $id             = $this->input->post('id',TRUE);
        $nama           = $this->input->post('nama',TRUE);
        $asal           = $this->input->post('asal',TRUE);
        $keperluan      = $this->input->post('keperluan',TRUE);
        $tgl_urusan     = $this->input->post('tgl_urusan',TRUE);
        $jam_urusan     = $this->input->post('jam_urusan',TRUE);
        $status_izin    = $this->input->post('status_izin',TRUE);

        $url            = site_url('izin_kepala_sekolah/edit/'.$id);

        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('nama',$nama);
        $this->mydb1->set('asal',$asal);
        $this->mydb1->set('keperluan',$keperluan);
        $this->mydb1->set('tgl_urusan',$tgl_urusan);
        $this->mydb1->set('jam_urusan',$jam_urusan);
        $this->mydb1->set('status_izin',$status_izin);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('izin_kepala_sekolah');

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

    function cari_siswa($query)
    {
        $sql = "SELECTs nama FROM izin_kepala_sekolah WHERE nama LIKE '%?%' ORDER BY nama DESC";
        $queryRec = $this->db->query($sql, array($query))->result_array();
        return $queryRec;
    }

    function init_status_izin($id)
    {
        $sql = "SELECT id_status_izin, status_izin FROM _status_izin WHERE id_status_izin !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

}