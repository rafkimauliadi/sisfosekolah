<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_monitor_kelas extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_monitor_kelas'));
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

		$this->session->set_flashdata('title', 'Master Kelas');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Kelas ', site_url('master-monitor-kelas'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_monitor_kelas->get_data_kelas();


		$this->templates('master_monitor_kelas','index',$data);
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
		$this->breadcrumb->add('Master Kelas ', site_url('master-monitor-kelas'));
		$this->breadcrumb->add('Add ', site_url('master-monitor-kelas/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('master_monitor_kelas','add',$data);
  }
  
  public function save()
	{
		$this->model_monitor_kelas->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('master-monitor-kelas/add/'));         
        } 
	    else 
	    {
	    	$this->model_monitor_kelas->init_save();
	    	redirect(site_url('master-monitor-kelas'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_monitor_kelas->init_delete();
	    redirect(site_url('master_monitor_kelas'));
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

		$exist	= $this->model_monitor_kelas->exist_id($id);
		if ($exist==0)
			redirect(site_url('master-monitor-kelas'));
		if ($id==NULL)
			redirect(site_url('master-monitor-kelas'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Kelas ', site_url('master-monitor-kelas'));
		$this->breadcrumb->add('Edit ', site_url('master-monitor-kelas/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_monitor_kelas->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('master_monitor_kelas','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id_kelas',TRUE));

    $id_kelas     	= $this->format_data->string($this->input->post('id_kelas',TRUE));
    $tanda_guru     	= $this->format_data->string($this->input->post('tanda_guru',TRUE));

		$this->model_monitor_kelas->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('master-monitor-kelas/edit/'.$id));
        }
	    else
	    {
	    	$cek_nama = $this->model_monitor_kelas->cek_exist_nama('master_monitor_kelas','tanda_guru','id',$tanda_guru,$id);

	    	if ($cek_nama > 0 )
	    	{
	    		$this->model_message->messege_proses('nama sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('master-monitor-kelas/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_monitor_kelas->init_update();
	    		redirect(site_url('master-monitor-kelas'));
	    	}
	    }
	}

}
