<?php
class Model_combo extends CI_Model
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

    public function init_status($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_status,
                                        nm_status
                                    FROM 
                                        _status_system
                                    WHERE   
                                        id_status != $id
                                    and
                                        id_status not in(4,5) 
                                    ");
        return $data;
    }

    public function init_status_publish($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_status,
                                        nm_status
                                    FROM 
                                        _status_system
                                    WHERE   
                                        id_status  in(4,5) 
                                    ");
        return $data;
    }

    public function init_group_set($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_group,
                                        nm_group
                                    FROM 
                                        _group
                                    where
                                        id_group <> $id
                                    ");
        return $data;
    }

    public function init_group()
    {
        $data =$this->mydb1->query("SELECT 
                                        id_group,
                                        nm_group
                                    FROM 
                                        _group
                                    ");
        return $data;
    }

    public function init_status_document($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_status,
                                        nm_status
                                    FROM 
                                        _status_file
                                    WHERE   
                                        id_status != $id
                                    ");
        return $data;
    }

    public function init_label($id)
    {
        $id_user=$this->model_hook->init_online_exist();
        $data =$this->mydb1->query("SELECT 
                                        id_category,
                                        title
                                    FROM 
                                        _dropbox_category
                                    WHERE   
                                        id_category != $id
                                    and 
                                        id_user='$id_user'
                                    ");
        return $data;
    }

    public function init_category($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_category,
                                        title
                                    FROM 
                                        category
                                    WHERE   
                                        id_category != $id
                                    ");
        return $data;
    }

    public function init_jenis_layanan($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        id_kategori,
                                        nama_kategori
                                    FROM 
                                        layanan_kategori
                                    WHERE   
                                        id_kategori != $id
                                    ");
        return $data;
    }

    public function max_order_no($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT count(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0; 
    }

    public function init_status_layanan($id)
    {
        $data =$this->mydb1->query("SELECT 
                                        status_layanan,
                                        keterangan
                                    FROM 
                                        _status_layanan
                                    WHERE   
                                        status_layanan != $id
                                    ");
        return $data;
    }

    public function init_jenis_layanan_tersedia($id)
    {
        $id_hotel        = $this->model_hook->init_profile_user()->id_instansi;

        $data =$this->mydb1->query("SELECT 
                                        a.id_kategori,
                                        a.nama_kategori 
                                    from 
                                        layanan_kategori a
                                    WHERE not exists  
                                        (select 
                                            b.id_kategori 
                                        from 
                                            layanan_kategori_hotel b 
                                        where 
                                            b.id_kategori = a.id_kategori
                                        and  
                                            b.id_hotel = '$id_hotel')
                                    AND 
                                        a.id_kategori <> '$id'
                                    ");
        return $data;
    }

    public function init_jenis_layanan_combo($id)
    {
        $id_hotel        = $this->model_hook->init_profile_user()->id_instansi;

        $data =$this->mydb1->query("SELECT 
                                        a.id_kategori,

                                        b.nama_kategori 
                                    from 
                                        layanan_kategori_hotel a
                                        LEFT JOIN layanan_kategori b ON (a.id_kategori=b.id_kategori)
                                    AND 
                                        a.id_hotel = '$id_hotel'
                                    AND
                                        a.id_kategori <> '$id'
                                    ");
        return $data;
    }

    public function init_type_kamar_tersedia($id)
    {
        $id_hotel        = $this->model_hook->init_profile_user()->id_instansi;

        $data =$this->mydb1->query("SELECT 
                                        a.id_jenis,
                                        a.nama_jenis 
                                    from 
                                        jenis_kamar a
                                    WHERE not exists  
                                        (select 
                                            b.id_jenis 
                                        from 
                                            jenis_kamar_hotel b 
                                        where 
                                            b.id_jenis = a.id_jenis
                                        and  
                                            b.id_hotel = '$id_hotel')
                                    AND 
                                        a.id_jenis <> '$id'
                                    ");
        return $data;
    }


    public function init_jenis_kamar($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_jenis,

                                        a.nama_jenis, 
                                        a.keterangan 
                                    from 
                                        jenis_kamar a
                                    WHERE
                                        a.id_jenis <> '$id'
                                    ");
        return $data;
    }

    public function init_jenis_room($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_room,

                                        a.label 
                                    from 
                                        room a
                                    WHERE
                                        a.id_room <> '$id'
                                    ");
        return $data;
    }

    public function init_jenis_ranjang($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_ranjang,
                                        a.kasur,

                                        a.keterangan 
                                    from 
                                        ranjang a
                                    WHERE
                                        a.id_ranjang <> '$id'
                                    ");
        return $data;
    }

    public function init_lokasi($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_lokasi,
                                        a.lantai
                                    from 
                                        lokasi a
                                    WHERE
                                        a.id_lokasi <> '$id'
                                    AND 
                                        id_lokasi in (2,3)
                                    ");
        return $data;
    }


    public function init_lokasi_rapat($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_lokasi,
                                        a.lantai
                                    from 
                                        lokasi a
                                    WHERE
                                        a.id_lokasi <> '$id'
                                    ");
        return $data;
    }

    public function init_lokasi_belajar($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_lokasi,
                                        a.lantai
                                    from 
                                        lokasi a
                                    WHERE
                                        a.id_lokasi <> '$id'
                                    AND id_lokasi in (4)
                                    ");
        return $data;
    }


    public function init_status_kamar($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_status_kamar,
                                        a.nama_status,
                                        a.icon,
                                        a.label,
                                        a.label
                                    from 
                                        _status_kamar a
                                    WHERE
                                        a.id_status_kamar <> '$id'
                                    order by a.id_status_kamar asc
                                    ");
        return $data;
    }

    public function init_status_ruangan($id)
    {

        $data =$this->mydb1->query("SELECT 
                                        a.id_status_ruang_rapat,
                                        a.nama_status,
                                        a.icon,
                                        a.label,
                                        a.label
                                    from 
                                        _status_ruang_rapat a
                                    WHERE
                                        a.id_status_ruang_rapat <> '$id'
                                    order by a.id_status_ruang_rapat asc
                                    ");
        return $data;
    }

    
}