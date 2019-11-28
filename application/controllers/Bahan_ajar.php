<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan_ajar extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_bahan_ajar','model_message','model_combo_r'));
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

		$this->session->set_flashdata('title', 'Data Bahan Ajar');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Bahan Ajar Guru ', site_url('bahan-ajar'));
		$this->breadcrumb->add('index ', site_url('bahan-ajar'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_bahan_ajar->get_view($offset,$this->perpage);
		$data['search']		= $this->model_bahan_ajar->search();
		$data['pagination'] = $this->model_message->pagination(site_url('bahan-ajar/index'),$this->model_bahan_ajar->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;

		$this->templates('bahan_ajar/guru','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Data Bahan Ajar');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Bahan Ajar Guru ', site_url('bahan-ajar'));
		$this->breadcrumb->add('index ', site_url('bahan-ajar'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_bahan_ajar->get_view($offset,$this->perpage);
		$data['search']		= $this->model_bahan_ajar->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('bahan_ajar/guru','index',$data);
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

		$exist	= $this->model_bahan_ajar->exist_id($id);
		if ($exist==0)
			redirect(site_url('bahan-ajar'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Bahan Ajar Guru ', site_url('bahan-ajar'));
		$this->breadcrumb->add('Edit ', site_url('bahan-ajar'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_bahan_ajar->get_data();

		$this->templates('bahan_ajar/guru','edit',$data);
	}

	public function update()
	{
		$url='';
		// $cek_exist = $this->model_bahan_ajar->check_nik_by_change();
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		// $id_guru       = $this->format_data->string($this->input->post('id_guru',TRUE));
		$this->model_bahan_ajar->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('bahan-ajar/edit/'.$id));         
        } 
	    else 
	    {
	    	// if ($cek_exist == "0")
	    	// {
	    		$this->model_bahan_ajar->init_update();
	    		redirect(site_url('bahan-ajar'));
	    	// }
	    	// // else
	    	// // {
			// // 	$this->model_message->messege_proses(' sudah digunakan','delete',$url,'fa-check-square-o','danger');

	    	// // 	// $this->model_message->messege_proses('id_guru '.$id_guru.' sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    	// // 	redirect(site_url('bahan-ajar/edit/'.$id));
	    	// // }
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
		$this->breadcrumb->add('Bahan Ajar Guru ', site_url('bahan-ajar'));
		$this->breadcrumb->add('Add ', site_url('bahan-ajar'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('bahan_ajar/guru','add',$data);
	}

	//1. Proses Validasi dan Proses Penyimpanan data ke Model
	public function save()
	{
		$ct = $this->model_bahan_ajar->cek_exist();
		$this->model_bahan_ajar->validation_field(); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('bahan-ajar/add/'));       
        } 
	    else 
	    {
	    	if ($ct == 0)
	    	{
	    		$this->model_bahan_ajar->init_save();
	    		redirect(site_url('bahan-ajar'));	
	    	}
	    	else
	    	{
	    		$this->model_message->messege_proses('Id_guru sudah digunakan','delete',$url,'fa-check-square-o','danger');
	    		redirect(site_url('bahan-ajar/add'));	
	    	}
	    	
	    }
	}

	public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_bahan_ajar->init_delete();
	   	redirect(site_url('bahan-ajar'));
	}

	public function gambar()
	{
		$this->model_bahan_ajar->init_delete_gambar();
        redirect(site_url('bahan-ajar'));
	}
}
