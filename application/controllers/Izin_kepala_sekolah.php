<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_kepala_sekolah extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_kelas','model_bk','model_legalisir','model_izin_kepala_sekolah'));
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

		$this->session->set_flashdata('title', 'Izin Kepala Sekolah');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Izin Kepala Sekolah ', site_url('izin-kepala-sekolah'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_izin_kepala_sekolah->get_list_izin();
		// $data['data'] 		= $this->model_izin_kepala_sekolah->get_list_bk($this->model_hook->init_profile_user()->username);


		$this->templates('mod_izin_kepala_sekolah','index',$data);
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
		$this->breadcrumb->add('Izin Kepala Sekolah ', site_url('izin-kepala-sekolah'));
		$this->breadcrumb->add('Add ', site_url('izin-kepala-sekolah/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_izin_kepala_sekolah','add',$data);
  }
  
  public function save()
	{
		$this->model_izin_kepala_sekolah->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('izin-kepala-sekolah/add/'));         
        } 
	    else 
	    {
	    	$this->model_izin_kepala_sekolah->init_save();
	    	redirect(site_url('izin-kepala-sekolah'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_izin_kepala_sekolah->init_delete();
	    redirect(site_url('izin_kepala_sekolah'));
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

		$exist	= $this->model_izin_kepala_sekolah->exist_id($id);
		if ($exist==0)
			redirect(site_url('izin-kepala-sekolah'));
		if ($id==NULL)
			redirect(site_url('izin-kepala-sekolah'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Izin Kepala Sekolah ', site_url('izin-kepala-sekolah'));
		$this->breadcrumb->add('Edit ', site_url('izin-kepala-sekolah/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_izin_kepala_sekolah->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_izin_kepala_sekolah','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id 			= $this->format_data->string($this->input->post('id',TRUE));
	    $nis 			= $this->format_data->string($this->input->post('nis',TRUE));
	    $nip_guru		= $this->format_data->string($this->input->post('nip_guru',TRUE));
	    $tgl_izin		= $this->format_data->string($this->input->post('tgl_izin',TRUE));
	    $urusan			= $this->format_data->string($this->input->post('urusan',TRUE));
	    $status_izin	= $this->format_data->string($this->input->post('status_izin',TRUE));

		$this->model_izin_kepala_sekolah->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('izin-kepala-sekolah/edit/'.$id));
        }
	    else
	    {
	    	$cek_nama = $this->model_izin_kepala_sekolah->cek_exist_nama('izin_kepala_sekolah','nis','id',$nis,$id);

	    	if ($cek_nama > 0 )
	    	{
	    		$this->model_message->messege_proses('nama sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('izin-kepala-sekolah/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_izin_kepala_sekolah->init_update();
	    		redirect(site_url('izin-kepala-sekolah'));
	    	}
	    }
	}

	public function cari_siswa()
	{
		// Set header type konten.
		header("Content-Type: application/json; charset=UTF-8");
		$query = $_GET["query"];

		$result	= $this->model_izin_kepala_sekolah->cari_siswa($query);

		// Format bentuk data untuk autocomplete.
		foreach($result as $data) {
			$output['suggestions'][] = [
					'value' => $data['buah'],
					'buah'  => $data['buah']
			];
		}

		if (! empty($output)) {
			// Encode ke format JSON.
			echo json_encode($query);
		}else{
			// Encode ke format JSON.
			echo json_encode($result);
		}
	}

}
