<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_module','model_message','model_combo'));
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

		$this->session->set_flashdata('title', 'Module');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Module ', site_url('module'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_module->get_view($offset,$this->perpage);
		$data['search']		= $this->model_module->search();
		$data['pagination'] = $this->model_message->pagination(site_url('module/index'),$this->model_module->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_module','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Module');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Module ', site_url('module'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_module->get_view($offset,$this->perpage);
		$data['search']		= $this->model_module->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('mod_module','index',$data);
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
		
		$exist	= $this->model_module->exist_id($id);
		if ($exist==0)
			redirect(site_url('module'));
		if ($id==NULL)
			redirect(site_url('module'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Module ', site_url('module'));
		$this->breadcrumb->add('Edit ', site_url('module/edit'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']		= $this->model_module->get_data();
		$data['cb_module']		= $this->model_module->cb_module();
		$data['cb_group'] 		= $this->model_combo->init_group();

		
		$this->templates('mod_module','edit',$data);
	}

	public function update()
	{
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$this->model_module->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('module/edit/'.$id));         
        } 
	    else 
	    {
	    	$parent_id      = $this->input->post('parent_id',TRUE);
	    	$cek			= $this->model_module->cek_parent_update('id_module','_module',$id,$parent_id);

	    	if ($cek > 0)
	    	{
	    		$this->model_message->messege_proses('Tidak bisa menyimpan dengan nama parent yang sama.','delete',$url,'fa-check-square-o','success');
	    		redirect(site_url('module/edit/'.$id));
	    	}
	    	else
	    	{
		    	$this->model_module->init_update();
		    	redirect(site_url('module'));
	    	}
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
		$parent_id = $this->format_data->string($this->uri->segment(3,0));

		$this->session->set_flashdata('title', 'Add');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Module ', site_url('module'));
		$this->breadcrumb->add('Add ', site_url('module/add'));

		$max=$this->model_combo->order_no('order_no','_module',$parent_id);
		if($max == 0) 
            $data['order_no'] = 1;
        else
            $data['order_no'] = $max+1;

        $data['cb_group'] 		= $this->model_combo->init_group();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_module','add',$data);
	}

	public function save()
	{
		$parent_id = $this->input->post('parent_id',TRUE);

		$this->model_module->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('module/add/'.$parent_id));         
        } 
	    else 
	    {
	    	$this->model_module->init_save();
	    	redirect(site_url('module'));
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$id = $this->format_data->string($this->uri->segment(3,0));
		$ct=$this->model_module->count_exists($id);

		if ($ct == 0)
		{
			$this->model_module->init_delete();
		    redirect(site_url('module'));
		}
		else
		{
			$this->model_message->messege_proses('Tidak bisa dihapus, karena data sedang digunakan.','delete',$url,'fa-check-square-o','success');
			redirect(site_url('module'));
		}
	}
}
