<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_login','model_message','model_dashboard'));
        $this->load->library(array('form_validation','encryption'));
    }

	private function templates($folder,$list,$data=array())
    {
		$this->load->view('backend/header',$data);
		$this->load->view('backend/sidebar');
		$this->load->view('com_admin/mod_dashboard/'.$list);
		$this->load->view('backend/footer');
	}


	public function index()
	{		
		$this->init_view();
	}

	private function init_view()
	{
		$this->session->set_flashdata('title', 'Panel Administrator');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', base_url().'administrator');
		$this->breadcrumb->add('Welcome ', base_url().'administrator');

		$data = array (
					'show_dashboard' => $this->model_dashboard->show_dashboard()
			);

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$this->templates('mod_dashboard','index',$data);
	}

	public function logout()
	{
		$this->destroy_session();
	}

	private function destroy_session()
	{
		$this->model_login->destroy_login();
		unset($_SESSION['system_value']);
		redirect(site_url());
	}


	public function change_password()
	{
		$this->init_change_password();
	}

	private function init_change_password()
	{
		$this->session->set_flashdata('title', 'Change Password');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Change Password', site_url('administrator/change-password'));
		$this->breadcrumb->add('New Password', site_url('administrator'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();
		$this->templates('mod_dashboard','chage_password',$data);
	}

	public function save_password()
	{
		$this->model_login->validation_field();

		if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            $this->change_password();         
        } 
	    else 
	    {
	    	$this->model_login->init_save();
	    	redirect('administrator/change-password');
	    }  
	}

	public function edit_profile()
	{
		$this->init_edit_profile();
	}

	private function init_edit_profile()
	{
		$this->session->set_flashdata('title', 'Edit Profile');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Edit Profile', site_url('administrator/edit-profile'));
		$this->breadcrumb->add('Update Profile', site_url('administrator'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_dashboard','edit_profile',$data);
	}

	public function update_profile()
	{
		$this->model_login->validation_field_profile();

		if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            $this->edit_profile();         
        } 
	    else 
	    {
	    	$ct = $this->model_login->cek_id_account();
	    	if ($ct !=0)
	    	{
		    	$this->model_login->init_update();
		    	redirect('administrator/edit-profile');
	    	}
	    	else
	    	{
	    		$this->model_login->init_create();
		    	redirect('administrator/edit-profile');	
	    	}
	    }
	}



}
