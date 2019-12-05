<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata_siswa extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_biodata_siswa','model_message','model_combo_r','model_combo'));
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

		$this->session->set_flashdata('title', 'Data Siswa');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Siswa ', site_url('biodata-siswa'));
		$this->breadcrumb->add('index ', site_url('biodata-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_biodata_siswa->get_view($offset,$this->perpage);
		$data['search']		= $this->model_biodata_siswa->search();
		$data['pagination'] = $this->model_message->pagination(site_url('biodata-siswa/index'),$this->model_biodata_siswa->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;


		$this->templates('siswa/biodata','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Data Siswa');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Siswa ', site_url('biodata-siswa'));
		$this->breadcrumb->add('index ', site_url('biodata-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_biodata_siswa->get_view($offset,$this->perpage);
		$data['search']		= $this->model_biodata_siswa->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;

		$this->templates('siswa/biodata','index',$data);
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

		$exist	= $this->model_biodata_siswa->exist_id($id);
		if ($exist==0)
			redirect(site_url('biodata-siswa'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Siswa ', site_url('biodata-siswa'));
		$this->breadcrumb->add('Edit ', site_url('biodata-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_biodata_siswa->get_data();

		$this->templates('siswa/biodata','edit',$data);
	}

	public function update()
	{
		$url='';
		$cek_exist = $this->model_biodata_siswa->check_nik_by_change();
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$nis       = $this->format_data->string($this->input->post('nis',TRUE));
		$this->model_biodata_siswa->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('biodata-siswa/edit/'.$id));         
        } 
	    else 
	    {
	    	if ($cek_exist == "0")
	    	{
	    		$this->model_biodata_siswa->init_update();
	    		redirect(site_url('biodata-siswa'));
	    	}
	    	else
	    	{
	    		$this->model_message->messege_proses('NIS '.$nis.' sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    		redirect(site_url('biodata-siswa/edit/'.$id));
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
		$this->session->set_flashdata('title', 'Add');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Siswa ', site_url('biodata-siswa'));
		$this->breadcrumb->add('Add ', site_url('biodata-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('siswa/biodata','add',$data);
	}

	public function save()
	{
		$ct = $this->model_biodata_siswa->cek_exist();
		$this->model_biodata_siswa->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('biodata-siswa/add/'));       
        } 
	    else 
	    {
	    	if ($ct == 0)
	    	{
	    		$this->model_biodata_siswa->init_save();
	    		$this->model_biodata_siswa->user();
	    		redirect(site_url('biodata-siswa'));	
	    	}
	    	else
	    	{
	    		$this->model_message->messege_proses('NIS sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    		redirect(site_url('biodata-siswa/add'));	
	    	}
	    	
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_biodata_siswa->init_delete();
	   	redirect(site_url('biodata-siswa'));
	}

	public function gambar()
	{
		$this->model_biodata_siswa->init_delete_gambar();
        redirect(site_url('biodata-siswa'));
	}
}
