<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {

	public function __construct()
    {
        
        parent::__construct();
        $this->load->model(array('model_message','model_account'));
        $this->load->library(array('form_validation','encryption'));
    }

	public function index()
	{
		$this->init_view();
	}

	private function init_view()
	{
		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();
		$data['info_pesan'] = $this->model_hook->info_admin();
		
		$this->load->view('login/reset',$data);
	}

	public function akun()
	{
		$this->cek_token();
	}

	private function cek_token()
	{
		if(isset($_POST['submit']))
	    {
			$email = $this->format_data->string($this->input->post('email',TRUE));

	    	$this->session->set_flashdata('email', $email);

			if(empty($email) === TRUE )
			{
				$status_property['parameter'] = 'pesan';
				$status_property['message'] = 'But we need your <b><i>Email</i></b> ';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'cek_login';
				$status_property['url_process'] = ''; 
				$status_property['error_icon'] = 'fa fa-times';
				$status_property['error_type'] = 'information:';  
				$this->model_message->message_status($status_property); 
				redirect(site_url('reset'));
			}
			else if($this->model_account->init_user_exist()==FALSE)
			{
				$status_property['parameter'] = 'pesan';
				$status_property['message'] = 'Your Account was wrong. Please try again.';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'cek_login';
				$status_property['url_process'] = ''; 
				$status_property['error_icon'] = 'fa fa-times';
				$status_property['error_type'] = 'Err.';  
				$this->model_message->message_status($status_property); 				
				redirect(base_url('reset'));
			}
			else
			{
				$cek_akun = $this->model_account->init_user_lock();
				if($cek_akun == FALSE)
				{
					$status_property['parameter'] = 'pesan';
					$status_property['message'] = 'Your account is locked. Please contact Administrator.';
					$status_property['error_message'] = 'alert-danger';
					$status_property['status_message'] = 'validation';
					$status_property['url_process'] = ''; 
					$status_property['error_icon'] = 'fa fa-times';
					$status_property['error_type'] = 'Err.';  
					$this->model_message->message_status($status_property); 
					redirect(base_url('reset'));
				} 
				else
				{
					$view_login = $this->model_account->init_user_exist();
					if($view_login == TRUE)
					{
						$this->model_account->send_token();
		   				redirect('reset');
		  			} 
				} 
			} 
		}  
		else
		{
			$status_property['parameter'] = 'pesan';
			$status_property['message'] = 'Please, try again.';
			$status_property['error_message'] = 'alert-warning';
			$status_property['status_message'] = 'validation';
			$status_property['url_process'] = ''; 
			$status_property['error_icon'] = 'fa fa-times';
			$status_property['error_type'] = 'Error.';  
			$this->model_message->message_status($status_property);
			redirect(site_url('reset'));	
		}
	}


	public function account()
	{
		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();
		$data['info_pesan'] = $this->model_hook->info_admin();
		
		$this->load->view('login/view_reset',$data);
	}
	
	public function password()
	{
	    $url='';
	    $token = $this->format_data->string($this->uri->segment(3,0));
	    $password       = $this->format_data->string($this->input->post('password',TRUE));
	    $ct = $this->model_account->cek_token($token);
	    $id_user = $ct->id_user;
	    $exist   = $ct->exist;
	    
	    if(empty($password) === TRUE)
	    {
	        $status_property['parameter'] = 'pesan';
			$status_property['message'] = 'Masukkan <b><i>Password Baru</i></b> </b>.';
			$status_property['error_message'] = 'alert-danger';
			$status_property['status_message'] = 'cek_login';
			$status_property['url_process'] = ''; 
			$status_property['error_icon'] = 'fa fa-times';
			$status_property['error_type'] = 'information:';  
			$this->model_message->message_status($status_property); 
			redirect(site_url('reset/account/'.$token));
	    }
	    else
	    {
            if ($exist > 0)
            {
        	    $this->model_account->reset_password($id_user,$token);
        	    redirect(site_url('management'));
            }
	        else
	        {
        	    $this->model_message->messege_proses('Tautan anda sudah tidak bisa digunakan, silahkan <a href="'.site_url('reset').'">coba lagi</a>.','delete',$url,'fa-check-square-o','success');
        	    $this->account();
            }
	    }
	}
}
