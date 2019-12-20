<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobil extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mobil'));
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
		$this->breadcrumb->add('Mobil ', site_url('mobil'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();


		$data['data'] 		= $this->model_mobil->get_data_mobil();


		$this->templates('mod_master_mobil','index',$data);
	}

	public function save()
	{
		$this->model_mobil->save_mobil();
	}

	public function delete()
	{
		$this->model_mobil->delete_mobil();
	}

	public function get_mobil()
	{
		header("Content-type:application/json");
		$data_mobil = $this->model_mobil->get_mobil();
		echo json_encode($data_mobil);
	}

	// public function list()
	// {
	// 	header("Content-type:application/json");
	// 	$data_mobil = $this->model_mobil->get_list_mobil();
	// 	echo json_encode($data_mobil);
	// }

	public function edit()
	{
		$this->model_mobil->edit_mobil();
	}
}
