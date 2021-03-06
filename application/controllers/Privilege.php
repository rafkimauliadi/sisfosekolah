<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_privilege','model_message','model_combo'));
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

		$this->session->set_flashdata('title', 'White List');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('White List ', site_url('privilege'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_privilege->get_view($offset,$this->perpage);
		$data['search']		= $this->model_privilege->search();
		$data['pagination'] = $this->model_message->pagination(site_url('privilege/index'),$this->model_privilege->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('mod_privilege','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'White List');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('White List ', site_url('privilege'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_privilege->get_view($offset,$this->perpage);
		$data['search']		= $this->model_privilege->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('mod_privilege','index',$data);
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
		
		$exist	= $this->model_privilege->exist_id($id);
		if ($exist==0)
			redirect(site_url('privilege'));
		if ($id==NULL)
			redirect(site_url('privilege'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('White List ', site_url('privilege'));
		$this->breadcrumb->add('Edit ', site_url('privilege/edit'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']			= $this->model_privilege->get_data();
		$data['cb_white_list']		= $this->model_privilege->cb_white_list();

		
		$this->templates('mod_privilege','edit',$data);
	}

	public function update()
	{
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$this->model_privilege->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('privilege/edit/'.$id));         
        } 
	    else 
	    {
	    	$parent_id      = $this->input->post('parent_id',TRUE);
	    	$cek			= $this->model_privilege->cek_parent_update('id_white','_white_list',$id,$parent_id);

	    	if ($cek > 0)
	    	{
	    		$this->model_message->messege_proses('Tidak bisa menyimpan dengan nama parent yang sama.','delete',$url,'fa-check-square-o','success');
	    		redirect(site_url('privilege/edit/'.$id));
	    	}
	    	else
	    	{
		    	$this->model_privilege->init_update();
		    	redirect(site_url('privilege'));
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
		$this->breadcrumb->add('White List ', site_url('privilege'));
		$this->breadcrumb->add('Add ', site_url('privilege/add'));

		$max=$this->model_combo->order_no('order_no','_white_list',$parent_id);
		if($max == 0) 
            $data['order_no'] = 1;
        else
            $data['order_no'] = $max+1;

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_privilege','add',$data);
	}

	public function save()
	{
		$parent_id = $this->input->post('parent_id',TRUE);

		$this->model_privilege->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('privilege/add/'.$parent_id));         
        } 
	    else 
	    {
	    	$this->model_privilege->init_save();
	    	redirect(site_url('privilege'));
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$id = $this->format_data->string($this->uri->segment(3,0));
		$ct=$this->model_privilege->count_exists($id);

		if ($ct == 0)
		{
			$this->model_privilege->init_delete();
		    redirect(site_url('privilege'));
		}
		else
		{
			$this->model_message->messege_proses('Tidak bisa dihapus, karena data sedang digunakan.','delete',$url,'fa-check-square-o','success');
			redirect(site_url('privilege'));
		}
	}
}
