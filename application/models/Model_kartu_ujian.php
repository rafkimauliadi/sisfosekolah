<?php
class Model_kartu_ujian extends CI_Model
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
            *
        FROM master_siswa";
        $queryRec = $this->db->query($sql);
        return $queryRec;
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


    public function get_data_detail($nis){
        $query = $this->db->get_where('master_siswa', 
                array('nis' => $nis))->row();
        return $query;
    }
    public function get_data_detail2($tahun){
        $query = $this->db->get_where('tahun_ajaran', 
                array('id' => $tahun))->row();
        return $query;
    }

}