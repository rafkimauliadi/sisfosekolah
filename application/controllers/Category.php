<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_category','model_message','model_combo'));
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

		$this->session->set_flashdata('title', 'Category');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Category ', site_url('category'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_category->get_view($offset,$this->perpage);
		$data['search']		= $this->model_category->search();
		$data['pagination'] = $this->model_message->pagination(site_url('category/index'),$this->model_category->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_category','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Category');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Category ', site_url('category'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_category->get_view($offset,$this->perpage);
		$data['search']		= $this->model_category->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('mod_category','index',$data);
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

		$exist	= $this->model_category->exist_id($id);
		if ($exist==0)
			redirect(site_url('category'));
		if ($id==NULL)
			(site_url('category'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Category ', site_url('category'));
		$this->breadcrumb->add('Edit ', site_url('category/edit'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_category->get_data();

		$this->templates('mod_category','edit',$data);
	}

	public function update()
	{
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$this->model_category->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('category/edit/'.$id));         
        } 
	    else 
	    {
	    	$this->model_category->init_update();
	    	redirect(site_url('category'));
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
		$this->breadcrumb->add('Category ', site_url('category'));
		$this->breadcrumb->add('Add ', site_url('category/add'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_category','add',$data);
	}

	public function save()
	{
		$this->model_category->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('category/add/'));       
        } 
	    else 
	    {
	    	$this->model_category->init_save();
	    	redirect(site_url('category'));
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_category->init_delete();
	   	redirect(site_url('category'));
	}
}
