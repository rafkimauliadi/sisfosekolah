<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_ajaran extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_tahun_ajaran'));
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

		$this->session->set_flashdata('title', 'Master Tahun Ajaran');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Tahun Ajaran ', site_url('tahun-ajaran'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_tahun_ajaran->get_data_tahun_ajaran();


		$this->templates('tahun_ajaran','index',$data);
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
		$this->breadcrumb->add('Master Jam ', site_url('tahun-ajaran'));
		$this->breadcrumb->add('Add ', site_url('tahun-ajaran/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('tahun_ajaran','add',$data);
  }
  
  public function save()
	{
		$this->model_tahun_ajaran->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('tahun-ajaran/add/'));         
        } 
	    else 
	    {
	    	$this->model_tahun_ajaran->init_save();
	    	redirect(site_url('tahun-ajaran'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_tahun_ajaran->init_delete();
	    redirect(site_url('tahun_ajaran'));
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

		$exist	= $this->model_tahun_ajaran->exist_id($id);
		if ($exist==0)
			redirect(site_url('tahun-ajaran'));
		if ($id==NULL)
			redirect(site_url('tahun-ajaran'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Jam ', site_url('tahun-ajaran'));
		$this->breadcrumb->add('Edit ', site_url('tahun-ajaran/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_tahun_ajaran->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('tahun_ajaran','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));

    $tahun      	= $this->format_data->string($this->input->post('tahun',TRUE));

		$this->model_tahun_ajaran->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('tahun-ajaran/edit/'.$id));
        }
	    else
	    {
	    	$cek_nama = $this->model_tahun_ajaran->cek_exist_nama('tahun_ajaran','tahun','id',$tahun,$id);

	    	if ($cek_nama > 0 )
	    	{
	    		$this->model_message->messege_proses('Jam sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('tahun-ajaran/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_tahun_ajaran->init_update();
	    		redirect(site_url('tahun-ajaran'));
	    	}
	    }
	}

}
