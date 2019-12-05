<?php
class Model_biodata_guru extends CI_Model
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
        $nis                            = $this->input->post('nis');

        $query = $this->mydb1->query("SELECT count(nis) as exist FROM master_siswa where nis='$nis'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function check_nik_by_change()
    {
        $id                            = $this->input->post('id');
        $nis                            = $this->input->post('nis');

        $query = $this->mydb1->query("SELECT count(nis) as exist FROM master_siswa where nis='$nis' and id<>'$id'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function createThumbnailFoto($foto) {
        $tahun = date('Y');
        $bulan = date('m');
        $config['source_image'] = './images/'.$tahun.'/'.$bulan.'/'.$foto;
        $config['new_image'] = './images/'.$tahun.'/'.$bulan.'/thumbnails/'.$foto;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 400;
        $config['height'] = 285;
        $this->load->library('image_lib', $config);
        if (!$this->image_lib->resize()) {
            echo 'create thumbnail foto gagal' . $this->image_lib->display_errors();
        }
    }
    

    //1. Proses validasi data 

    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();

        $nip                            = $this->input->post('nip');
        $gelar_depan                   = $this->input->post('gelar_depan');
        $gelar_belakang                   = $this->input->post('gelar_belakang');
        $nama_lengkap                   = $this->input->post('nama_lengkap');

        $tempat_lahir                   = $this->input->post('tempat_lahir');
        $tanggal_lahir                  = $this->input->post('tanggal_lahir');
        $alamat                 = $this->input->post('alamat');
        $tanggal_masuk                  = $this->input->post('tanggal_masuk');


        $this->session->set_flashdata('nip', $nip);
        $this->session->set_flashdata('gelar_depan', $gelar_depan);
        $this->session->set_flashdata('gelar_belakang', $gelar_belakang);
        $this->session->set_flashdata('nama_lengkap', $nama_lengkap);
        $this->session->set_flashdata('tempat_lahir', $tempat_lahir);
        $this->session->set_flashdata('tanggal_lahir', $tanggal_lahir);
        $this->session->set_flashdata('alamat_guru', $alamat_guru);
        $this->session->set_flashdata('mulai_mengajar', $mulai_mengajar);

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap ', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Guru', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id) as exist FROM master_siswa WHERE id = '$id'");
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
                                            a.nama_lengkap,
                                            a.gelar_depan,
                                            a.gelar_belakang,
                                            a.nip,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.id_agama,
                                            a.alamat,
                                            a.tanggal_masuk,
                                            a.id_jabatan,
                                            a.id_status_pegawai,
                                            a.foto,
                                            a.created_modified,
                                            a.status_guru,
                                            a.pendidikan,
                                            a.jurusan,
                                            a.tamat,
                                            a.unit_kerja,

                                            
                                            b.jenis_kelamin,

                                            c.agama as nama_agama,
                                            d.status_guru,
                                            e.nama_jabatan,
                                            f.status_pegawai

                                        from 
                                            master_guru a
                                            LEFT JOIN _gender b on (a.jenis_kelamin=b.id_gender)
                                            LEFT JOIN _agama c on (a.id_agama=c.kd_agama)
                                            LEFT JOIN status_guru d on (a.status_guru=d.id)
                                            LEFT JOIN master_jabatan_guru e on (a.id_jabatan=e.id)
                                            LEFT JOIN master_status_pegawai f on (a.id_status_pegawai=f.id)");
        return $data->num_rows();
    }

    // LIST UNTUK SEARCH

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.nisn,
                                            a.nis,
                                            a.nama_lengkap,
                                            a.alamat,
                                            a.asal_sekolah
                                        from 
                                            siswa a
                                        ");
        return $query->field_data();
    }

    // VIEW DATA

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
           $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.gelar_depan,
                                            a.gelar_belakang,
                                            a.nip,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.id_agama,
                                            a.alamat,
                                            a.tanggal_masuk,
                                            a.id_jabatan,
                                            a.id_status_pegawai,
                                            a.foto,
                                            a.created_modified,
                                            a.status_guru,
                                            a.pendidikan,
                                            a.jurusan,
                                            a.tamat,
                                            a.unit_kerja,

                                            
                                            b.jenis_kelamin,

                                            c.agama as nama_agama,
                                            d.status_guru,
                                            e.nama_jabatan,
                                            f.status_pegawai

                                        from 
                                            master_guru a
                                            LEFT JOIN _gender b on (a.jenis_kelamin=b.id_gender)
                                            LEFT JOIN _agama c on (a.id_agama=c.kd_agama)
                                            LEFT JOIN status_guru d on (a.status_guru=d.id)
                                            LEFT JOIN master_jabatan_guru e on (a.id_jabatan=e.id)
                                            LEFT JOIN master_status_pegawai f on (a.id_status_pegawai=f.id)

                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        order by a.nip desc");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.gelar_depan,
                                            a.gelar_belakang,
                                            a.nip,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.id_agama,
                                            a.alamat,
                                            a.tanggal_masuk,
                                            a.id_jabatan,
                                            a.id_status_pegawai,
                                            a.foto,
                                            a.created_modified,
                                            a.status_guru,
                                            a.pendidikan,
                                            a.jurusan,
                                            a.tamat,
                                            a.unit_kerja,

                                            
                                            b.jenis_kelamin,

                                            c.agama as nama_agama,
                                            d.status_guru,
                                            e.nama_jabatan,
                                            f.status_pegawai

                                        from 
                                            master_guru a
                                            LEFT JOIN _gender b on (a.jenis_kelamin=b.id_gender)
                                            LEFT JOIN _agama c on (a.id_agama=c.kd_agama)
                                            LEFT JOIN status_guru d on (a.status_guru=d.id)
                                            LEFT JOIN master_jabatan_guru e on (a.id_jabatan=e.id)
                                            LEFT JOIN master_status_pegawai f on (a.id_status_pegawai=f.id)
                                        
                                        order by a.nip desc
                                            limit ".$offset.",".$perpage);
        return $data;
    } 	

    // MENGAMBIL DATA

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.gelar_depan,
                                            a.gelar_belakang,
                                            a.nip,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.id_agama,
                                            a.alamat,
                                            a.tanggal_masuk,
                                            a.id_jabatan,
                                            a.id_status_pegawai,
                                            a.foto,
                                            a.created_modified,
                                            a.status_guru,
                                            a.pendidikan,
                                            a.jurusan,
                                            a.tamat,
                                            a.unit_kerja,

                                            
                                            b.jenis_kelamin,

                                            c.agama as nama_agama,
                                            d.status_guru,
                                            e.nama_jabatan,
                                            f.status_pegawai

                                        from 
                                            master_guru a
                                            LEFT JOIN _gender b on (a.jenis_kelamin=b.id_gender)
                                            LEFT JOIN _agama c on (a.id_agama=c.kd_agama)
                                            LEFT JOIN status_guru d on (a.status_guru=d.id)
                                            LEFT JOIN master_jabatan_guru e on (a.id_jabatan=e.id)
                                            LEFT JOIN master_status_pegawai f on (a.id_status_pegawai=f.id)

                                        WHERE 
                                            a.id='$id'");
        return $data;
    }

    public function init_update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $id_user        = $this->model_hook->init_online_exist();

        $id          = $this->input->post('id');
        $nis                            = $this->input->post('nis');
        $nisn                           = $this->input->post('nisn');
        $nama_lengkap                   = $this->input->post('nama_lengkap');
        $tempat_lahir                   = $this->input->post('tempat_lahir');
        $tanggal_lahir                  = $this->input->post('tanggal_lahir');
        $anak_ke                        = $this->input->post('anak_ke');
        $alamat_peserta_didik           = $this->input->post('alamat_peserta_didik');
        $telp_rumah                     = $this->input->post('telp_rumah');
        $sekolah_asal                   = $this->input->post('sekolah_asal');
        $tanggal_diterima               = $this->input->post('tanggal_diterima');
        
        

        $gender                         = $this->input->post('gender');
        $agama                          = $this->input->post('agama');
        $status_anak                    = $this->input->post('status_anak');
        $di_kelas                       = $this->input->post('di_kelas');
        $id_status_peserta_didik        = $this->input->post('id_status_peserta_didik');

        $file_name        = $_FILES['img']['name'];

        $url            = site_url('biodata-siswa/edit/'.$id);
        $directory      = $this->model_hook->objek('master_siswa','id','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('master_siswa','id','foto',$id);
        
        $ct_exist       = $ct;

            

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => 'jpg|jpeg|JPG|JPEG|PNG|png|gif|ico',
                       'upload_path' => realpath('./images/'.date('Y').'/'.date('m').'/'),
                       'max_size' => 99900000,
                    );
            $this->load->library('upload');
            $this->upload->initialize($config); 
            $this->upload->do_upload();

            if($this->upload->do_upload('img'))
            {
                $data  = $this->upload->data();
                $foto  = $data['file_name'];

                $this->mydb1->set('nama_lengkap',$nama_lengkap);
                $this->mydb1->set('nis',$nis);
                $this->mydb1->set('nisn',$nisn);
                $this->mydb1->set('tempat_lahir',$tempat_lahir);
                $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
                $this->mydb1->set('jenis_kelamin',$gender);
                $this->mydb1->set('agama',$agama);
                $this->mydb1->set('status_dalam_keluarga',$status_anak);
                $this->mydb1->set('anak_ke',$anak_ke);
                $this->mydb1->set('alamat',$alamat_peserta_didik);
                $this->mydb1->set('no_telepon',$telp_rumah);
                $this->mydb1->set('asal_sekolah',$sekolah_asal);
                $this->mydb1->set('kelas_diterima',$di_kelas);
                $this->mydb1->set('tanggal_diterima',$tanggal_diterima);
                $this->mydb1->set('foto',$foto);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->set('id_status_peserta_didik',$id_status_peserta_didik);
                $this->mydb1->where('id',$id);
                $this->mydb1->update('master_siswa');
                
                $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
                $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('biodata-siswa/edit/'.$id);
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('nama_lengkap',$nama_lengkap);
            $this->mydb1->set('nis',$nis);
            $this->mydb1->set('nisn',$nisn);
            $this->mydb1->set('tempat_lahir',$tempat_lahir);
            $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
            $this->mydb1->set('jenis_kelamin',$gender);
            $this->mydb1->set('agama',$agama);
            $this->mydb1->set('status_dalam_keluarga',$status_anak);
            $this->mydb1->set('anak_ke',$anak_ke);
            $this->mydb1->set('alamat',$alamat_peserta_didik);
            $this->mydb1->set('no_telepon',$telp_rumah);
            $this->mydb1->set('asal_sekolah',$sekolah_asal);
            $this->mydb1->set('kelas_diterima',$di_kelas);
            $this->mydb1->set('tanggal_diterima',$tanggal_diterima);
            $this->mydb1->set('created_date',$created_date);
            $this->mydb1->set('created_modified',$created_date);
            $this->mydb1->set('id_status_peserta_didik',$id_status_peserta_didik);
            $this->mydb1->where('id',$id);
            $this->mydb1->update('master_siswa');
        }

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

