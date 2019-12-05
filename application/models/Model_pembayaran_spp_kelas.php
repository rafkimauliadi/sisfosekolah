<?php
class Model_pembayaran_spp_kelas extends CI_Model
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

        $id_kelas               = $this->input->post('id_kelas');
        $id_guru                = $this->input->post('id_guru');
        $bulan                  = $this->input->post('bulan');
        $tahun                  = $this->input->post('tahun');
        $jml_bayar              = $this->input->post('jml_bayar');
        $jml_keseluruhan        = $this->input->post('jml_keseluruhan');
        $id_status_spp_kelas    = $this->input->post('id_status_spp_kelas');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('id_kelas', 'id kelas', 'required');
            $this->form_validation->set_rules('id_guru', 'id guru', 'required');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Izin', 'required');
            $this->form_validation->set_rules('jml_bayar', 'Jumlah yang sudah di bayar', 'required');
            $this->form_validation->set_rules('jml_keseluruhan', 'Jumlah total sebenarnya', 'required');
            $this->form_validation->set_rules('id_status_spp_kelas', 'Status Pembayaran Uang SPP Kelas', 'required');
        }
        else
        {
            $this->form_validation->set_rules('id_kelas', 'id kelas', 'required');
            $this->form_validation->set_rules('id_guru', 'id guru', 'required');
            $this->form_validation->set_rules('bulan', 'Bulan', 'required');
            $this->form_validation->set_rules('tahun', 'Tahun Izin', 'required');
            $this->form_validation->set_rules('jml_bayar', 'Jumlah yang sudah di bayar', 'required');
            $this->form_validation->set_rules('jml_keseluruhan', 'Jumlah total sebenarnya', 'required');
            $this->form_validation->set_rules('id_status_spp_kelas', 'Status Pembayaran Uang SPP Kelas', 'required');
        }

        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('id_guru', $id_guru);
        $this->session->set_flashdata('bulan', $bulan);
        $this->session->set_flashdata('tahun', $tahun);
        $this->session->set_flashdata('jml_bayar', $jml_bayar);
        $this->session->set_flashdata('jml_keseluruhan', $jml_keseluruhan);
        $this->session->set_flashdata('id_status_spp_kelas', $id_status_spp_kelas);
    }

    public function get_list_data()
    {
        $sql = "
        SELECT 
            a.id,
            a.id_kelas,
            a.id_guru,
            a.bulan,
            a.tahun,
            a.jml_bayar,
            a.jml_keseluruhan,
            a.id_status_spp_kelas,
            DATE_FORMAT(a.created_date, '%d-%M-%Y') as tanggal_input,
            b.nama_kelas as nama_kelas,
            c.status_spp_kelas as status_spp_kelas

            FROM pembayaran_spp_kelas a 
            LEFT JOIN master_kelas b on a.id_kelas = b.id_kelas
            LEFT JOIN _status_spp_kelas c on a.id_status_spp_kelas = c.id_status_spp_kelas";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $id_kelas               = $this->input->post('id_kelas',TRUE);
        $id_guru                = $this->input->post('id_guru',TRUE);
        $bulan                  = $this->input->post('bulan',TRUE);
        $tahun                  = $this->input->post('tahun',TRUE);
        $jml_bayar              = $this->input->post('jml_bayar',TRUE);
        $jml_keseluruhan        = $this->input->post('jml_keseluruhan',TRUE);
        $id_status_spp_kelas    = $this->input->post('id_status_spp_kelas',TRUE);

        $url            = site_url('pembayaran-spp-kelas/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('jml_bayar',$jml_bayar);
        $this->mydb1->set('jml_keseluruhan',$jml_keseluruhan);
        $this->mydb1->set('id_status_spp_kelas',$id_status_spp_kelas);
        $this->mydb1->set('created_date',$created_date);
        $this->mydb1->set('created_modified',$created_date);
        $this->mydb1->insert('pembayaran_spp_kelas');

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
        $this->mydb1->delete('pembayaran_spp_kelas');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM pembayaran_spp_kelas WHERE id = '$id'");
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
            a.id_kelas,
            a.id_guru,
            a.bulan,
            a.tahun,
            a.jml_bayar,
            a.jml_keseluruhan,
            a.id_status_spp_kelas,

            b.nama_kelas as nama_kelas,
            c.status_spp_kelas as status_spp_kelas

            FROM pembayaran_spp_kelas a 
            LEFT JOIN master_kelas b on a.id_kelas = b.id_kelas
            LEFT JOIN _status_spp_kelas c on a.id_status_spp_kelas = c.id_status_spp_kelas
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
        $id_kelas               = $this->input->post('id_kelas',TRUE);
        $id_guru                = $this->input->post('id_guru',TRUE);
        $bulan                  = $this->input->post('bulan',TRUE);
        $tahun                  = $this->input->post('tahun',TRUE);
        $jml_bayar              = $this->input->post('jml_bayar',TRUE);
        $jml_keseluruhan        = $this->input->post('jml_keseluruhan',TRUE);
        $id_status_spp_kelas    = $this->input->post('id_status_spp_kelas',TRUE);

        $url            = site_url('pembayaran_spp_kelas/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_modified       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('bulan',$bulan);
        $this->mydb1->set('tahun',$tahun);
        $this->mydb1->set('jml_bayar',$jml_bayar);
        $this->mydb1->set('jml_keseluruhan',$jml_keseluruhan);
        $this->mydb1->set('id_status_spp_kelas',$id_status_spp_kelas);
        $this->mydb1->set('created_modified',$created_modified);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('pembayaran_spp_kelas');

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
        $sql = "SELECTs nis FROM pembayaran_spp_kelas WHERE nis LIKE '%?%' ORDER BY nis DESC";
        $queryRec = $this->db->query($sql, array($query))->result_array();
        return $queryRec;
    }

    function init_kelas($id)
    {
        $sql = "SELECT id_kelas, nama_kelas FROM master_kelas WHERE id_kelas !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_status_pembayaran($id)
    {
        $sql = "SELECT id_status_spp_kelas, status_spp_kelas FROM _status_spp_kelas WHERE id_status_spp_kelas !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function search_blog($nis){
        $this->db->like('nis', $nis , 'both');
        $this->db->order_by('nis', 'ASC');
        $this->db->limit(10);
        return $this->db->get('master_siswa')->result();
    }

}