<?php
class Model_nilai_siswa extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }

    public function cek_exist()
    {
        $id                            = $this->input->post('id');

        $query = $this->mydb1->query("SELECT count(id) as exist FROM bahan_ajar where id='$id'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function check_nik_by_change()
    {
        $id                            = $this->input->post('id');
        $id_guru                            = $this->input->post('id_guru');

        $query = $this->mydb1->query("SELECT count(id) as exist FROM bahan_ajar where id_guru='$id_guru' and id<>'$id'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    //1. Proses validasi data 

    public function validation_field($action)
    {
        $this->model_message->conv_validasi_to_indonesia();

        $id_kelas                   = $this->input->post('id_kelas');
        $id_mapel                   = $this->input->post('id_mapel');
        $id_guru                            = $this->input->post('id_guru');
        $nilai_siswa                   = $this->input->post('nilai_siswa');
        $id_siswa_kelas                   = $this->input->post('id_siswa_kelas');
        $id_tahun_ajaran                   = $this->input->post('id_tahun_ajaran');

        if ($action=='simpan')
        {   $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mapel', 'id_mapel', 'required');
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
         
            $this->form_validation->set_rules('nilai_siswa', 'nilai_siswa', 'required');
            $this->form_validation->set_rules('id_siswa_kelas', 'id_siswa_kelas', 'required');
            $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'required');
      }
        else
        {
            $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
            $this->form_validation->set_rules('id_mapel', 'id_mapel', 'required');
            $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
            $this->form_validation->set_rules('nilai_siswa', 'nilai_siswa', 'required');
            $this->form_validation->set_rules('id_siswa_kelas', 'id_siswa_kelas', 'required');
            $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'required');
      }


      $this->session->set_flashdata('id_kelas', $id_kelas);
      $this->session->set_flashdata('id_mapel', $id_mapel);
      $this->session->set_flashdata('id_guru', $id_guru);

      $this->session->set_flashdata('nilai_siswa', $nilai_siswa);
      $this->session->set_flashdata('id_siswa_kelas', $id_siswa_kelas);
      $this->session->set_flashdata('id_tahun_ajaran', $id_tahun_ajaran);

    
    }
    // public function validation_field()
    // {
    //     $this->model_message->conv_validasi_to_indonesia();

    //     $id_guru                            = $this->input->post('id_guru');
    //     $id_kelas                   = $this->input->post('id_kelas');
    //     $id_mapel                   = $this->input->post('id_mapel');
    //     $nilai_siswa                   = $this->input->post('nilai_siswa');
    //     $id_siswa_kelas                   = $this->input->post('id_siswa_kelas');
    //     $id_tahun_ajaran                   = $this->input->post('id_tahun_ajaran');


    //     $this->session->set_flashdata('id_guru', $id_guru);
    //     $this->session->set_flashdata('id_kelas', $id_kelas);
    //     $this->session->set_flashdata('id_mapel', $id_mapel);
    //     $this->session->set_flashdata('nilai_siswa', $nilai_siswa);
    //     $this->session->set_flashdata('id_siswa_kelas', $id_siswa_kelas);
    //     $this->session->set_flashdata('id_tahun_ajaran', $id_tahun_ajaran);

    //     $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
    //     $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
    //     $this->form_validation->set_rules('id_mapel', 'id_mapel', 'required');
    //     $this->form_validation->set_rules('nilai_siswa', 'nilai_siswa', 'required');
    //     $this->form_validation->set_rules('id_siswa_kelas', 'id_siswa_kelas', 'required');
    //     $this->form_validation->set_rules('id_tahun_ajaran', 'id_tahun_ajaran', 'required');

    //     }
public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_nilai WHERE id = '$id'");
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

    // NUMROWS UNTUK PAGINATION

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_kelas,
                                            a.id_mapel,
                                            a.id_guru,
                                            a.nilai_siswa,
                                            a.id_siswa_kelas,
                                            a.id_tahun_ajaran,

                                            
                                            b.nama_kelas,

                                            c.nama_mapel ,
                                            d.nip                                          
                                        from 
                                            master_nilai a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)");
        return $data->num_rows();
    }

    // LIST UNTUK SEARCH

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                           
                                           b.nama_kelas
                                        from 
                                            master_nilai a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                        
                                           
                                        ");
        return $query->field_data();
    }
    public function search2()
    {
        $query =    $this->mydb1->query("SELECT 
                                           
                                           c.nama_mapel
                                        from 
                                            master_nilai a
                                            LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
                                        
                                           
                                        ");
        return $query->field_data();
    }
    // VIEW DATA

    public function get_view($offset,$perpage)
    {
//         $change_box = $this->input->post('change_box',TRUE);
//         $search_box = $this->input->post('search_box',TRUE);
//         $this->session->set_flashdata('search_box', $search_box);
        
//         if($search_box != NULL)
//            $data =$this->mydb1->query("SELECT 
//                                                                                     a.id,
//                                             a.id_kelas,
//                                             a.id_mapel,
//                                             a.id_guru,
//                                             a.nilai_siswa,
//                                             a.id_siswa_kelas,
//                                             a.id_tahun_ajaran,                                            
//                                             b.nama_kelas,
//                                             c.nama_mapel,
//                                             d.nip,d.nama_lengkap,
// 					    f.nama_lengkap as nama_siswa,
// g.tahun                                          
//                                         from 
//                                             master_nilai a
//                                             LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
//                                             LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
//                                             LEFT JOIN master_guru d on (a.id_guru=d.id)
// LEFT JOIN master_siswa_kelas e on (a.id_siswa_kelas=e.id)
// LEFT JOIN master_siswa f on (e.id_siswa=f.id)
// LEFT JOIN tahun_ajaran g on (a.id_tahun_ajaran=g.id)
// where
//                                             (b.".$change_box." like '%$search_box%')
//                                         order by a.id desc");
//         else
//             $data =$this->mydb1->query("SELECT 
//             a.id,
//             a.id_kelas,
//             a.id_mapel,
//             a.id_guru,
//             a.nilai_siswa,
//             a.id_siswa_kelas,
//             a.id_tahun_ajaran,                                            
//             b.nama_kelas,
//             c.nama_mapel,
//             d.nip,d.nama_lengkap,
//             f.nama_lengkap as nama_siswa,
//             f.nis,
//             g.tahun,
//             h.nama_jurusan                                          
//         from 
//             master_nilai a
//             LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
//             LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
//             LEFT JOIN master_guru d on (a.id_guru=d.id)
//             LEFT JOIN master_siswa_kelas e on (a.id_siswa_kelas=e.id)
//             LEFT JOIN master_siswa f on (e.id_siswa=f.id)
//             LEFT JOIN tahun_ajaran g on (a.id_tahun_ajaran=g.id)
//             LEFT JOIN master_jurusan h on (b.id_jurusan=h.id)
//                                           order by a.id_kelas desc
//                                             limit ".$offset.",".$perpage);
//         return $data;

$id_kelas = $this->input->post('id_kelas',TRUE);
if($id_kelas != NULL)
            $data =$this->mydb1->query("SELECT 
            a.id,
            a.id_kelas,
            a.id_mapel,
            a.id_guru,
            a.nilai_siswa,
            a.id_siswa_kelas,
            a.id_tahun_ajaran,                                            
            b.nama_kelas,
            c.nama_mapel,
            d.nip,d.nama_lengkap,
            f.nama_lengkap as nama_siswa,
            f.nis,
            g.tahun,
            h.nama_jurusan                                          
        from 
            master_nilai a
            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
            LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
            LEFT JOIN master_guru d on (a.id_guru=d.id)
            LEFT JOIN master_siswa_kelas e on (a.id_siswa_kelas=e.id)
            LEFT JOIN master_siswa f on (e.id_siswa=f.id)
            LEFT JOIN tahun_ajaran g on (a.id_tahun_ajaran=g.id)
            LEFT JOIN master_jurusan h on (b.id_jurusan=h.id)
where b.id_kelas='{$id_kelas}'
                                    
                                 order by a.id desc");
else
                $data =$this->mydb1->query("SELECT 
            a.id,
            a.id_kelas,
            a.id_mapel,
            a.id_guru,
            a.nilai_siswa,
            a.id_siswa_kelas,
            a.id_tahun_ajaran,                                            
            b.nama_kelas,
            c.nama_mapel,
            d.nip,d.nama_lengkap,
            f.nama_lengkap as nama_siswa,
            f.nis,
            g.tahun,
            h.nama_jurusan                                          
        from 
            master_nilai a
            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
            LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
            LEFT JOIN master_guru d on (a.id_guru=d.id)
            LEFT JOIN master_siswa_kelas e on (a.id_siswa_kelas=e.id)
            LEFT JOIN master_siswa f on (e.id_siswa=f.id)
            LEFT JOIN tahun_ajaran g on (a.id_tahun_ajaran=g.id)
            LEFT JOIN master_jurusan h on (b.id_jurusan=h.id)
                                          order by a.id_kelas desc
                                            limit ".$offset.",".$perpage);

return $data;

    } 	

    // MENGAMBIL DATA

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
    a.id,
            a.id_kelas,
            a.id_mapel,
            a.id_guru,
            a.nilai_siswa,
            a.id_siswa_kelas,
            a.id_tahun_ajaran,                                            
            b.nama_kelas,
            c.nama_mapel,
            d.nip,d.nama_lengkap,
            f.nama_lengkap as nama_siswa,
            f.nis,
            g.tahun,
            h.nama_jurusan as nama_jurusan                                          
        from 
            master_nilai a
            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
            LEFT JOIN master_mata_pelajaran c on (a.id_mapel=c.id_mata_pelajaran)
            LEFT JOIN master_guru d on (a.id_guru=d.id)
            LEFT JOIN master_siswa_kelas e on (a.id_siswa_kelas=e.id)
            LEFT JOIN master_siswa f on (e.id_siswa=f.id)
            LEFT JOIN tahun_ajaran g on (a.id_tahun_ajaran=g.id)
            LEFT JOIN master_jurusan h on (b.id_jurusan=h.id)
            
            where
                                            a.id='$id'");
        return $data;
    }


    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $id_kelas          = $this->input->post('id_kelas',TRUE);
        $id_mapel          = $this->input->post('id_mapel',TRUE);
        $id_guru          = $this->input->post('id_guru',TRUE);
        $nilai_siswa          = $this->input->post('nilai_siswa',TRUE);
        $id_siswa_kelas          = $this->input->post('id_siswa_kelas',TRUE);
        $id_tahun_ajaran          = $this->input->post('id_tahun_ajaran',TRUE);

        $url            = site_url('nilai-siswa/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mapel',$id_mapel);
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('nilai_siswa',$nilai_siswa);
        $this->mydb1->set('id_siswa_kelas',$id_siswa_kelas);
        $this->mydb1->set('id_tahun_ajaran',$id_tahun_ajaran);
        $this->mydb1->insert('master_nilai');

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
        $this->mydb1->delete('master_nilai');

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
        $id_kelas                   = $this->input->post('id_kelas');
        $id_mapel                   = $this->input->post('id_mapel');
        $id_guru                            = $this->input->post('id_guru');
        $nilai_siswa                   = $this->input->post('nilai_siswa');
        $id_siswa_kelas                   = $this->input->post('id_siswa_kelas');
        $id_tahun_ajaran                   = $this->input->post('id_tahun_ajaran');

        $url            = site_url('nilai-siswa/edit/'.$id);

        date_default_timezone_set('Asia/Jakarta');
        $created_time       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $this->mydb1->trans_start();
        $this->mydb1->set('id_kelas',$id_kelas);
        $this->mydb1->set('id_mapel',$id_mapel);
        $this->mydb1->set('id_guru',$id_guru);
        $this->mydb1->set('nilai_siswa',$nilai_siswa);
        $this->mydb1->set('id_siswa_kelas',$id_siswa_kelas);
        $this->mydb1->set('id_tahun_ajaran',$id_tahun_ajaran);
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_nilai');
        
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

    
}