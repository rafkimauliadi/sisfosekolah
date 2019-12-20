<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_content','model_message','model_combo'));
        $this->load->library(array('form_validation'));
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

		$this->session->set_flashdata('title', 'Content');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Content ', site_url('content'));
		$this->breadcrumb->add('index ', site_url('content'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_content->get_view($offset,$this->perpage);
		$data['search']		= $this->model_content->search();
		$data['pagination'] = $this->model_message->pagination(site_url('content/index'),$this->model_content->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_content','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Content');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Content ', site_url('content'));
		$this->breadcrumb->add('index ', site_url('content'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_content->get_view($offset,$this->perpage);
		$data['search']		= $this->model_content->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('mod_content','index',$data);
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

		$exist	= $this->model_content->exist_id($id);
		if ($exist==0)
			redirect(site_url('content'));
		if ($id==NULL)
			(site_url('content'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Content ', site_url('content'));
		$this->breadcrumb->add('Edit ', site_url('content/edit'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_content->get_data();

		$this->templates('mod_content','edit',$data);
	}

	public function update()
	{
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$this->model_content->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('content/edit/'.$id));         
        } 
	    else 
	    {
	    	$this->model_content->init_update();
	    	redirect(site_url('content'));
	    }
	}

	public function add()
	{
		if(($this->input->post('save'))==NULL)
			$this->init_add();
		else
			$this->save();
	}

	public function init_add()
	{
		$this->session->set_flashdata('title', 'Add');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Content ', site_url('content'));
		$this->breadcrumb->add('Add ', site_url('content/add'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_content','add',$data);
	}

	public function save()
	{
		$this->model_content->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('content/add/'));       
        } 
	    else 
	    {
	    	$this->model_content->init_save();
	    	redirect(site_url('content'));
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_content->init_delete();
	   	redirect(site_url('content'));
	}

	public function gambar()
	{
		$this->model_content->init_delete_gambar();
        redirect(site_url('content'));
	}
}
