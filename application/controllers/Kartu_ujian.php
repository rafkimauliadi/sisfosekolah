<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartu_ujian extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_kelas','model_bk','model_legalisir','model_kartu_ujian','model_combo_r'));
        $this->load->library(array('form_validation','encryption'));
    }

	private function templates($folder,$list,$data=array())
    {
		$this->load->view('backend/header',$data);
		$this->load->view('backend/sidebar');
		$this->load->view('com_admin/'.$folder.'/'.$list);
		$this->load->view('backend/footer');
	}

	private function templates2($folder,$list,$data=array())
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

	private function init_view()
	{

		$this->session->set_flashdata('title', 'Kartu Ujian');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Cetak kartu Ujian ', site_url('kartu-ujian'));
		// $this->breadcrumb->add('Add ', site_url('kartu-ujian/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_kartu_ujian','index',$data);

		// if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		// $this->session->set_flashdata('title', 'Pembayaran SPP Kelas');
		// $this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		// $this->breadcrumb->add('Cetak Kartu Ujian ', site_url('kartu-ujian'));

		// $data['versi'] 		= $this->model_hook->versi();
		// $data['identitas'] 	= $this->model_hook->identitas();

		// $data['data'] 		= $this->model_pembayaran_spp_kelas->get_list_data();
		// // $data['data'] 		= $this->model_pembayaran_spp_kelas->get_list_bk($this->model_hook->init_profile_user()->username);


		// $this->templates('mod_kartu_ujian','index',$data);

		
	}

	public function get_autocomplete(){

		if (isset($_GET['term'])) {
		  	$result = $this->model_kartu_ujian->search_blog($_GET['term']);
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

  public function detail()
	{
		if(($this->input->post('save'))==NULL)
			$this->index();
		else
			$this->detailtahun();
	}


public function detailtahun()
	{

		// $id = $this->format_data->string($this->uri->segment(3,0));


		$nis		= $this->input->post('nis');
		$tahun		= $this->input->post('tahun');
		$data['detail2']	= $this->model_kartu_ujian->get_data_detail2($tahun);
		$data['detail']	= $this->model_kartu_ujian->get_data_detail($nis);

		if ($nis==NULL)
			redirect(site_url('kartu-ujian/detail'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$this->templates2('mod_kartu_ujian','detail',$data);
		// $this->templates('mod_kartu_ujian','view_print',$data);
		// $this->load->view('mod_kartu_ujian/detail', $data);
  }

  public function cetak()
	{
		$this->init_print();
	}

	public function init_print()
	{

		// $id = $this->format_data->string($this->uri->segment(3,0));


		$nis		= $this->input->post('nis');
		$tahun		= $this->input->post('tahun');
		$data['detail2']	= $this->model_kartu_ujian->get_data_detail2($tahun);
		$data['detail']	= $this->model_kartu_ujian->get_data_detail($nis);

		if ($nis==NULL)
			redirect(site_url('kartu-ujian/index'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$this->templates2('mod_kartu_ujian','cetak',$data);
		// $this->templates('mod_kartu_ujian','view_print',$data);
		// $this->load->view('mod_kartu_ujian/detail', $data);
  }


}
