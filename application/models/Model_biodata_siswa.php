<?php
class Model_biodata_siswa extends CI_Model
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
    
    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();

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
        $di_kelas                       = $this->input->post('di_kelas');
        $nama_ayah                      = $this->input->post('nama_ayah');
        $nama_ibu                       = $this->input->post('nama_ibu');
        $alamat_orang_tua               = $this->input->post('alamat_orang_tua');
        $telp_orang_tua                 = $this->input->post('telp_orang_tua');
        $pekerjaan_ayah                 = $this->input->post('pekerjaan_ayah');
        $pekerjaan_ibu                  = $this->input->post('pekerjaan_ibu');
        $nama_wali                      = $this->input->post('nama_wali');
        $telp_wali                      = $this->input->post('telp_wali');
        $alamat_wali                    = $this->input->post('alamat_wali');
        $pekerjaan_wali                 = $this->input->post('pekerjaan_wali');

        $this->session->set_flashdata('nis', $nis);
        $this->session->set_flashdata('nisn', $nisn);
        $this->session->set_flashdata('nama_lengkap', $nama_lengkap);
        $this->session->set_flashdata('tempat_lahir', $tempat_lahir);
        $this->session->set_flashdata('tanggal_lahir', $tanggal_lahir);
        $this->session->set_flashdata('anak_ke', $anak_ke);
        $this->session->set_flashdata('alamat_peserta_didik', $alamat_peserta_didik);
        $this->session->set_flashdata('telp_rumah', $telp_rumah);
        $this->session->set_flashdata('sekolah_asal', $sekolah_asal);
        $this->session->set_flashdata('tanggal_diterima', $tanggal_diterima);
        $this->session->set_flashdata('di_kelas', $di_kelas);
        $this->session->set_flashdata('nama_ayah', $nama_ayah);
        $this->session->set_flashdata('nama_ibu', $nama_ibu);
        $this->session->set_flashdata('alamat_orang_tua', $alamat_orang_tua);
        $this->session->set_flashdata('telp_orang_tua', $telp_orang_tua);
        $this->session->set_flashdata('pekerjaan_ayah', $pekerjaan_ayah);
        $this->session->set_flashdata('pekerjaan_ibu', $pekerjaan_ibu);
        $this->session->set_flashdata('nama_wali', $nama_wali);
        $this->session->set_flashdata('telp_wali', $telp_wali);
        $this->session->set_flashdata('alamat_wali', $alamat_wali);
        $this->session->set_flashdata('pekerjaan_wali', $pekerjaan_wali);

        $this->form_validation->set_rules('nis', 'Nomor Induk Siswa', 'required');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap Peserta Didik', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat_peserta_didik', 'Alamat Peserta Didik', 'required');
        $this->form_validation->set_rules('sekolah_asal', 'Sekolah Asal Peserta Didik', 'required');
        $this->form_validation->set_rules('di_kelas', 'Dikelas Diterima', 'required');
        $this->form_validation->set_rules('tanggal_diterima', 'Tanggal Diterima', 'required');
        $this->form_validation->set_rules('di_kelas', 'Kelas Awal', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
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

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.nis,
                                            a.nisn,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.agama,
                                            a.status_dalam_keluarga,
                                            a.alamat,
                                            a.no_telepon,
                                            a.asal_sekolah,
                                            a.tanggal_diterima,

                                            b.nama_ayah,
                                            b.nama_ibu,

                                            c.nama_wali,

                                            d.jenis_kelamin,

                                            e.agama as nama_agama,

                                            c.nama_wali,

                                            f.nama_ayah, 
                                            f.nama_ibu,
                                            f.alamat as alamat_orang_tua


                                        from 
                                            master_siswa a
                                            LEFT JOIN master_orangtua b on (a.id=b.id_siswa)
                                            LEFT JOIN master_wali c on (a.id=c.id_siswa)
                                            LEFT JOIN _gender d on (a.jenis_kelamin=d.id_gender)
                                            LEFT JOIN _agama e on (a.agama=e.kd_agama)
                                            LEFT JOIN master_orangtua f on (a.id=f.id_siswa)");
        return $data->num_rows();
    }

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

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.nis,
                                            a.nisn,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.agama,
                                            a.status_dalam_keluarga,
                                            a.alamat,
                                            a.no_telepon,
                                            a.asal_sekolah,
                                            a.tanggal_diterima,

                                            a.foto,
                                            a.created_modified,

                                            b.nama_ayah,
                                            b.nama_ibu,

                                            c.nama_wali,

                                            d.jenis_kelamin,

                                            e.agama as nama_agama,

                                            c.nama_wali,

                                            f.nama_ayah, 
                                            f.nama_ibu,
                                            f.alamat as alamat_orang_tua,

                                            g.id_status,
                                            g.nm_status as status_peserta_didik


                                        from 
                                            master_siswa a
                                            LEFT JOIN master_orangtua b on (a.id=b.id_siswa)
                                            LEFT JOIN master_wali c on (a.id=c.id_siswa)
                                            LEFT JOIN _gender d on (a.jenis_kelamin=d.id_gender)
                                            LEFT JOIN _agama e on (a.agama=e.kd_agama)
                                            LEFT JOIN master_orangtua f on (a.id=f.id_siswa)
                                            LEFT JOIN _status_peserta_didik g on (a.id_status_peserta_didik=g.id_status)
                                        
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        order by a.nisn desc
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.nis,
                                            a.nisn,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.agama,
                                            a.status_dalam_keluarga,
                                            a.alamat,
                                            a.no_telepon,
                                            a.asal_sekolah,
                                            a.tanggal_diterima,
                                            a.foto,
                                            a.created_modified,

                                            b.nama_ayah,
                                            b.nama_ibu,

                                            c.nama_wali,

                                            d.jenis_kelamin,

                                            e.agama as nama_agama,

                                            c.nama_wali,

                                            f.nama_ayah, 
                                            f.nama_ibu,
                                            f.alamat as alamat_orang_tua,

                                            g.id_status,
                                            g.nm_status as status_peserta_didik


                                        from 
                                            master_siswa a
                                            LEFT JOIN master_orangtua b on (a.id=b.id_siswa)
                                            LEFT JOIN master_wali c on (a.id=c.id_siswa)
                                            LEFT JOIN _gender d on (a.jenis_kelamin=d.id_gender)
                                            LEFT JOIN _agama e on (a.agama=e.kd_agama)
                                            LEFT JOIN master_orangtua f on (a.id=f.id_siswa)
                                            LEFT JOIN _status_peserta_didik g on (a.id_status_peserta_didik=g.id_status)
                                        
                                        order by a.nisn desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.nama_lengkap,
                                            a.nis,
                                            a.nisn,
                                            a.tempat_lahir,
                                            a.tanggal_lahir,
                                            a.jenis_kelamin,
                                            a.agama,
                                            a.status_dalam_keluarga,
                                            a.alamat,
                                            a.no_telepon,
                                            a.asal_sekolah,
                                            a.kelas_diterima,
                                            a.tanggal_diterima,
                                            a.anak_ke,
                                            a.foto,
                                            a.created_modified,
                                            a.id_status_peserta_didik,

                                            b.nama_ayah,
                                            b.nama_ibu,
                                            b.alamat as alamat_orang_tua,
                                            b.no_telepon as telp_orang_tua,
                                            b.pekerjaan_ayah,
                                            b.pekerjaan_ibu,

                                            c.nama_wali,

                                            d.jenis_kelamin as nm_jenis_kelamin,

                                            e.agama as nama_agama,

                                            c.nama_wali,
                                            c.no_telepon as telp_wali,
                                            c.alamat as alamat_wali,
                                            c.pekerjaan as pekerjaan_wali,


                                            g.id_status,
                                            g.nm_status as status_peserta_didik,

                                            h.status_anak


                                        from 
                                            master_siswa a
                                            LEFT JOIN master_orangtua b on (a.id=b.id_siswa)
                                            LEFT JOIN master_wali c on (a.id=c.id_siswa)
                                            LEFT JOIN _gender d on (a.jenis_kelamin=d.id_gender)
                                            LEFT JOIN _agama e on (a.agama=e.kd_agama)
                                            LEFT JOIN _status_peserta_didik g on (a.id_status_peserta_didik=g.id_status)
                                            LEFT JOIN _status_anak h on (a.status_dalam_keluarga=h.id_status_anak)
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
                $this->update_orangtua($id);
                $this->update_wali($id);
                $this->model_message->messege_proses('Data Berhasil diperbarui.','delete',$url,'fa-check-square-o','success');
                return TRUE;
            }
    }

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $max=$this->model_combo_r->id_max('id','master_siswa');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

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
        //$format         = $this->format_upload();

        $url            = site_url('biodata-siswa/edit/'.$id);

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
                $this->mydb1->insert('master_siswa');

                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('biodata-siswa/add');
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('id',$id);
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
            $this->mydb1->insert('master_siswa');
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
                $this->save_orangtua($id);
                $this->save_wali($id);
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


    /////////////////////////////////////////////////////////////
    // Orang Tua
    /////////////////////////////////////////////////////////////
    public function save_orangtua($id_siswa)
    {
        $nama_ayah                      = $this->input->post('nama_ayah');
        $nama_ibu                       = $this->input->post('nama_ibu');
        $alamat_orang_tua               = $this->input->post('alamat_orang_tua');
        $telp_orang_tua                 = $this->input->post('telp_orang_tua');
        $pekerjaan_ayah                 = $this->input->post('pekerjaan_ayah');
        $pekerjaan_ibu                  = $this->input->post('pekerjaan_ibu');

            $this->mydb1->trans_start();
            $this->mydb1->set('id_siswa',$id_siswa);
            $this->mydb1->set('nama_ayah',$nama_ayah);
            $this->mydb1->set('nama_ibu',$nama_ibu);
            $this->mydb1->set('alamat',$alamat_orang_tua);
            $this->mydb1->set('no_telepon',$telp_orang_tua);
            $this->mydb1->set('pekerjaan_ayah',$pekerjaan_ayah);
            $this->mydb1->set('pekerjaan_ibu',$pekerjaan_ibu);
            $this->mydb1->insert('master_orangtua');

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
                return TRUE;
            }
    }

    public function update_orangtua($id_siswa)
    {
        $nama_ayah                      = $this->input->post('nama_ayah');
        $nama_ibu                       = $this->input->post('nama_ibu');
        $alamat_orang_tua               = $this->input->post('alamat_orang_tua');
        $telp_orang_tua                 = $this->input->post('telp_orang_tua');
        $pekerjaan_ayah                 = $this->input->post('pekerjaan_ayah');
        $pekerjaan_ibu                  = $this->input->post('pekerjaan_ibu');

            $this->mydb1->trans_start();
            $this->mydb1->set('nama_ayah',$nama_ayah);
            $this->mydb1->set('nama_ibu',$nama_ibu);
            $this->mydb1->set('alamat',$alamat_orang_tua);
            $this->mydb1->set('no_telepon',$telp_orang_tua);
            $this->mydb1->set('pekerjaan_ayah',$pekerjaan_ayah);
            $this->mydb1->set('pekerjaan_ibu',$pekerjaan_ibu);
            $this->mydb1->where('id_siswa',$id_siswa);
            $this->mydb1->update('master_orangtua');

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
                return TRUE;
            }   
    }


    public function save_wali($id_siswa)
    {
        $nama_wali                      = $this->input->post('nama_wali');
        $telp_wali                      = $this->input->post('telp_wali');
        $alamat_wali                    = $this->input->post('alamat_wali');
        $pekerjaan_wali                 = $this->input->post('pekerjaan_wali');
        $telp_wali                      = $this->input->post('telp_wali');

            $this->mydb1->trans_start();
            $this->mydb1->set('id_siswa',$id_siswa);
            $this->mydb1->set('nama_wali',$nama_wali);
            $this->mydb1->set('no_telepon',$telp_wali);
            $this->mydb1->set('alamat',$alamat_wali);
            $this->mydb1->set('pekerjaan',$pekerjaan_wali);
            $this->mydb1->insert('master_wali');

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
                return TRUE;
            }
    }

    public function update_wali($id_siswa)
    {
        $nama_wali                      = $this->input->post('nama_wali');
        $telp_wali                      = $this->input->post('telp_wali');
        $alamat_wali                    = $this->input->post('alamat_wali');
        $pekerjaan_wali                 = $this->input->post('pekerjaan_wali');
        $telp_wali                      = $this->input->post('telp_wali');

            $this->mydb1->trans_start();
            $this->mydb1->set('nama_wali',$nama_wali);
            $this->mydb1->set('no_telepon',$telp_wali);
            $this->mydb1->set('alamat',$alamat_wali);
            $this->mydb1->set('pekerjaan',$pekerjaan_wali);
            $this->mydb1->where('id_siswa',$id_siswa);
            $this->mydb1->update('master_wali');

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
                return TRUE;
            }
    }
}