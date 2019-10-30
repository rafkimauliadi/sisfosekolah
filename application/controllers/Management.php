<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_message','model_login'));
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
		if ($this->model_hook->login_exists()==true)
			redirect(site_url('administrator'));
		else
			$this->load->view('login/index',$data);
	}

	public function cek_login()
	{
		$this->init_login();
	}

	private function init_login()
	{
		if(isset($_POST['submit']))
	    {
			$username = $this->format_data->string($this->input->post('username',TRUE));
			$password = $this->format_data->string($this->input->post('password',TRUE));

	    	$this->session->set_flashdata('username', $username);

			if(empty($username) === TRUE || empty($password) === TRUE)
			{
				$status_property['parameter'] = 'pesan';
				$status_property['message'] = 'but we need your <b><i>Username</i></b> and <b><i>Password</i></b>.';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'cek_login';
				$status_property['url_process'] = ''; 
				$status_property['error_icon'] = 'fa fa-times';
				$status_property['error_type'] = 'information:';  
				$this->model_message->message_status($status_property); 
				redirect(site_url('management'));
			}
			else if($this->model_login->init_user_exist()==FALSE)
			{
				$status_property['parameter'] = 'pesan';
				$status_property['message'] = 'Your Account was wrong. Please try again.';
				$status_property['error_message'] = 'alert-danger';
				$status_property['status_message'] = 'cek_login';
				$status_property['url_process'] = ''; 
				$status_property['error_icon'] = 'fa fa-times';
				$status_property['error_type'] = 'Err.';  
				$this->model_message->message_status($status_property); 
				$this->model_login->_lock();
				
				redirect(base_url('management'));
			}
			else
			{
				$cek_akun = $this->model_login->init_user_lock();
				if($cek_akun == FALSE)
				{
					$status_property['parameter'] = 'pesan';
					$status_property['message'] = 'your account is locked. Please contact Administrator.';
					$status_property['error_message'] = 'alert-danger';
					$status_property['status_message'] = 'validation';
					$status_property['url_process'] = ''; 
					$status_property['error_icon'] = 'fa fa-times';
					$status_property['error_type'] = 'Err.';  
					$this->model_message->message_status($status_property); 
					redirect(base_url('management'));
				} 
				else
				{
					$view_login = $this->model_login->init_user_exist();
					if($view_login == TRUE)
					{
						$this->model_login->create_session();
		   				redirect('administrator');
		  			} 
				} 
			} 
		}  
		else
		{
			$status_property['parameter'] = 'pesan';
			$status_property['message'] = 'Silahkan coba lagi.';
			$status_property['error_message'] = 'alert-warning';
			$status_property['status_message'] = 'validation';
			$status_property['url_process'] = ''; 
			$status_property['error_icon'] = 'fa fa-times';
			$status_property['error_type'] = 'Error.';  
			$this->model_message->message_status($status_property);
			redirect(site_url('management'));	
		}
	}
}
