<?php
function authentication()
{
	$CI =& get_instance();
	date_default_timezone_set('Asia/Jakarta');
    $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);
	
	//Memuat konfigurasi dari database kefalam konfigurasi global CI
	if ($CI->model_hook->akses_bypass()==false) 
	{
		if ($CI->model_hook->login_exists()==true)
		{
			if ($CI->model_hook->group_akses_modul()==false)
			show_404();
		}
		else 
			show_404();		
	}
	else
	{
	    $CI->model_visitor->set_counter();
	}
}