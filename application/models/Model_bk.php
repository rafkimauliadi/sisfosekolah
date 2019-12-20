<?php
class Model_bk extends CI_Model
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
        $nis            = $this->input->post('nis');
        $date           = $this->input->post('date');
        $permasalahan   = $this->input->post('permasalahan');
        $penyelesaian   = $this->input->post('penyelesaian');
        if ($action=='simpan')
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('date', 'Tanggal Kasus', 'required');
            $this->form_validation->set_rules('permasalahan', 'Permasalahan yang terjadi', 'required');
            $this->form_validation->set_rules('penyelesaian', 'Tata Cara Penyelesaian', 'required');
        }
        else
        {
            $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
            $this->form_validation->set_rules('date', 'Tanggal Kasus', 'required');
            $this->form_validation->set_rules('permasalahan', 'Permasalahan yang terjadi', 'required');
            $this->form_validation->set_rules('penyelesaian', 'Tata Cara Penyelesaian', 'required');
        }
        $this->session->set_flashdata('nis', $nis);
        $this->session->set_flashdata('date', $date);
        $this->session->set_flashdata('permasalahan', $permasalahan);
        $this->session->set_flashdata('penyelesaian', $penyelesaian);
    }
    public function get_list_bk()
    {
        $sql = "SELECT a.*,
                DATE_FORMAT(a.date, '%d %M %Y') as date,
        b.nama_lengkap as nama_lengkap 
        FROM bimbingan_konseling a 
            LEFT JOIN master_siswa b on (a.nis = b.nis)";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }
    public function init_save()
    {
        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $nis                = $this->input->post('nis',TRUE);
        $date               = $this->input->post('date',TRUE);
        $permasalahan       = $this->input->post('permasalahan',TRUE);
        $penyelesaian       = $this->input->post('penyelesaian',TRUE);
        $url            = site_url('bimbingan-konseling/edit/'.$id);
        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('date',$date);
        $this->mydb1->set('permasalahan',$permasalahan);
        $this->mydb1->set('penyelesaian',$penyelesaian);
        // $this->mydb1->set('created_at',$created_time);
        $this->mydb1->insert('bimbingan_konseling');
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
        $this->mydb1->delete('bimbingan_konseling');
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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM bimbingan_konseling WHERE id = '$id'");
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
            a.date,
            a.permasalahan,
            a.penyelesaian,
            b.nama_lengkap as nama_siswa 
            FROM bimbingan_konseling a 
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
        $id          = $this->input->post('id',TRUE);
        $nis          = $this->input->post('nis',TRUE);
        $date         = $this->input->post('date',TRUE);
        $permasalahan = $this->input->post('permasalahan',TRUE);
        $penyelesaian = $this->input->post('penyelesaian',TRUE);
        $url            = site_url('bimbingan_konseling/edit/'.$id);
        // date_default_timezone_set('Asia/Jakarta');
        // $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $this->mydb1->trans_start();
        $this->mydb1->set('nis',$nis);
        $this->mydb1->set('date',$date);
        $this->mydb1->set('permasalahan',$permasalahan);
        $this->mydb1->set('penyelesaian',$penyelesaian);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('bimbingan_konseling');
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
        $sql = "SELECTs nis FROM bimbingan_konseling WHERE nis LIKE '%?%' ORDER BY nis DESC";
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