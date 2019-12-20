<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	private $perpage = 5;

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_home','model_message'));
    }
    
    private function home($folder,$list,$data=array())
    {
        $this->load->view('front_end/'.$folder.'/'.$list,$data);
    }
	 
	private function templates($folder,$list,$data=array())
    {
		$this->load->view('front_end/header',$data);
		$this->load->view('front_end/menu');
		$this->load->view('front_end/'.$folder.'/'.$list);
		$this->load->view('front_end/sidebar');
		$this->load->view('front_end/footer');
	}
	
	
	
	public function index()
	{
		$this->init_view();
	}
	
	private function init_view($offset=NULL)
	{
		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);
		
	    $data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();
		
		$data['tags']           = $this->model_home->init_tags();
		$data['init_update']    = $this->model_home->init_terbaru($offset,$this->perpage);
		$data['pagination'] = $this->model_message->pagination(site_url('home/index'),$this->model_home->num_rows(),$this->perpage);
		
	    $this->home('home','index',$data);
	}
	
	
	public function read()
	{
	    $id = abs($this->format_data->string($this->uri->segment(3,0)));
	    
	    $cek = $this->model_home->exist_content($id);
	    if ($cek=="")
	        redirect(site_url());

	    $this->model_home->set_hits($id,'content');
	    $this->model_home->hits_content($id,'id_content','content');
	    $data['details']    	= $this->model_home->init_details();
	    $data['meta_keyword']	= $this->model_home->meta_keyword_content($data['details']);

	    $data['title']			= $data['details']->row()->title;
	    
	    $data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();
		
		$this->templates('details','index',$data);
	}

	public function search($offset=NULL)
	{
		if(is_null($offset)==TRUE) $offset  = $this->uri->segment(3,0);

		if (!$_POST =="")
            $data['search'] = $this->format_data->string($this->input->post('search'));
        else
            $data['search'] = $this->session->flashdata('search');

        if ($data['search']=="")
        {
        	$this->model_message->messege_proses('Periksa kembali keyword pencarian anda.','delete',$url,'fa-check-square-o','info');
        	redirect(site_url());
        }

        $this->session->set_flashdata('search',$data['search']);

        $data['title']			= $data['search'] .' - Pencarian Data/dokument/content';
       
       	$data['meta_keyword']='';
		
	    $data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['init_searching']	= $this->model_home->init_searching($data['search'],$offset,$this->perpage);
		$this->model_visitor->set_keyword($data['search']);
		$data['pagination'] = $this->model_message->pagination(site_url('home/search'),$this->model_home->num_rows_search($data['search']),$this->perpage);
		
	    $this->templates('searching','index',$data);
	}
	
	public function category($id_category,$offset=NULL)
	{
	    if(is_null($offset)==TRUE) $offset  = $this->uri->segment(4,0);
		
	    $id_category = abs($this->uri->segment(3,0));
		
		$cek = $this->model_home->exist_category();
	    if ($cek=="")
	        redirect(site_url());
		
		$data['details']    	= $this->model_home->init_category();

        $data['title']			= $data['details']->row()->title;
       
       	$data['meta_keyword']   = $this->model_home->meta_keyword_category($data['details']);
		
	    $data['versi'] 		= $this->model_hook->versi();
		$data['identitas'] 	= $this->model_hook->identitas();

		$data['data']	= $this->model_home->init_recent_category($id_category,abs($offset),$this->perpage);
		$data['pagination'] = $this->model_message->pagination_sub(site_url('home/category/'),4,$this->model_home->num_rows_category($id_category),$this->perpage,'/'.$id_category.'/');
		
		$this->templates('category','index',$data);
	}
}
