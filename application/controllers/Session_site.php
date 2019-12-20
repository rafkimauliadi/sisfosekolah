<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_site extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_session_site','model_message','model_combo'));
        $this->load->library(array('form_validation'));
    }

	private function templates($folder,$list,$data=array())
    {
		$this->load->view('backend/header',$data);
		$this->load->view('backend/sidebar');
		$this->load->view('com_admin/mod_session/'.$list);
		$this->load->view('backend/footer');
	}

	public function index()
	{
		$this->init_view();
	}

	private function init_view($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'CI Session');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('CI Session ', site_url('session_site'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_session_site->get_view($offset,$this->perpage);
		$data['search']		= $this->model_session_site->search();
		$data['pagination'] = $this->model_message->pagination(site_url('session_site/index'),$this->model_session_site->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_session','index',$data);
	}

	public function search($offset=NULL)
	{
		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'CI Session');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('CI Session ', site_url('session_site'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_session_site->get_view($offset,$this->perpage);
		$data['search']		= $this->model_session_site->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;

		$this->templates('mod_session','index',$data);
	}

	
	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_session_site->init_delete();
	    redirect('session_site');
	}
}
