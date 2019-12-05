<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_spp_kelas extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_kelas','model_bk','model_legalisir','model_pembayaran_spp_kelas'));
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

		$this->session->set_flashdata('title', 'Pembayaran SPP Kelas');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Pembayaran SPP ', site_url('pembayaran-spp-kelas'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_pembayaran_spp_kelas->get_list_data();
		// $data['data'] 		= $this->model_pembayaran_spp_kelas->get_list_bk($this->model_hook->init_profile_user()->username);


		$this->templates('mod_pembayaran_spp_kelas','index',$data);
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
		$this->breadcrumb->add('Pembayaran SPP ', site_url('pembayaran-spp-kelas'));
		$this->breadcrumb->add('Add ', site_url('pembayaran-spp-kelas/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_pembayaran_spp_kelas','add',$data);
  }
  
  public function save()
	{
		$this->model_pembayaran_spp_kelas->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('pembayaran-spp-kelas/add/'));         
        } 
	    else 
	    {
	    	$this->model_pembayaran_spp_kelas->init_save();
	    	redirect(site_url('pembayaran-spp-kelas'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_pembayaran_spp_kelas->init_delete();
	    redirect(site_url('pembayaran_spp_kelas'));
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

		$exist	= $this->model_pembayaran_spp_kelas->exist_id($id);
		if ($exist==0)
			redirect(site_url('pembayaran-spp-kelas'));
		if ($id==NULL)
			redirect(site_url('pembayaran-spp-kelas'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Pembayaran SPP ', site_url('pembayaran-spp-kelas'));
		$this->breadcrumb->add('Edit ', site_url('pembayaran-spp-kelas/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_pembayaran_spp_kelas->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_pembayaran_spp_kelas','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id 					= $this->format_data->string($this->input->post('id',TRUE));
	    $id_kelas 				= $this->format_data->string($this->input->post('id_kelas',TRUE));
	    $id_guru				= $this->format_data->string($this->input->post('id_guru',TRUE));
	    $bulan					= $this->format_data->string($this->input->post('bulan',TRUE));
	    $tahun					= $this->format_data->string($this->input->post('tahun',TRUE));
	    $jml_bayar				= $this->format_data->string($this->input->post('jml_bayar',TRUE));
	    $jml_keseluruhan		= $this->format_data->string($this->input->post('jml_keseluruhan',TRUE));
	    $id_status_spp_kelas	= $this->format_data->string($this->input->post('id_status_spp_kelas',TRUE));
	    $created_modified		= $this->format_data->string($this->input->post('created_modified',TRUE));

		$this->model_pembayaran_spp_kelas->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('pembayaran-spp-kelas/edit/'.$id));
        }
	    else
	    {
	    	$this->model_pembayaran_spp_kelas->init_update();
	    	redirect(site_url('pembayaran-spp-kelas'));
	    }
	}

	public function cari_siswa()
	{
		// Set header type konten.
		header("Content-Type: application/json; charset=UTF-8");
		$query = $_GET["query"];

		$result	= $this->model_pembayaran_spp_kelas->cari_siswa($query);

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
		  	$result = $this->model_pembayaran_spp_kelas->search_blog($_GET['term']);
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
