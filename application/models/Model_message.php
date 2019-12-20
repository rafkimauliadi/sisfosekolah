<?php
class Model_message extends CI_Model
{	

    public function __construct()
    {
        //error_reporting(0);
        parent::__construct();      
    }

    public function conv_validasi_to_indonesia()
    {
        $this->form_validation->set_message('required','%s wajib diisi.');
        $this->form_validation->set_message('min_length','%s sekurang-kurangnya harus berisi %s karakter.');
        $this->form_validation->set_message('max_length','%s tidak boleh lebih dari %s karakter.');
        $this->form_validation->set_message('valid_email','%s harus berisi alamat email yang valid.');
        $this->form_validation->set_message('numeric','%s harus bernilai numeric yang valid.');
        $this->form_validation->set_message('integer','%s harus bernilai integer yang valid.');
        $this->form_validation->set_message('matches','%s tidak cocok dengan %s.');
        $this->form_validation->set_message('is_unique','%s sudah digunakan.');
        $this->form_validation->set_message('alpha_numeric','%s hanya boleh diisi dengan huruf atau angka.');
    }


    public function validation_error()
    {
        $status_property['parameter'] = 'pesan';
        $status_property['message'] = validation_errors();
        $status_property['error_message'] = 'alert-danger';
        $status_property['status_message'] = 'validation';
        $status_property['url_process'] = '';  
        $status_property['url_process'] = '';  
        $status_property['error_icon'] = '';
        $status_property['error_type'] ='';
        $this->model_message->message_status($status_property);
    }

    public function messege_proses($message,$action,$url,$error_icon,$danger)
    {
        $status_property['parameter'] = 'pesan';
        $status_property['message'] = $message;
        $status_property['error_message'] = 'alert-'.$danger;
        $status_property['status_message'] = $action;
        $status_property['url_process'] = $url;  
        $status_property['error_icon'] = $error_icon;
        $status_property['error_type'] = '<b>Informasi: </b>';
        $this->model_message->message_status($status_property);
    }

    public function message_status($status_property)
    {
        $view_status = "";
        $view_url = "";
        
        $parameter      = $status_property['parameter'];
        $message        = $status_property['message'];
        $error_message  = $status_property['error_message'];
        $status_message = $status_property['status_message'];
        $url_process    = $status_property['url_process'];
        $error_icon     = $status_property['error_icon'];
        $error_type     = $status_property['error_type'];

        if(($status_message == "save")||($status_message == "edit"))
        {
            $view_status = "Edit";
            $view_url = $url_process;
        }
        
        $view_message = '<div class="alert '.$error_message.'">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong><i class="fa '.$error_icon.'"></i> '.$error_type.'</strong>
                            '.$message.'<a href="'.$view_url.'" class="confirm-edit"><u>'.$view_status.'</u></a>
                        </div>';

        $this->session->set_flashdata($parameter,$view_message);
    }

    public function pagination($site_url,$total_rows,$perpage)
    {
        $this->load->library('pagination');
        $config['base_url'] = $site_url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $perpage;

        $config['num_links'] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Start';
        $config['last_link'] = 'End';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // $data['offset'] = $offset;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
    
    public function pagination_sub($site_url,$urisegment,$total_rows,$perpage,$parameter1="")
    {
        $this->load->library('pagination');
        $config['base_url'] = $site_url.$parameter1;
        $config['total_rows'] = $total_rows;
        $config['uri_segment'] = $urisegment;
        $config['per_page'] = $perpage;

        $config['num_links'] = 4;
        $config['full_tag_open'] = '<ul class="pagination pagination-large"">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Start';
        $config['last_link'] = 'End';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // $data['offset'] = $offset;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}