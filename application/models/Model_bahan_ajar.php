<?php
class Model_bahan_ajar extends CI_Model
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

        $id_guru                            = $this->input->post('id_guru');
        $id_kelas                   = $this->input->post('id_kelas');
        $id_jurusan                   = $this->input->post('id_jurusan');


        $this->session->set_flashdata('id_guru', $id_guru);
        $this->session->set_flashdata('id_kelas', $id_kelas);
        $this->session->set_flashdata('id_jurusan', $id_jurusan);

        $this->form_validation->set_rules('id_guru', 'id_guru', 'required');
        $this->form_validation->set_rules('id_kelas', 'id_kelas', 'required');
        $this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'required');

        }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id) as exist FROM bahan_ajar WHERE id = '$id'");
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
                                            a.id_guru,
                                            a.id_kelas,
                                            a.id_jurusan,
                                            a.foto,
                                            a.created_date,

                                            
                                            b.nama_kelas,

                                            c.nama_jurusan ,
                                            d.nama_lengkap, 
                                            d.nip                                          
                                        from 
                                            bahan_ajar a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_jurusan c on (a.id_jurusan=c.id)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)");
        return $data->num_rows();
    }

    // LIST UNTUK SEARCH

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                           
                                            d.nip
                                        from 
                                            bahan_ajar a
                                            Left Join master_guru d on (a.id_guru=d.id)
                                        
                                           
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
                                            a.id_guru,
                                            a.id_kelas,
                                            a.id_jurusan,
                                            a.foto,
                                            a.created_date,
                                            a.created_modified,

                                            
                                            b.nama_kelas,

                                            c.nama_jurusan ,
                                            d.nama_lengkap, 
                                            d.nip                                          
                                        from 
                                            bahan_ajar a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_jurusan c on (a.id_jurusan=c.id)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)
                                        where 
                                            (d.".$change_box." like '%$search_box%')
                                        order by a.id desc");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_guru,
                                            a.id_kelas,
                                            a.id_jurusan,
                                            a.foto,
                                            a.created_date,
                                            a.created_modified,

                                            
                                            b.nama_kelas,

                                            c.nama_jurusan ,
                                            d.nama_lengkap, 
                                            d.nip                                          
                                        from 
                                            bahan_ajar a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_jurusan c on (a.id_jurusan=c.id)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)
                                        order by a.id_guru desc
                                            limit ".$offset.",".$perpage);
        return $data;
    } 	

    // MENGAMBIL DATA

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id,
                                            a.id_guru,
                                            a.id_kelas,
                                            a.id_jurusan,
                                            a.foto,
                                            a.created_date,

                                            
                                            b.nama_kelas,

                                            c.nama_jurusan ,
                                            d.nama_lengkap, 
                                            d.nip                                          
                                        from 
                                            bahan_ajar a
                                            LEFT JOIN master_kelas b on (a.id_kelas=b.id_kelas)
                                            LEFT JOIN master_jurusan c on (a.id_jurusan=c.id)
                                            LEFT JOIN master_guru d on (a.id_guru=d.id)
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
        $id_guru                            = $this->input->post('id_guru');
        $id_kelas                   = $this->input->post('id_kelas');
        $id_jurusan                  = $this->input->post('id_jurusan');
       
        $file_name        = $_FILES['img']['name'];

        $url            = site_url('bahan-ajar/edit/'.$id);
        $directory      = $this->model_hook->objek('bahan_ajar','id','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('bahan_ajar','id','foto',$id);
        
        $ct_exist       = $ct;

            

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => 'jpg|jpeg|JPG|JPEG|PNG|png|gif|ico|pdf|docs',
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

                $this->mydb1->set('id_guru',$id_guru);
                $this->mydb1->set('id_jurusan',$id_jurusan);
                $this->mydb1->set('id_kelas',$id_kelas);
                $this->mydb1->set('foto',$foto);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->where('id',$id);
                $this->mydb1->update('bahan_ajar');
                
                $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
                $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('bahan-ajar/edit/'.$id);
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('id_guru',$id_guru);
            $this->mydb1->set('id_jurusan',$id_jurusan);
            $this->mydb1->set('id_kelas',$id_kelas);
            $this->mydb1->set('foto',$foto);
            $this->mydb1->set('created_date',$created_date);
            $this->mydb1->set('created_modified',$created_date);
            $this->mydb1->where('id',$id);
            $this->mydb1->update('bahan_ajar');
            
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

        $max=$this->model_combo_r->id_max('id','bahan_ajar');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $id_guru                            = $this->input->post('id_guru');
        $id_kelas                         = $this->input->post('id_kelas');
        $id_jurusan                          = $this->input->post('id_jurusan');
        $file_name        = $_FILES['img']['name'];
        //$format         = $this->format_upload();

        $url            = site_url('bahan-ajar/edit/'.$id);

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => 'jpg|jpeg|JPG|JPEG|PNG|png|gif|ico|pdf|docs',
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
                $this->mydb1->set('id_guru',$id_guru);
                $this->mydb1->set('id_kelas',$id_kelas);
                $this->mydb1->set('id_jurusan',$id_jurusan);
                $this->mydb1->set('foto',$foto);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
               
                $this->mydb1->insert('bahan_ajar');

                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('bahan-ajar/add');
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('id',$id);
                $this->mydb1->set('id_guru',$id_guru);
                $this->mydb1->set('id_kelas',$id_kelas);
                $this->mydb1->set('id_jurusan',$id_jurusan);
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->insert('bahan_ajar');
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
      
        $id = $this->format_data->string($this->uri->segment(3,0));
        $url='';

        $this->mydb1->trans_start();

        $this->mydb1->where('id',$id);
        $this->mydb1->delete('bahan_ajar');

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
    
        // $url='';
        // $id = $this->format_data->string($this->uri->segment(3,0));

        // $directory      = $this->model_hook->objek('bahan_ajar','id','created_modified',$id);
        // $year           = substr($directory,0,4);
        // $month          = substr($directory,5,2);
        // $ct             = $this->model_hook->objek('bahan_ajar','id','foto',$id);
        
        // $ct_exist = $ct;
        
        // $this->mydb1->trans_start();
        // $this->mydb1->where('id',$id);
        // $this->mydb1->update('bahan_ajar');
        // $this->mydb1->trans_complete();

        // if ($this->mydb1->trans_status()==false)
        // {
        //     $this->mydb1->trans_rollback();
        //     $this->error();
        //     return FALSE;
        // }
        // else
        // {
        //     $this->mydb1->trans_commit();
        //     $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
        //     $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
        //     $this->model_message->messege_proses('Berhasil menghapus Foto.','delete',$url,'fa-check-square-o','success');
        //     return TRUE;
        // }
    }

    public function init_delete_gambar()
    {
        $url='';
        $id = $this->format_data->string($this->uri->segment(3,0));

        $directory      = $this->model_hook->objek('bahan_ajar','id','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('bahan_ajar','id','foto',$id);
        
        $ct_exist = $ct;
        
        $this->mydb1->trans_start();
        $this->mydb1->set('foto','');
        $this->mydb1->where('id',$id);
        $this->mydb1->update('bahan_ajar');
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