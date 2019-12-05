<?php
class Model_pembayaran_spp extends CI_Model
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

        $nis                = $this->input->post('nis');
        $id_kelas         = $this->input->post('id_kelas');
        $bulan  = $this->input->post('bulan');
        $tahun   = $this->input->post('tahun');
        $total_bayar   = $this->input->post('total_bayar');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Izin', 'required');
            $this->form_validation->set_rules('total_bayar', 'Total Uang SPP Perbulan', 'required');
        }
        else
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Izin', 'required');
            $this->form_validation->set_rules('total_bayar', 'Total Uang SPP Perbulan', 'required');
        }

        $this->session->set_flashdata('nis', $nis);
        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('bulan', $bulan);
        $this->session->set_flashdata('tahun', $tahun);
        $this->session->set_flashdata('total_bayar', $total_bayar);
    }

    public function get_list_data()
    {
        $sql = "
        SELECT 
            a.id,
            a.nis,
            a.id_kelas,
            a.bulan,
            a.tahun,
            a.total_bayar,
            DATE_FORMAT(a.created_date, '%d-%M-%Y') as tanggal_input,
            b.nama_lengkap as nama_siswa,
            c.nama_kelas as nama_kelas

            FROM pembayaran_spp a 
            LEFT JOIN master_siswa b on a.nis = b.nis
            LEFT JOIN master_kelas c on a.id_kelas = c.id_kelas";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $nis                 = $this->input->post('nis',TRUE);
        $id_kelas            = $this->input->post('id_kelas',TRUE);
        $bulan               = $this->input->post('bulan',TRUE);
        $tahun               = $this->input->post('tahun',TRUE);
        $total_bayar         = $this->input->post('total_bayar',TRUE);

        $url            = site_url('pembayaran-spp/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('total_bayar',$total_bayar);
        $this->mydb1->set('created_date',$created_date);
        $this->mydb1->set('created_modified',$created_date);
        $this->mydb1->insert('pembayaran_spp');

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
        $this->mydb1->delete('pembayaran_spp');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM pembayaran_spp WHERE id = '$id'");
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
            a.id_kelas,
            a.bulan,
            a.tahun,
            a.total_bayar,
            b.nama_lengkap as nama_siswa,
            c.nama_kelas as nama_kelas

            FROM pembayaran_spp a 

            LEFT JOIN master_siswa b on a.nis = b.nis
            LEFT JOIN master_kelas c on a.id_kelas = c.id_kelas
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

        $id              = $this->input->post('id',TRUE);
        $nis             = $this->input->post('nis',TRUE);
        $id_kelas       = $this->input->post('id_kelas',TRUE);
        $bulan          = $this->input->post('bulan',TRUE);
        $tahun          = $this->input->post('tahun',TRUE);
        $total_bayar    = $this->input->post('total_bayar',TRUE);

        $url            = site_url('pembayaran_spp/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_modified       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('total_bayar',$total_bayar);
        $this->mydb1->set('created_modified',$created_modified);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('pembayaran_spp');

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
        $sql = "SELECTs nis FROM pembayaran_spp WHERE nis LIKE '%?%' ORDER BY nis DESC";
        $queryRec = $this->db->query($sql, array($query))->result_array();
        return $queryRec;
    }

    function search_blog($nis){
        $this->db->like('nis', $nis , 'both');
        $this->db->order_by('nis', 'ASC');
        $this->db->limit(10);
        return $this->db->get('master_siswa')->result();
    }

}