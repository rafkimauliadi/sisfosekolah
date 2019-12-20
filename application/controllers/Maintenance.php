<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_maintenance','model_message','model_combo'));
        $this->load->library(array('form_validation'));
    }

	

	public function index()
	{
		$ct = $this->model_maintenance->status_site();

		if ($ct == "online")
		{
			$this->model_maintenance->init_offline();
			redirect(site_url('privilege'));
		}
		else
		{
			$this->model_maintenance->init_online();
			redirect(site_url('privilege'));
		}
	}

	
}
