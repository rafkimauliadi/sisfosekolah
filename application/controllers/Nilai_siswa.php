<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_siswa extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
		$this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_nilai_siswa','model_message','model_combo_r','model_jadwal_pelajaran'));
     
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

		$this->session->set_flashdata('title', 'Nilai Siswa');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Nilai Siswa ', site_url('nilai-siswa'));
		$this->breadcrumb->add('index ', site_url('nilai-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_nilai_siswa->get_view($offset,$this->perpage);
		$data['search']		= $this->model_nilai_siswa->search();
		$data['pagination'] = $this->model_message->pagination(site_url('nilai-siswa/index'),$this->model_nilai_siswa->num_rows(),$this->perpage);
		$data['offset'] 	= $offset;

		$this->templates('nilai_siswa/siswa','index',$data);
	}

	public function search($offset=NULL)
	{

		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		$this->session->set_flashdata('title', 'Nilai Siswa');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Nilai Siswa', site_url('nilai-siswa'));
		$this->breadcrumb->add('index ', site_url('nilai-siswa'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();



		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();


		$data['data'] 		= $this->model_nilai_siswa->get_view($offset,$this->perpage);
		$data['search']		= $this->model_nilai_siswa->search();
		$data['search2']		= $this->model_nilai_siswa->search2();
		$data['pagination'] = '';
		$data['offset'] 	= $offset;


		$this->templates('nilai_siswa/siswa','index',$data);
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
		$this->breadcrumb->add('Nilai Siswa ', site_url('nilai-siswa'));
		$this->breadcrumb->add('Add ', site_url('nilai-siswa/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('nilai_siswa/siswa','add',$data);
  }
  
  public function save()
	{
		$this->model_nilai_siswa->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('nilai-siswa/add/'));         
        } 
	    else 
	    {
	    	$this->model_nilai_siswa->init_save();
	    	redirect(site_url('nilai-siswa'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_nilai_siswa->init_delete();
	    redirect(site_url('nilai_siswa'));
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

		$exist	= $this->model_nilai_siswa->exist_id($id);
		if ($exist==0)
			redirect(site_url('nilai-siswa'));
		if ($id==NULL)
			redirect(site_url('nilai-siswa'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Nilai siswa', site_url('nilai-siswa'));
		$this->breadcrumb->add('Edit ', site_url('nilai-siswa/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_nilai_siswa->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('nilai_siswa/siswa','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id       = $this->format_data->string($this->input->post('id',TRUE));

    $id_kelas      	= $this->format_data->string($this->input->post('id_kelas',TRUE));
    $id_mapel      	= $this->format_data->string($this->input->post('id_mapel',TRUE));
    $id_guru     	= $this->format_data->string($this->input->post('id_guru',TRUE));
    $nilai_siswa     	= $this->format_data->string($this->input->post('nilai_siswa',TRUE));
    $id_siswa_kelas     	= $this->format_data->string($this->input->post('id_siswa_kelas',TRUE));
    $id_tahun_ajaran     	= $this->format_data->string($this->input->post('id_tahun_ajaran',TRUE));

		$this->model_nilai_siswa->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('nilai-siswa/edit/'.$id));
        }
	    else
	    {
	    	// $cek_nama = $this->model_nilai_siswa->cek_exist_nama('master_nilai','id_kelas','id',$id_kelas,$id);

	    	// if ($cek_nama > 0 )
	    	// {
	    	// 	$this->model_message->messege_proses('Master Nilai sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    	// 	redirect(site_url('nilai-siswa/edit/'.$id));
	    	// }
	    	// else
	    	// {
	    		$this->model_nilai_siswa->init_update();
	    		redirect(site_url('nilai-siswa'));
	    	// }
	    }
	}


}