//1. Proses penambahan data ke database

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $max=$this->model_combo_r->id_max('id','master_guru');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $gelar_depan                   = $this->input->post('gelar_depan');
        $gelar_belakang                   = $this->input->post('gelar_belakang');
        $nama_lengkap                   = $this->input->post('nama_lengkap');
        $nip                            = $this->input->post('nip');

        $tempat_lahir                   = $this->input->post('tempat_lahir');
        $tanggal_lahir                  = $this->input->post('tanggal_lahir');
       
        $jenis_kelamin                         = $this->input->post('jenis_kelamin');
        $id_agama                          = $this->input->post('id_agama');


        $alamat                  = $this->input->post('alamat');

        $tanggal_masuk                  = $this->input->post('tanggal_masuk');
        
        

        $id_jabatan                          = $this->input->post('id_jabatan');
        $id_status_pegawai                          = $this->input->post('id_status_pegawai');

        $status_guru                          = $this->input->post('status_guru');

        $pendidikan                          = $this->input->post('pendidikan');
        $jurusan                          = $this->input->post('jurusan');
        $tamat                          = $this->input->post('tamat');
        $unit_kerja                          = $this->input->post('unit_kerja');

        $file_name        = $_FILES['img']['name'];
        //$format         = $this->format_upload();

        $url            = site_url('biodata-guru/edit/'.$id);

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => 'jpg|jpeg|JPG|JPEG|PNG|png|gif|ico',
                       'upload_path' => realpath('./images/'.date('Y').'/'.date('m').'/'),
                       'max_size' => 99900000,
                    );
            $this->load->library('upload');
            $this->upload->initialize($config); 
            $this->upload->do_upload();

            if($this->upload->do_upload('img'))
            {
                $data  = $this->upload->data();
                $foto  = $data['file_name'];

                $this->mydb1->set('id',$id);
                $this->mydb1->set('nama_lengkap',$nama_lengkap);
                $this->mydb1->set('gelar_depan',$gelar_depan);
                $this->mydb1->set('gelar_belakang',$gelar_belakang);
                $this->mydb1->set('nip',$nip);
                $this->mydb1->set('tempat_lahir',$tempat_lahir);
                $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
                $this->mydb1->set('jenis_kelamin',$jenis_kelamin);
                $this->mydb1->set('id_agama',$id_agama);
                $this->mydb1->set('alamat',$alamat);
                $this->mydb1->set('tanggal_masuk',$tanggal_masuk);
                $this->mydb1->set('id_jabatan',$id_jabatan);
                $this->mydb1->set('id_status_pegawai',$id_status_pegawai);
                $this->mydb1->set('foto',$foto);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->set('status_guru',$status_guru);
                $this->mydb1->set('pendidikan',$pendidikan);
                $this->mydb1->set('jurusan',$jurusan);
                $this->mydb1->set('tamat',$tamat);
                $this->mydb1->set('unit_kerja',$unit_kerja);

                $this->mydb1->insert('master_guru');

                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('biodata-guru/add');
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('id',$id);
                $this->mydb1->set('nama_lengkap',$nama_lengkap);
                $this->mydb1->set('gelar_depan',$gelar_depan);
                $this->mydb1->set('gelar_belakang',$gelar_belakang);
                $this->mydb1->set('nip',$nip);
                $this->mydb1->set('tempat_lahir',$tempat_lahir);
                $this->mydb1->set('tanggal_lahir',$tanggal_lahir);
                $this->mydb1->set('jenis_kelamin',$gender);
                $this->mydb1->set('id_agama',$agama);
                $this->mydb1->set('alamat',$alamat);
                $this->mydb1->set('tanggal_masuk',$tanggal_masuk);
                $this->mydb1->set('id_jabatan',$id_jabatan_guru);
                $this->mydb1->set('id_jabatan',$id_jabatan_guru);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->set('status_guru',$id_status_guru);
                $this->mydb1->insert('master_guru');
        }

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
                $this->model_message->messege_proses('Data Berhasil disimpan.','delete',$url,'fa-check-square-o','success');
                return TRUE;
            }
    }

    public function init_delete()
    {
        $url='';
        $id = $this->format_data->string($this->uri->segment(3,0));

        $directory      = $this->model_hook->objek('content','id_content','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('content','id_content','gambar',$id);
        $ct_exist       = $ct;

        $this->mydb1->trans_start();
        $this->mydb1->where('id_content',$id);
        $this->mydb1->delete('content');
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
            $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
            $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
            $this->model_message->messege_proses('Berhasil menghapus content.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_delete_gambar()
    {
        $url='';
        $id = $this->format_data->string($this->uri->segment(3,0));

        $directory      = $this->model_hook->objek('master_siswa','id','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('master_siswa','id','foto',$id);
        
        $ct_exist = $ct;
        
        $this->mydb1->trans_start();
        $this->mydb1->set('foto','');
        $this->mydb1->where('id',$id);
        $this->mydb1->update('master_siswa');
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
            $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
            $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
            $this->model_message->messege_proses('Berhasil menghapus Foto.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }


    
}