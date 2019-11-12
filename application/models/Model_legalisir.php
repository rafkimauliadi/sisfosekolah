<?php
class Model_legalisir extends CI_Model
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

        $nis                    = $this->input->post('nis');
        $no_ijazah              = $this->input->post('no_ijazah');
        $tahun_ijazah           = $this->input->post('tahun_ijazah');
        $tgl_masuk_legalisir    = $this->input->post('tgl_masuk_legalisir');
        $tgl_selesai_legalisir  = $this->input->post('tgl_selesai_legalisir');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('no_ijazah', 'Nomor Ijazah siswa yang bersangkutan', 'required');
            $this->form_validation->set_rules('tahun_ijazah', 'Tahun Ijazah', 'required');
            $this->form_validation->set_rules('tgl_masuk_legalisir', 'Tanggal Masuk Legalisir', 'required');
            $this->form_validation->set_rules('tgl_selesai_legalisir', 'Tanggal Jemput Legalisir', 'required');
        }
        else
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('no_ijazah', 'Nomor Ijazah siswa yang bersangkutan', 'required');
            $this->form_validation->set_rules('tahun_ijazah', 'Tahun Ijazah', 'required');
            $this->form_validation->set_rules('tgl_masuk_legalisir', 'Tanggal Masuk Legalisir', 'required');
            $this->form_validation->set_rules('tgl_selesai_legalisir', 'Tanggal Jemput Legalisir', 'required');
        }

        $this->session->set_flashdata('nis', $nis);
        $this->session->set_flashdata('no_ijazah', $no_ijazah);
        $this->session->set_flashdata('tahun_ijazah', $tahun_ijazah);
        $this->session->set_flashdata('tgl_masuk_legalisir', $tgl_masuk_legalisir);
        $this->session->set_flashdata('tgl_selesai_legalisir', $tgl_selesai_legalisir);

    }

    public function get_list_legalisir()
    {
        $sql = "SELECT a.*,b.nama_lengkap as nama_siswa FROM legalisir_ijazah a 
            LEFT JOIN master_siswa b on (a.nis = b.nis)";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $nis                    = $this->input->post('nis',TRUE);
        $no_ijazah              = $this->input->post('no_ijazah',TRUE);
        $tahun_ijazah           = $this->input->post('tahun_ijazah',TRUE);
        $tgl_masuk_legalisir    = $this->input->post('tgl_masuk_legalisir',TRUE);
        $tgl_selesai_legalisir  = $this->input->post('tgl_selesai_legalisir',TRUE);

        $url            = site_url('legalisir-ijazah/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('no_ijazah',$no_ijazah);
        $this->mydb1->set('tahun_ijazah',$tahun_ijazah);
        $this->mydb1->set('tgl_masuk_legalisir',$tgl_masuk_legalisir);
        $this->mydb1->set('tgl_selesai_legalisir',$tgl_selesai_legalisir);
        // $this->mydb1->set('created_at',$created_time);
        $this->mydb1->insert('legalisir_ijazah');

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
        $this->mydb1->delete('legalisir_ijazah');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM legalisir_ijazah WHERE id = '$id'");
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
            a.nis,
            a.no_ijazah,
            a.tahun_ijazah,
            a.tgl_masuk_legalisir,
            a.tgl_selesai_legalisir,

            b.nama_lengkap as nama_siswa 

            FROM legalisir_ijazah a 

            LEFT JOIN master_siswa b on a.nis = b.nis
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

        $id                     = $this->input->post('id',TRUE);
        $nis                    = $this->input->post('nis',TRUE);
        $no_ijazah              = $this->input->post('no_ijazah',TRUE);
        $tahun_ijazah           = $this->input->post('tahun_ijazah',TRUE);
        $tgl_masuk_legalisir    = $this->input->post('tgl_masuk_legalisir',TRUE);
        $tgl_selesai_legalisir  = $this->input->post('tgl_selesai_legalisir',TRUE);

        $url            = site_url('legalisir_ijazah/edit/'.$id);

        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('no_ijazah',$no_ijazah);
        $this->mydb1->set('tahun_ijazah',$tahun_ijazah);
        $this->mydb1->set('tgl_masuk_legalisir',$tgl_masuk_legalisir);
        $this->mydb1->set('tgl_selesai_legalisir',$tgl_selesai_legalisir);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('legalisir_ijazah');

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
        $sql = "SELECTs nis FROM legalisir_ijazah WHERE nis LIKE '%?%' ORDER BY nis DESC";
        $queryRec = $this->db->query($sql, array($query))->result_array();
        return $queryRec;
    }

}