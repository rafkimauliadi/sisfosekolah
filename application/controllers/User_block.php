<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_block extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user_block','model_message','model_combo','model_instansi'));
        $this->load->library(array('form_validation','encryption'));
    }

	private function templates($folder,$list,$data=array())
    {
		$this->load->view('backend/header',$data);
		$this->load->view('backend/sidebar');
		$this->load->view('com_admin/'.$folder.'/'.$list);
		$this->load->view('backend/footer');
	}

	public function index()
	{
		$this->init_view();
	}

	private function init_view($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'User Block');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('User ', site_url('user-block'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_user_block->get_view($offset,$this->perpage);
		$data['search']		= $this->model_user_block->search();
		$data['pagination'] = $this->model_message->pagination(site_url('user/index'),$this->model_user_block->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_user_block','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'User');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('User ', site_url('user-block'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_user_block->get_view($offset,$this->perpage);
		$data['search']		= $this->model_user_block->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('mod_user_block','index',$data);
	}

	public function edit()
	{
		if(($this->input->post('update'))==NULL)
			$this->init_edit();
		else
			$this->update();		
	}

	private function init_edit()
	{

		$id = $this->format_data->string($this->uri->segment(3,0));

		$exist	= $this->model_user_block->exist_id($id);
		if ($exist==0)
			redirect(site_url('user-block'));
		if ($id==NULL)
			redirect(site_url('user-block'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('User ', site_url('User'));
		$this->breadcrumb->add('Edit ', site_url('user-block/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_user_block->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_user_block','edit',$data);
	}

	public function update()
	{
	    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));

		$username       	= $this->format_data->string($this->input->post('username',TRUE));
		$email				= $this->format_data->string($this->input->post('email',TRUE));
		$nomor_identitas	= $this->format_data->string($this->input->post('nomor_identitas',TRUE));
		$this->model_user_block->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('user-block/edit/'.$id));         
        } 
	    else 
	    {
	    	$cek_username 			= $this->model_user_block->cek_exist_akun('_users','username','id_user',$username,$id);
	    	$cek_email 				= $this->model_user_block->cek_exist_akun('_users','email','id_user',$email,$id);
	    	$cek_nomor_identitas 	= $this->model_user_block->cek_exist_akun('_users','nomor_identitas','id_user',$nomor_identitas,$id);

	    	if ($cek_username > 0 )
	    	{
	    		$this->model_message->messege_proses('username sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('user-block/edit/'.$id));
	    	}
	    	else if ($cek_email > 0 )
	    	{
	    		$this->model_message->messege_proses('email sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('user-block/edit/'.$id));
	    	}
	    	else if ($cek_nomor_identitas > 0)
	    	{
	    		$this->model_message->messege_proses('Nomor Identitas sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('user-block/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_user_block->init_update();
	    		redirect(site_url('user-block'));
	    	}
	    }
	}
}
