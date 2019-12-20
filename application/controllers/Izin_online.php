<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Izin_online extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_kelas','model_bk','model_legalisir','model_izin'));
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

		$this->session->set_flashdata('title', 'Izin Online');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Izin Online ', site_url('izin-online'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_izin->get_list_izin();
		// $data['data'] 		= $this->model_izin->get_list_bk($this->model_hook->init_profile_user()->username);


		$this->templates('mod_izin_online','index',$data);
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
		$this->breadcrumb->add('Izin Online ', site_url('izin-online'));
		$this->breadcrumb->add('Add ', site_url('izin-online/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_izin_online','add',$data);
  }
  
  public function save()
	{
		$this->model_izin->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('izin-online/add/'));         
        } 
	    else 
	    {
	    	$this->model_izin->init_save();
	    	redirect(site_url('izin-online'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_izin->init_delete();
	    redirect(site_url('izin_online'));
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

		$exist	= $this->model_izin->exist_id($id);
		if ($exist==0)
			redirect(site_url('izin-online'));
		if ($id==NULL)
			redirect(site_url('izin-online'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Izin Online ', site_url('izin-online'));
		$this->breadcrumb->add('Edit ', site_url('izin-online/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_izin->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_izin_online','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id 			= $this->format_data->string($this->input->post('id',TRUE));
	    $nis 			= $this->format_data->string($this->input->post('nis',TRUE));
	    $tgl_izin		= $this->format_data->string($this->input->post('tgl_izin',TRUE));
	    $alasan			= $this->format_data->string($this->input->post('alasan',TRUE));

		$this->model_izin->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('izin-online/edit/'.$id));
        }
	    else
	    {
	    	$this->model_izin->init_update();
	    	redirect(site_url('izin-online'));
	    }
	}

	public function cari_siswa()
	{
		// Set header type konten.
		header("Content-Type: application/json; charset=UTF-8");
		$query = $_GET["query"];

		$result	= $this->model_izin->cari_siswa($query);

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

	public function get_autocomplete(){

		if (isset($_GET['term'])) {
		  	$result = $this->model_legalisir->search_blog($_GET['term']);
		   	if (count($result) > 0) {
		    foreach ($result as $row)
		     	$arr_result[] = array(
					'label'			=> $row->nis,
					'nama_lengkap'	=> $row->nama_lengkap,
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

}
