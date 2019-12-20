<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jadwal_pelajaran extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_combo_r','model_supir','model_instansi','model_jadwal_pelajaran'));
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

		$this->session->set_flashdata('title', 'Master Jadwal Pelajaran');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Jadwal ', site_url('Master-jadwal-pelajaran'));
		$this->breadcrumb->add('index ', site_url('Master-jadwal-pelajaran'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		// $data['data'] 		= $this->model_jadwal_pelajaran->get_data_jadwal_pelajaran();

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['data'] 		= $this->model_jadwal_pelajaran->get_view($offset,$this->perpage);
		$data['search']		= $this->model_jadwal_pelajaran->search();
		// $data['search2']		= $this->model_jadwal_pelajaran->search();
		// $data['pagination'] = $this->model_message->pagination(site_url('Master-jadwal-pelajaran/index'),$this->model_jadwal_pelajaran->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;

		$this->templates('mod_master_jadwal_pelajaran','index',$data);
	}


	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Data Jadwal Pelajaran');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Jadwal Pelajaran ', site_url('Master-jadwal-pelajaran'));
		$this->breadcrumb->add('index ', site_url('Master-jadwal-pelajaran'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_jadwal_pelajaran->get_view($offset,$this->perpage);
		$data['search']		= $this->model_jadwal_pelajaran->search();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;
		// $data['search2']		= $this->model_jadwal_pelajaran->search2();

		$this->templates('mod_master_jadwal_pelajaran','index',$data);
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
		$this->breadcrumb->add('Master Jadwal Pelajaran ', site_url('Master-jadwal-pelajaran'));
		$this->breadcrumb->add('Add ', site_url('Master-jadwal-pelajaran/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_master_jadwal_pelajaran','add',$data);
  }
  
  public function save()
	{
		$this->model_jadwal_pelajaran->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('Master-jadwal-pelajaran/add/'));         
        } 
	    else 
	    {
	    	$this->model_jadwal_pelajaran->init_save();
	    	redirect(site_url('Master-jadwal-pelajaran'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_jadwal_pelajaran->init_delete();
	    redirect(site_url('Master_jadwal_pelajaran'));
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

		$exist	= $this->model_jadwal_pelajaran->exist_id($id);
		if ($exist==0)
			redirect(site_url('Master-jadwal-pelajaran'));
		if ($id==NULL)
			redirect(site_url('Master-jadwal-pelajaran'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Master Jadwal Pelajaran ', site_url('Master-jadwal-pelajaran'));
		$this->breadcrumb->add('Edit ', site_url('Master-jadwal-pelajaran/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_jadwal_pelajaran->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_master_jadwal_pelajaran','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));

    $hari      	= $this->format_data->string($this->input->post('hari',TRUE));
    $id_jam      	= $this->format_data->string($this->input->post('id_jam',TRUE));
    $id_kelas     	= $this->format_data->string($this->input->post('id_kelas',TRUE));
    $id_mapel_kelas     	= $this->format_data->string($this->input->post('id_mapel_kelas',TRUE));
    $absen1     	= $this->format_data->string($this->input->post('absen1',TRUE));
    $absen2     	= $this->format_data->string($this->input->post('absen2',TRUE));
    $nis     	= $this->format_data->string($this->input->post('nis',TRUE));
    $keterangan_materi     	= $this->format_data->string($this->input->post('keterangan_materi',TRUE));

		$this->model_jadwal_pelajaran->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('Master-jadwal-pelajaran/edit/'.$id));
        }
	    else
	    {
	    	// $cek_nama = $this->model_jadwal_pelajaran->cek_exist_nama('jadwal_pelajaran','tanda_guru','id',$tanda_guru,$id);

	    	// if ($cek_nama > 0 )
	    	// {
	    	// 	$this->model_message->messege_proses('Jadwal sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    	// 	redirect(site_url('Master-jadwal-pelajaran/edit/'.$id));
	    	// }
	    	// else
	    	// {
	    		$this->model_jadwal_pelajaran->init_update();
	    		redirect(site_url('Master-jadwal-pelajaran'));
	    	// }
	    }
	}

}
