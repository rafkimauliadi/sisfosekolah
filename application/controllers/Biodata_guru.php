<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biodata_guru extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_biodata_guru','model_message','model_combo_r'));
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

		$this->session->set_flashdata('title', 'Data Guru');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Guru ', site_url('biodata-guru'));
		$this->breadcrumb->add('index ', site_url('biodata-guru'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_biodata_guru->get_view($offset,$this->perpage);
		$data['search']		= $this->model_biodata_guru->search();
		$data['pagination'] = $this->model_message->pagination(site_url('biodata-guru/index'),$this->model_biodata_guru->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;

		$this->templates('guru/biodata','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Data guru');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata guru ', site_url('biodata-guru'));
		$this->breadcrumb->add('index ', site_url('biodata-guru'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_biodata_guru->get_view($offset,$this->perpage);
		$data['search']		= $this->model_biodata_guru->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('guru/biodata','index',$data);
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

		$exist	= $this->model_biodata_guru->exist_id($id);
		if ($exist==0)
			redirect(site_url('biodata-guru'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata guru ', site_url('biodata-guru'));
		$this->breadcrumb->add('Edit ', site_url('biodata-guru'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_biodata_guru->get_data();

		$this->templates('guru/biodata','edit',$data);
	}

	public function update()
	{
		$url='';
		$cek_exist = $this->model_biodata_guru->check_nik_by_change();
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$nip       = $this->format_data->string($this->input->post('nip',TRUE));
		$this->model_biodata_guru->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('biodata-guru/edit/'.$id));         
        } 
	    else 
	    {
	    	if ($cek_exist == "0")
	    	{
	    		$this->model_biodata_guru->init_update();
	    		redirect(site_url('biodata-guru'));
	    	}
	    	else
	    	{
	    		$this->model_message->messege_proses('NIP '.$nip.' sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    		redirect(site_url('biodata-guru/edit/'.$id));
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

	//1. Proses pemanggilan form add data
	public function init_add()
	{
		$this->session->set_flashdata('title', 'Add');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Biodata Guru ', site_url('biodata-guru'));
		$this->breadcrumb->add('Add ', site_url('biodata-guru'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('guru/biodata','add',$data);
	}

	//1. Proses Validasi dan Proses Penyimpanan data ke Model
	public function save()
	{
		$ct = $this->model_biodata_guru->cek_exist();
		$this->model_biodata_guru->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('biodata-guru/add/'));       
        } 
	    else 
	    {
	    	if ($ct == 0)
	    	{
	    		$this->model_biodata_guru->init_save();
	    		redirect(site_url('biodata-guru'));	
	    	}
	    	else
	    	{
	    		$this->model_message->messege_proses('NIP sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    		redirect(site_url('biodata-guru/add'));	
	    	}
	    	
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_biodata_guru->init_delete();
	   	redirect(site_url('biodata-guru'));
	}

	public function gambar()
	{
		$this->model_biodata_guru->init_delete_gambar();
        redirect(site_url('biodata-guru'));
	}
}
