<?php
class Model_hook extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->mydb1 = $this->load->database('default',TRUE);
        //$this->mydb2 = $this->load->database('default2',TRUE);
        $this->create_directory_user();
    }

    public function versi()
    {
    	return $data = $this->mydb1->query("SELECT 
		    									title,
		                                        description,
		                                        created_date,
		                                        date_format(created_date, '%Y') as tahun
		                                        
		                                    FROM
		                                    	_versi
		                                    order by id_versi desc
		                                    LIMIT 1		                                    
                                ");
    }

    public function identitas()
    {
    	return $data = $this->mydb1->query("SELECT 
		    									MAX(id_contact) as id_contact,
		    									title,
		    									title_footer,
		    									display_header,
		                                        email,
		                                        alamat,
		                                        keyword,
		                                        telp,
		                                        fax,
		                                        keterangan,
		                                        created_date
		                                    FROM
		                                    	hubungi_kami
                                ");
    }

    public function info_admin()
    {
    	return $data = $this->mydb1->query("SELECT 
		    									title,
		                                        pesan,
		                                        created_date
		                                    FROM
		                                    	info_admin
		                                    WHERE
		                                    	id_status='4'
		                                    order by no_urut asc
                                ");
    }

    public function login_exists()
	{
		$session_value=$this->session->userdata('system_value');
		$query = $this->mydb1->query("SELECT id_user FROM _session WHERE session_value = '$session_value' and id_status='1'");
        $cek = $query->row();
        if (isset($cek))
        	return true;
		return false;
	}
    
	public function akses_bypass()
    {
		$control=$this->router->fetch_class();
	    $fungsi=$this->router->fetch_method();

	    $module=$this->mydb1->query("SELECT count(id_white) as ct_module FROM _white_list WHERE _controller = '$control' and _function='$fungsi' and id_status='1'");
	    $cek_module=$module->row();
	    	if (isset($cek_module))  
	    	{
					if ($cek_module->ct_module>0)
						return true;
				}
				else 
					return false;
		return false;
	}

	public function group_akses_modul()
    {
		$session_value=$this->session->userdata('system_value');
		$control=$this->router->fetch_class();
	    $fungsi=$this->router->fetch_method();

			$id_group=$this->ambil_field_group('id_group');

			$module=$this->mydb1->query("SELECT count(id_module) as ct_module FROM _module WHERE _controller = '$control' and _function='$fungsi' and id_status='1' and FIND_IN_SET($id_group,id_group)");
			$cek_module=$module->row();

				if (isset($cek_module))  {
					if ($cek_module->ct_module>0)
						return true;
				}
				else 
					return false;
		return false;
	}

	public function ambil_field_group($field)
    {
		$id_user=$this->ambil_field_session('id_user');
		$query = $this->mydb1->query("SELECT ".$field." FROM _users WHERE id_user = '$id_user' and id_status='1'");
		$row=$query->row();
			if (isset($row))
				return $row->$field;
		return 0;
	}

	public function ambil_field_session($field)
    {
		$session_value=$this->session->userdata('system_value');
		$query = $this->mydb1->query("SELECT ".$field." FROM _session WHERE session_value = '$session_value' and id_status='1'");
		$row=$query->row();
			if (isset($row))
				return $row->$field;
		return 0;
	}

	public function init_online_exist()
    {
		$session_value=$this->session->userdata('system_value');
		$query = $this->mydb1->query("SELECT id_user FROM _session WHERE session_value = '$session_value' and id_status='1'");
        $cek = $query->row();
        $id_user=$cek->id_user;   
        return $id_user; 
	}

	public function init_profile_user()
    {
		$id_user=$this->init_online_exist();
		$query = $this->mydb1->query("SELECT 
											_users.id_user,
											_users.id_group,
											_users.id_instansi,
											_users.email,
											_users.username,
                                            _users_account.id_user as id_user_account,
                                            _users_account.full_name,
                                            _users_account.alamat,
                                            _users_account.telp
                                    FROM 
                                            _users

                                            left join _users_account on (_users_account.id_user=_users.id_user)
                                    WHERE 
                                            _users.id_user = '$id_user'");
    	$data = $query->row();
    	return $data;
	}


	public function create_directory_user()
	{
	    
		$tahun  = date('Y');
        $bulan  = date('m');

        
        $directory_2  = 'images';
        $directory_3  = 'images/'.$tahun;
        $directory_4  = 'images/'.$tahun.'/'.$bulan;
        $directory_5  = 'images/'.$tahun.'/'.$bulan.'/thumbnails';

        if (is_dir($directory_2)===false)
            mkdir($directory_2);
        if (is_dir($directory_3)===false)
            mkdir($directory_3);
        if (is_dir($directory_4)===false)
            mkdir($directory_4);
        if (is_dir($directory_5)===false)
            mkdir($directory_5);
	}

	public function remove_file($directory,$dir_url,$data_file)
	{
		if (!$data_file == "")
        {
            $foto       = $directory.'/'.$dir_url.'/'.$data_file;
            if(file_exists($foto)) 
            {
                unlink($foto);
            }
        }
	}

	public function objek($tabel,$field,$field2,$value)
    {
        $query = $this->mydb1->query("SELECT $field2 as exist FROM ".$tabel." where ".$field."='$value'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function images($directory,$year,$month,$ct,$ct_exist)
    {
        if (!$ct_exist == "")
        {
            $foto       = $directory.'/'.$year.'/'.$month.'/'.$ct;
            if(file_exists($foto)) 
            {
                unlink($foto);
            }
        }
    }

    public function thumbnail($directory,$year,$month,$ct,$ct_exist)
    {
        if (!$ct_exist == "")
        {
            $thumbnail  = $directory.'/'.$year.'/'.$month.'/'.$ct;
            if(file_exists($thumbnail))
            {
                unlink($thumbnail);
            }
        }
    }
    
    public function init_tahun_akademik_aktif()
    {
		$query = $this->mydb1->query("SELECT 
											tahun_akademik
                                    FROM 
                                            _kampus_tahun_akademik
                                    WHERE 
                                            id_status= '1'");
    	$data = $query->row();
    	return $data;
	}

}