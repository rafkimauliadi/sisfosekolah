<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_kelas extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_siswa_kelas','model_combo_r'));
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

		$this->session->set_flashdata('title', ' Siswa_kelas');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add(' Siswa_kelas ', site_url('siswa-kelas'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_siswa_kelas->get_data_siswa_kelas();


		$this->templates('mod_siswa_kelas','index',$data);
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
		$this->breadcrumb->add(' Siswa Kelas ', site_url('siswa-kelas'));
		$this->breadcrumb->add('Add ', site_url('siswa-kelas'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

        $this->templates('mod_siswa_kelas','add',$data);
    
  }
  
  public function save()
	{
		$this->model_siswa_kelas->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('siswa-kelas/add/'));         
        } 
	    else 
	    {
	    	$this->model_siswa_kelas->init_save();
	    	redirect(site_url('siswa-kelas'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_siswa_kelas->init_delete();
	    redirect(site_url('siswa_kelas'));
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

		$exist	= $this->model_siswa_kelas->exist_id($id);
		if ($exist==0)
			redirect(site_url('siswa-kelas'));
		if ($id==NULL)
			redirect(site_url('siswa-kelas'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add(' Siswa Kelas ', site_url('siswa-kelas'));
		$this->breadcrumb->add('Edit ', site_url('siswa-kelas/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_siswa_kelas->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_siswa_kelas','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));
		$id_kelas       = $this->format_data->string($this->input->post('id_kelas',TRUE));
		$id_siswa       = $this->format_data->string($this->input->post('id_siswa',TRUE));
		$id_tahun_ajaran       = $this->format_data->string($this->input->post('id_tahun_ajaran',TRUE));

		$this->model_siswa_kelas->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('siswa-kelas/edit/'.$id));
        }
	    else
	    {
	    	// $cek_nama = $this->model_siswa_kelas->cek_exist_nama('master_siswa_kelas','id',$id);

	    	// if ($cek_nama > 0 )
	    	// {
	    	// 	$this->model_message->messege_proses('Id SIswa sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    	// 	redirect(site_url('siswa-kelas/edit/'.$id));
	    	// }
	    	// else
	    	// {
	    		$this->model_siswa_kelas->init_update();
	    		redirect(site_url('siswa-kelas'));
	    	// }
	    }
	}

}
