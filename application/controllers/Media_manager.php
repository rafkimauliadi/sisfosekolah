<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media_manager extends CI_Controller {	

	public function __construct()
	{
       	parent::__construct();        		        				
    }

	public function index()
	{
		$this->form_list();				
	}
	private function publish($view,$data = NULL)
	{
		$this->load->view(''.$view,$data);
	}
	//-----------------------------------------------------------------
	private function form_list()
	{
		$this->publish('com_admin/mod_filemanager/media_manager');

	}
	public function elfinder_connector()
	{
		// require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderConnector.class.php';
		// require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinder.class.php';
		// require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderVolumeDriver.class.php';
		// require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderVolumeLocalFileSystem.class.php';

		require_once $_SERVER['DOCUMENT_ROOT'].'/assets/lib/elFinder-2.1.49/php/autoload.php';
		$conn = new elFinderConnector(new elFinder(array(
		    'roots'=>array(
		        array(
		            'driver'=>'LocalFileSystem',
		            'path'=>$_SERVER['DOCUMENT_ROOT'].'/images/',
		            'URL'=>base_url('images').'/',
		            'uploadMaxSize'=> '1G',
		   //          'trashHash'     => 't1_Lw',                     // elFinder's hash of trash folder
					// 'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
					'uploadDeny'    => array('all'),                // All Mimetypes not allowed to upload
					'uploadAllow'   => array('image/x-ms-bmp', 'image/gif', 'image/jpeg', 'image/png', 'image/x-icon', 'text/plain'), // Mimetype `image` and `text/plain` allowed to upload
					'uploadOrder'   => array('deny', 'allow'),      // allowed Mimetype `image` and `text/plain` only
		        )
		    )
		)));
		$conn->run();
	}  


	// public function elfinder_connector()
	// {
	// 	require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderConnector.class.php';
	// 	require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinder.class.php';
	// 	require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderVolumeDriver.class.php';
	// 	require_once $_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/assets/lib/elfinder/php/elFinderVolumeLocalFileSystem.class.php';

	// 	$conn = new elFinderConnector(new elFinder(array(
	// 	    'roots'=>array(
	// 	        array(
	// 	            'driver'=>'LocalFileSystem',
	// 	            'path'=>$_SERVER['DOCUMENT_ROOT'].'/cakrawaladigital.com/images/',
	// 	            'URL'=>base_url('images').'/',
	// 	            'uploadMaxSize'=> '1G',
	// 	        )
	// 	    )
	// 	)));
	// 	$conn->run();
	// }    
}