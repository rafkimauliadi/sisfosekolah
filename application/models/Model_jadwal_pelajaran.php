<?php
class Model_jadwal_pelajaran extends CI_Model
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

        $hari          = $this->input->post('hari');
        $id_jam          = $this->input->post('id_jam');
        $id_kelas          = $this->input->post('id_kelas');
        $id_mapel_kelas          = $this->input->post('id_mapel_kelas');
        $tanda_guru          = $this->input->post('tanda_guru');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('hari', 'hari', 'required');
            $this->form_validation->set_rules('id_jam', 'id_jam', 'required');
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mapel_kelas', 'id_mapel_kelas', 'required');
            $this->form_validation->set_rules('tanda_guru', 'tanda_guru', 'required');
        }
        else
        {
            $this->form_validation->set_rules('hari', 'hari', 'required');
            $this->form_validation->set_rules('id_jam', 'id_jam', 'required');
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mapel_kelas', 'id_mapel_kelas', 'required');
            $this->form_validation->set_rules('tanda_guru', 'tanda_guru', 'required');
        }

        $this->session->set_flashdata('hari', $hari);
        $this->session->set_flashdata('id_jam', $id_jam);
        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('id_mapel_kelas', $id_mapel_kelas);
        $this->session->set_flashdata('tanda_guru', $id_mapel_kelas);

    }


    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.nama_kelas
                                            from 
                                            master_kelas a
                                        ");
        return $query->field_data();
    }

    public function get_view($offset,$perpage)
    {
        // $change_box = $this->input->post('change_box',TRUE);
        // $search_box = $this->input->post('search_box',TRUE);
        // $this->session->set_flashdata('search_box', $search_box);
        
        // if($search_box != NULL)
    	//    $data =$this->mydb1->query("SELECT 
        //                                 jadwal_pelajaran.id as id,hari,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id and master_mapel_kelas.id_guru=master_guru.id       
        //                                and (master_kelas.".$change_box." like '%$search_box%')
        //                                 order by jadwal_pelajaran.id desc
        //                                 ");
        // else
        //     $data =$this->mydb1->query("SELECT 
        //                                 jadwal_pelajaran.id as id,hari,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id 
        //                                 and master_mapel_kelas.id_guru=master_guru.id       
        //                                 order by jadwal_pelajaran.id desc
        //                                     limit ".$offset.",".$perpage);
        // return $data;
      
        $id_kelas = $this->input->post('id_kelas',TRUE);

     

        if($id_kelas != NULL)
        $data =$this->mydb1->query("SELECT 
        jadwal_pelajaran.id as id,hari,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id 
        and master_mapel_kelas.id_guru=master_guru.id and master_kelas.id_kelas='{$id_kelas}'       
        order by jadwal_pelajaran.id desc");
        else
            $data =$this->mydb1->query("SELECT 
                                        jadwal_pelajaran.id as id,hari,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id 
                                        and master_mapel_kelas.id_guru=master_guru.id       
                                        order by jadwal_pelajaran.id desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	




    public function get_data_jadwal_pelajaran()
    {
        $sql = "
        SELECT jadwal_pelajaran.id as id,hari,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id and master_mapel_kelas.id_guru=master_guru.id       
         ";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $hari          = $this->input->post('hari',TRUE);
        $id_jam          = $this->input->post('id_jam',TRUE);
        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_mapel_kelas          = $this->input->post('id_mapel_kelas',TRUE);
        $tanda_guru          = $this->input->post('tanda_guru',TRUE);

        $url            = site_url('master-jadwal-pelajaran/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('hari',$hari);
        $this->mydb1->set('id_jam',$id_jam);
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mapel_kelas',$id_mapel_kelas);
        $this->mydb1->set('tanda_guru',$tanda_guru);
        $this->mydb1->insert('jadwal_pelajaran');

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
        $this->mydb1->delete('jadwal_pelajaran');

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
        $query = $this->mydb1->query("SELECT count(id) as exist FROM jadwal_pelajaran WHERE id = '$id'");
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
        $data =$this->mydb1->query("        SELECT jadwal_pelajaran.id as id,hari,master_kelas.id_kelas,id_jam,jam,waktu_mulai,waktu_akhir,nama_kelas,nama_jurusan,id_mapel_kelas,nama_mapel, tanda_guru,nama_lengkap,gelar_depan, gelar_belakang from jadwal_pelajaran,master_jam,master_kelas,master_mata_pelajaran,master_mapel_kelas,master_jurusan,master_guru WHERE jadwal_pelajaran.id_jam=master_jam.id and jadwal_pelajaran.id_kelas=master_kelas.id_kelas and jadwal_pelajaran.id_mapel_kelas=master_mapel_kelas.id and master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_kelas.id_jurusan=master_jurusan.id and master_mapel_kelas.id_guru=master_guru.id       
         and jadwal_pelajaran.id='$id'");
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
        $hari          = $this->input->post('hari',TRUE);
        $id_jam          = $this->input->post('id_jam',TRUE);
        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_mapel_kelas          = $this->input->post('id_mapel_kelas',TRUE);
        $tanda_guru          = $this->input->post('tanda_guru',TRUE);

        $url            = site_url('master-jadwal-pelajaran/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('hari',$hari);
        $this->mydb1->set('id_jam',$id_jam);
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mapel_kelas',$id_mapel_kelas);
        $this->mydb1->set('tanda_guru',$tanda_guru);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('jadwal_pelajaran');

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

    function init_jam($id)
    {
        $sql = "select id, waktu_mulai, waktu_akhir from master_jam where id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_kelas($id)
    {
        $sql = "select master_kelas.id_kelas, master_kelas.nama_kelas, master_jurusan.nama_jurusan from master_kelas, master_jurusan where master_kelas.id_jurusan=master_jurusan.id and master_kelas.id_kelas !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }

    function init_mapel($id)
    {
        $sql = "select master_mapel_kelas.id, master_mata_pelajaran.nama_mapel 
        from master_mapel_kelas, master_mata_pelajaran 
        where master_mapel_kelas.id_mata_pelajaran=master_mata_pelajaran.id_mata_pelajaran and master_mapel_kelas.id !=?";
        $queryRec = $this->db->query($sql, array($id));
        return $queryRec;
    }
    // function init_mapel($id)
    // {
    //     $sql = "select id_mata_pelajaran, nama_mapel from master_mata_pelajaran
    //      where id_mata_pelajaran !=?";
    //     $queryRec = $this->db->query($sql, array($id));
    //     return $queryRec;
    // }
}