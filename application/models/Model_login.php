<?php
class Model_login extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','encryption');
        $this->load->model(array('model_message'));
        $this->mydb1 = $this->load->database('default',TRUE);
        

        //$this->mydb2 = $this->load->database('default2',TRUE);   
    }

    public function cek_username()
    {
        $username = $this->format_data->string($this->input->post('username',TRUE));

        $query = $this->mydb1->query("SELECT count(id_user) as exist FROM _users WHERE username = '$username'");
        $cek = $query->row();
        if (is_null($cek)==false) 
        {
            if($cek->exist == 1)
                return true;
            else
                return false;
        }   
        else
            return false;
    }

    public function cek_id_account()
    {
        $id_user=$this->model_hook->init_online_exist();

        $query = $this->mydb1->query("SELECT count(id_user) as exist FROM _users_account WHERE id_user = '$id_user'");
        $cek = $query->row();
        if (is_null($cek)==false) 
        {
            if($cek->exist == 1)
                return true;
            else
                return false;
        }   
        else
            return false;
    }

    public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function validation_field()
    {
        $this->model_message->conv_validasi_to_indonesia();
        $password          = $this->input->post('password');

        $this->session->set_flashdata('password', $password);

        $this->form_validation->set_rules('password', 'password', 'required');
    }

    public function validation_field_profile()
    {
        $this->model_message->conv_validasi_to_indonesia();
        $nama          = $this->input->post('nama');
        
        $this->form_validation->set_rules('nama', 'nama', 'required');
    }

    public function init_user_exist()
    {
        $username = $this->format_data->string($this->input->post('username',TRUE));
        $password = $this->format_data->string($this->input->post('password',TRUE));

        $hash_password=md5(sha1(strip_tags(addslashes(trim($password)))).'beye');
        $query = $this->mydb1->query("SELECT count(id_user) as exist FROM _users WHERE username = '$username' AND password ='$hash_password'");
        $cek = $query->row();
        if (is_null($cek)==false) 
        {
            if($cek->exist == 1)
                return true;
            else
                return false;
        }   
        else
            return false;
    }

    public function init_user_lock()
    {
        $username = $this->format_data->string($this->input->post('username',TRUE));
        $password = $this->format_data->string($this->input->post('password',TRUE));
        $hash_password=md5(sha1(strip_tags(addslashes(trim($password)))).'beye');
        
        $query = $this->mydb1->query("SELECT count(id_user) as exist_lock FROM _users WHERE username = '$username' AND password ='$hash_password' AND id_status = '1'");
        $cek = $query->row();
        if(is_null($cek)==false)
        {
            if($cek->exist_lock == 1)
                return true;
            else
                return false;
        }   
        else
            return false;  
    }

    public function create_session()
    {
    	date_default_timezone_set('Asia/Jakarta');
        $session_date     	= gmdate('Y-m-d H:i:s', time()+60*60*7);
        $time_session 		= date("c");
        $session_value		= md5($time_session);

        $browser 			= $_SERVER['HTTP_USER_AGENT'];
		$ip         		= $_SERVER['REMOTE_ADDR'];

        $username = $this->format_data->string($this->input->post('username',TRUE));
        $password = $this->format_data->string($this->input->post('password',TRUE));

        $hash_password=md5(sha1(strip_tags(addslashes(trim($password)))).'beye');
        
        $query = $this->mydb1->query("SELECT id_user FROM _users WHERE username = '$username' AND password = '$hash_password' AND id_status = '1' ");
        $cek = $query->row();
        if(is_null($cek)==FALSE)
        {      
            $id_user = $cek->id_user;
            

            
            if (is_null($session_value) == FALSE)
            $this->session->set_userdata('system_value', $session_value);
            $this->mydb1->query("update _session set id_status = '2' where id_user = '$id_user' and username = '$username' and id_status = '1' ");  

            
            $max=$this->max_session_login('id_session');
            if($max == 0) 
            {
                $id_session = 1;
            }
            else
            {
                $id_session = $max+1;
            }    

            $this->mydb1->query("insert into _session values ('$id_session','$id_user', '$username','$session_value', '$session_date', '$ip', '$browser', '1')");
            $this->mydb1->query("DELETE From _lock where id_user='$id_user'");
        }   

        return true;
    }

    public function max_session_login($field)
    {
        $query = $this->mydb1->query("SELECT count(".$field.") as exist FROM _session");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function destroy_login()
    {
        $id_user=$this->model_hook->init_online_exist();
        $this->mydb1->query("update _session set id_status = '2' where id_user = '$id_user'");   
    }

    public function init_save()
    {
        
        $id_user        = $this->model_hook->init_profile_user()->id_user;
        $password       = $this->format_data->string($this->input->post('password',TRUE));

        $hash_password  = md5(sha1(strip_tags(addslashes(trim($password)))).'beye');

        $encrypt_password  =   $this->encryption->encrypt($password);

        $url='';

        

        $this->mydb1->trans_start();
        $this->mydb1->set('password',$hash_password);
        $this->mydb1->where('id_user',$id_user);
        $this->mydb1->update('_users');
        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            $this->update_password($id_user);
            $this->model_message->messege_proses('Password Telah diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }         
    }

    public function update_password($iduser)
    {
        $id_user = $iduser;
        $max=$this->id_max('id','generator_pass');
            if($max == 0) 
                $id = 1;
            else
                $id = $max+1;

        $created_time     =gmdate('Y-m-d H:i:s', time()+60*60*7);

        $password          = $this->format_data->string($this->input->post('password',TRUE));
        $encrypt_password  =   $this->encryption->encrypt($password);

        $this->mydb1->trans_start();

        $this->mydb1->set('id',$id);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->set('value',$encrypt_password);
        $this->mydb1->set('created_date',$created_time);
        $this->mydb1->insert('generator_pass');
        
        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            //$this->model_message->messege_proses('Password Telah diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_update()
    {
        $id_user    = $this->model_hook->init_profile_user()->id_user;
        $nama       = $this->input->post('nama',TRUE);
        $email      = $this->input->post('email',TRUE);
        $telp       = $this->input->post('telepon',TRUE);
        $alamat     = nl2br($this->input->post('alamat',TRUE));
        $url='';

        $this->mydb1->trans_start();

        $this->mydb1->set('full_name',$nama);
        $this->mydb1->set('telp',$telp);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->where('id_user',$id_user);
        $this->mydb1->update('_users_account');
        
        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            $this->update_email($id_user,$email);
            $this->model_message->messege_proses('Data Telah diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }

    public function init_create()
    {
        $url='';
        $id_user    = $this->model_hook->init_profile_user()->id_user;
        $nama       = $this->input->post('nama',TRUE);
        $email      = $this->input->post('email',TRUE);
        $telp       = $this->input->post('telepon',TRUE);
        $alamat     = $this->input->post('alamat',TRUE);

        $this->mydb1->trans_start();

        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->set('full_name',$nama);
        $this->mydb1->set('telp',$telp);
        $this->mydb1->set('alamat',$alamat);
        $this->mydb1->insert('_users_account');
        
        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            $this->update_email($id_user,$email);
            $this->model_message->messege_proses('Data Telah diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }


    public function update_email($id_user,$email)
    {
        $this->mydb1->trans_start();

        $this->mydb1->set('email',$email);
        $this->mydb1->where('id_user',$id_user);
        $this->mydb1->update('_users');
        
        $this->mydb1->trans_complete();

        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            $this->error();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            return TRUE;
        }
    }


    public function _lock_id($username)
    {
        $query = $this->mydb1->query("SELECT id_user as exist FROM _users where username='$username'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function _count_lock($id_user)
    {
        $query = $this->mydb1->query("SELECT count(id_user) as exist FROM _lock where id_user='$id_user'");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function set_lock()
    {
        $query = $this->mydb1->query("SELECT wrong_password as exist FROM _maintenance");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function _lock()
    {
       $session_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $browser            = $_SERVER['HTTP_USER_AGENT'];
        $ip                 = $_SERVER['REMOTE_ADDR'];

        $username = $this->format_data->string($this->input->post('username',TRUE));

        $id_user  = $this->_lock_id($username);
        $ct_lock  = $this->_count_lock($id_user);
        $set_lock  = $this->set_lock();

        
        if ($id_user!=0)
        {
            $this->mydb1->trans_start();

            $this->mydb1->set('id_user',$id_user);
            $this->mydb1->set('created_date',$session_date);
            $this->mydb1->set('ip',$ip);
            $this->mydb1->set('browser',$browser);
            $this->mydb1->insert('_lock');
            
            $this->mydb1->trans_complete();

            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                $this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->model_message->messege_proses('Password Telah diperbarui.','delete',$url,'fa-check-square-o','success');
                $this->update_lock($ct_lock,$set_lock,$id_user);
                return TRUE;
            }
        }

    }

    public function update_lock($ct_lock,$set_lock,$id_user)
    {
        if ($ct_lock>=$set_lock)
        {
            $this->mydb1->trans_start();

            $this->mydb1->set('id_status','3');
            $this->mydb1->where('id_user',$id_user);
            $this->mydb1->update('_users');
            
            $this->mydb1->trans_complete();

            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                $this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->model_message->messege_proses('Password Telah diperbarui.','delete',$url,'fa-check-square-o','success');
                return TRUE;
            }
        }
    }

}