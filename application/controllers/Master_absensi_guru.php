<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_absensi_guru extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_absensi_guru'));
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

		$this->session->set_flashdata('title', 'Master Absensi Guru');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Absensi Guru ', site_url('master-absensi-guru'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_absensi_guru->get_data_absensi_guru();


		$this->templates('mod_master_absensi_guru','index',$data);
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
		$this->breadcrumb->add('Master Absensi Guru ', site_url('master-absensi-guru'));
		$this->breadcrumb->add('Add ', site_url('master-absensi-guru/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_master_absensi_guru','add',$data);
  }
  
  public function save()
	{
		$this->model_absensi_guru->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('master-absensi-guru/add/'));         
        } 
	    else 
	    {
	    	$this->model_absensi_guru->init_save();
	    	redirect(site_url('master-absensi-guru'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_absensi_guru->init_delete();
	    redirect(site_url('master_absensi_guru'));
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

		$exist	= $this->model_absensi_guru->exist_id($id);
		if ($exist==0)
			redirect(site_url('master-absensi-guru'));
		if ($id==NULL)
			redirect(site_url('master-absensi-guru'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Absensi Guru ', site_url('master-absensi-guru'));
		$this->breadcrumb->add('Edit ', site_url('master-absensi-guru/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_absensi_guru->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_master_absensi_guru','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));

    $id_guru     	= $this->format_data->string($this->input->post('id_guru',TRUE));
    $absen      	= $this->format_data->string($this->input->post('absen',TRUE));

		$this->model_absensi_guru->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('master-absensi-guru/edit/'.$id));
        }
	    else
	    {
	    	$cek_nama = $this->model_absensi_guru->cek_exist_nama('master_absensi_guru','id_guru','id',$id_guru,$id);

	    	if ($cek_nama > 0 )
	    	{
	    		$this->model_message->messege_proses('Absensi Guru sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('master-absensi-guru/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_absensi_guru->init_update();
	    		redirect(site_url('master-absensi-guru'));
	    	}
	    }
	}

}
