<?php
class Model_content extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    public function format_upload()
    {
        $data=$this->mydb1->query("SELECT GROUP_CONCAT(format) as format FROM _dropbox_type where id_dropbox_type='1'");
        return $data->row()->format;
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

        $title          = $this->input->post('title');
        $id_category    = $this->input->post('id_category');
        $content        = $this->input->post('content');
        $id_status      = $this->input->post('id_status');

        $this->session->set_flashdata('title_content', $title);
        $this->session->set_flashdata('content', $content);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id_category', 'Category', 'required');
        $this->form_validation->set_rules('id_status', 'Status', 'required');
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_content) as exist FROM content WHERE id_content = '$id'");
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
                                            a.id_content,
                                            a.title,
                                            a.isi,
                                            a.gambar,
                                            a.id_category,
                                            a.created_date,
                                            a.created_modified,
                                            a.created_by,
                                            a.hits,
                                            a.id_status,

                                            b.nm_status,

                                            c.title as title_category,

                                            d.full_name
                                        from 
                                            content a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN category c on (a.id_category=c.id_category)
                                            LEFT JOIN _users_account d on (a.created_by=d.id_user)
                                        WHERE 
                                            a.type_data='1'");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.id_content,
                                            a.title
                                        from 
                                            content a
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
                                            a.id_content,
                                            a.title,
                                            a.isi,
                                            a.gambar,
                                            a.id_category,
                                            a.created_date,
                                            a.created_modified,
                                            a.created_by,
                                            a.hits,
                                            a.id_status,

                                            b.nm_status,

                                            c.title as title_category,
                                            d.full_name
                                        from 
                                            content a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN category c on (a.id_category=c.id_category)
                                            LEFT JOIN _users_account d on (a.created_by=d.id_user)
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        AND
                                            a.type_data='1'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_content,
                                            a.title,
                                            a.isi,
                                            a.gambar,
                                            a.id_category,
                                            a.created_date,
                                            a.created_modified,
                                            a.created_by,
                                            a.hits,
                                            a.id_status,

                                            b.nm_status,

                                            c.title as title_category,

                                            d.full_name
                                        from 
                                            content a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN category c on (a.id_category=c.id_category)
                                            LEFT JOIN _users_account d on (a.created_by=d.id_user)
                                        WHERE 
                                            a.type_data='1'
                                        order by a.id_content desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_content,
                                            a.title,
                                            a.isi,
                                            a.gambar,
                                            a.id_category,
                                            a.created_date,
                                            a.created_modified,
                                            a.created_by,
                                            a.hits,
                                            a.id_status,

                                            b.nm_status,

                                            c.id_category,
                                            c.title as title_category
                                        from 
                                            content a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN category c on (a.id_category=c.id_category)
                                        WHERE 
                                            a.type_data='1'
                                        AND
                                            a.id_content='$id'");
        return $data;
    }

    public function init_update()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);
        $id_user        = $this->model_hook->init_online_exist();

        $id          = $this->input->post('id');
        $title          = $this->input->post('title');
        $id_category    = $this->input->post('id_category');
        $content        = $this->input->post('content');
        $id_status      = $this->input->post('id_status');

        $file_name        = $_FILES['img']['name'];
        $format         = $this->format_upload();
        $format_upload  = str_replace(',', '|', $format);

        $url            = site_url('content/edit/'.$id);
        $directory      = $this->model_hook->objek('content','id_content','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('content','id_content','gambar',$id);
        
        $ct_exist       = $ct;

            

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => $format_upload,
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

                $this->mydb1->set('title',$title);
                $this->mydb1->set('isi',$content);
                $this->mydb1->set('gambar',$foto);
                $this->mydb1->set('id_category',$id_category);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->set('id_status',$id_status);
                $this->mydb1->where('id_content',$id);
                $this->mydb1->update('content');
                
                $this->model_hook->images('images',$year,$month,$ct,$ct_exist);
                $this->model_hook->thumbnail('images',$year,$month,'thumbnails/'.$ct,$ct_exist);
                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('content/edit/'.$id);
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('title',$title);
            $this->mydb1->set('isi',$content);
            $this->mydb1->set('id_category',$id_category);
            $this->mydb1->set('type_data','1');
            $this->mydb1->set('id_status',$id_status);
            $this->mydb1->where('id_content',$id);
            $this->mydb1->update('content');
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

    public function init_save()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $max=$this->model_combo->id_max('id_content','content');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $id_user        = $this->model_hook->init_online_exist();

        $title          = $this->input->post('title');
        $id_category    = $this->input->post('id_category');
        $content        = $this->input->post('content');
        $id_status      = $this->input->post('id_status');

        $file_name        = $_FILES['img']['name'];
        $format         = $this->format_upload();
        $format_upload  = str_replace(',', '|', $format);

        $url            = site_url('content/edit/'.$id);

        $this->mydb1->trans_start();
        if ($file_name!='')
        {
            $config = array(
                       'allowed_types' => $format_upload,
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

                $this->mydb1->set('title',$title);
                $this->mydb1->set('isi',$content);
                $this->mydb1->set('gambar',$foto);
                $this->mydb1->set('id_category',$id_category);
                $this->mydb1->set('type_data','1');
                $this->mydb1->set('created_date',$created_date);
                $this->mydb1->set('created_modified',$created_date);
                $this->mydb1->set('created_by',$id_user);
                $this->mydb1->set('hits','0');
                $this->mydb1->set('id_status',$id_status);
                $this->mydb1->insert('content');

                $this->createThumbnailFoto($foto);
            }
            else 
            {
                $this->model_message->messege_proses('gagal upload...','delete',$url,'fa-check-square-o','warning');
                redirect('content/add');
                return FALSE;
            }
        }
        else
        {
            $this->mydb1->set('title',$title);
            $this->mydb1->set('isi',$content);
            $this->mydb1->set('id_category',$id_category);
            $this->mydb1->set('type_data','1');
            $this->mydb1->set('created_date',$created_date);
            $this->mydb1->set('created_modified',$created_date);
            $this->mydb1->set('created_by',$id_user);
            $this->mydb1->set('hits','0');
            $this->mydb1->set('id_status',$id_status);
            $this->mydb1->insert('content');
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

        $directory      = $this->model_hook->objek('content','id_content','created_modified',$id);
        $year           = substr($directory,0,4);
        $month          = substr($directory,5,2);
        $ct             = $this->model_hook->objek('content','id_content','gambar',$id);
        
        $ct_exist = $ct;
        
        $this->mydb1->trans_start();
        $this->mydb1->set('gambar','');
        $this->mydb1->where('id_content',$id);
        $this->mydb1->update('content');
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
            $this->model_message->messege_proses('Berhasil menghapus Gambar.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }
}