<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supir extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir'));
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

		$this->session->set_flashdata('title', 'User');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Supir ', site_url('supir'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_supir->get_data_supir();


		$this->templates('mod_master_driver','index',$data);
	}

	public function save()
	{
		$this->model_supir->save_supir();
	}

	public function delete()
	{
		$this->model_supir->delete_supir();
	}

	public function get_supir()
	{
		header("Content-type:application/json");
		$data_supir = $this->model_supir->get_supir();
		echo json_encode($data_supir);
	}

	// public function list()
	// {
	// 	header("Content-type:application/json");
	// 	$data_supir = $this->model_supir->get_list_supir();
	// 	echo json_encode($data_supir);
	// }

	public function edit()
	{
		$this->model_supir->edit_supir();
	}
}
