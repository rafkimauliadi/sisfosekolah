<?php
class Model_combo_r extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }

    public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function order_no($field,$tabel,$values)
    {
        $query = $this->mydb1->query("SELECT count(".$field.") as exist FROM ".$tabel." where parent_id='$values'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function init_cb_gender($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_gender,
                                        kd_gender,
                                        jenis_kelamin
                                    FROM 
                                        _gender
                                    WHERE 
                                        id_gender <> '$id'
                                    ");
        return $data;
    }

    public function init_cb_agama($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        kd_agama,
                                        agama
                                    FROM 
                                        _agama
                                    WHERE 
                                        kd_agama <> '$id'
                                    ");
        return $data;
    }
    public function init_cb_status_pegawai($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id,
                                        status_pegawai
                                    FROM 
                                        master_status_pegawai
                                    WHERE 
                                        id <> '$id'
                                    ");
        return $data;
    }

    public function init_cb_status_anak($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_status_anak,
                                        status_anak
                                    FROM 
                                        _status_anak
                                    WHERE 
                                        id_status_anak <> '$id'
                                    ");
        return $data;
    }

    public function init_cb_kelas($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_kelas,
                                        nama_kelas
                                    FROM 
                                        master_kelas
                                    WHERE 
                                        id_kelas <> '$id'
                                    AND 
                                        status='1'
                                    ");
        return $data;
    }

    public function init_cb_satus_peserta_didik($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_status,
                                        nm_status
                                    FROM 
                                        _status_peserta_didik
                                    WHERE 
                                        id_status <> '$id'
                                    ");
        return $data;
    }

    public function status_guru($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id as id_status,
                                        status_guru as nm_status
                                    FROM 
                                        status_guru
                                    WHERE 
                                        id <> '$id'
                                    ");
        return $data;
    }

    public function jabatan_guru($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id as id_status,
                                        nama_jabatan as nm_status
                                    FROM 
                                        master_jabatan_guru
                                    WHERE 
                                        id <> '$id'
                                    ");
        return $data;
    }

    
}