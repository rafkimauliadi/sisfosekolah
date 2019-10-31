<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan_konseling extends CI_Controller {
	
	private $perpage = 10;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user','model_message','model_combo','model_supir','model_mapel','model_instansi','model_kelas','model_bk'));
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

		$this->session->set_flashdata('title', 'Bimbingan Konseling');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Bimbingan Konseling ', site_url('bimbingan-konseling'));

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data'] 		= $this->model_bk->get_list_bk();
		// $data['data'] 		= $this->model_bk->get_list_bk($this->model_hook->init_profile_user()->username);


		$this->templates('mod_bimbingan_konseling','index',$data);
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
		$this->breadcrumb->add('Bimbingan Konseling ', site_url('bimbingan-konseling'));
		$this->breadcrumb->add('Add ', site_url('bimbingan-konseling/add'));

		$data['cb_group'] 		= $this->model_combo->init_group();
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$this->templates('mod_bimbingan_konseling','add',$data);
  }
  
  public function save()
	{
		$this->model_bk->validation_field('simpan'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('bimbingan-konseling/add/'));         
        } 
	    else 
	    {
	    	$this->model_bk->init_save();
	    	redirect(site_url('bimbingan-konseling'));
	    }
  }
  
  public function delete()
	{
		$this->init_delete();
	}

	private function init_delete()
	{
		$this->model_bk->init_delete();
	    redirect(site_url('bimbingan_konseling'));
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

		$exist	= $this->model_bk->exist_id($id);
		if ($exist==0)
			redirect(site_url('bimbingan-konseling'));
		if ($id==NULL)
			redirect(site_url('bimbingan-konseling'));

		$this->session->set_flashdata('title', 'Edit');
		$this->breadcrumb->add('<i class="ace-icon fa fa-home home-icon"></i> Dashboard ', site_url('administrator'));
		$this->breadcrumb->add('Bimbingan Konseling ', site_url('bimbingan-konseling'));
		$this->breadcrumb->add('Edit ', site_url('bimbingan-konseling/edit'));

		
		$data['cb_parent']		= $this->model_instansi->cb_parent();

		$data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['details']	= $this->model_bk->get_data();

		//$data['cb_status']	= $this->model_combo->init_status($id);

		$this->templates('mod_bimbingan_konseling','edit',$data);
  }
  
  public function update()
	{
    $url='';
		$id 			= $this->format_data->string($this->input->post('id',TRUE));
	    $nis 			= $this->format_data->string($this->input->post('nis',TRUE));
	    $nip_guru		= $this->format_data->string($this->input->post('nip_guru',TRUE));
	    $date			= $this->format_data->string($this->input->post('date',TRUE));
	    $permasalahan	= $this->format_data->string($this->input->post('permasalahan',TRUE));
	    $penyelesaian	= $this->format_data->string($this->input->post('penyelesaian',TRUE));

		$this->model_bk->validation_field('edit'); 

	    if ($this->form_validation->run() == FALSE)
        {
            $this->model_message->validation_error();
            redirect(site_url('bimbingan-konseling/edit/'.$id));
        }
	    else
	    {
	    	$cek_nama = $this->model_bk->cek_exist_nama('bimbingan_konseling','nis','id',$nis,$id);

	    	if ($cek_nama > 0 )
	    	{
	    		$this->model_message->messege_proses('nama sudah digunakan.','delete',$url,'fa-check-square-o','warning');
	    		redirect(site_url('bimbingan-konseling/edit/'.$id));
	    	}
	    	else
	    	{
	    		$this->model_bk->init_update();
	    		redirect(site_url('bimbingan-konseling'));
	    	}
	    }
	}

	public function cari_siswa()
	{
		// Set header type konten.
		header("Content-Type: application/json; charset=UTF-8");
		$query = $_GET["query"];

		$result	= $this->model_bk->cari_siswa($query);

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
