<?php
/**
* 
*/
class Model_account extends CI_Model
{
	
	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','encryption','email');

        $this->mydb1 = $this->load->database('default',TRUE);
        $this->load->model(array('model_message','model_login'));

        //$this->mydb2 = $this->load->database('default2',TRUE);   
    }
    

    public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }


	public function init_user_exist()
	{
		$email = $this->format_data->string($this->input->post('email',TRUE));
        $query = $this->mydb1->query("SELECT count(id_user) as exist, id_user FROM _users WHERE email = '$email'");
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
		$email = $this->format_data->string($this->input->post('email',TRUE));
        $query = $this->mydb1->query("SELECT 
        									count(_users.id_user) as exist 
        								FROM 
        									_users 
        								WHERE 
        									_users.email = '$email'
        								and
        									_users.id_status='1'");
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

	public function get_id_user($email)
	{

		$query = $this->mydb1->query("SELECT 
        									_users.id_user as id_user,
        									count(_users.id_user) as exist,
        									_users.username as username
        								FROM 
        									_users 
        								WHERE 
        									_users.email = '$email'
        								and
        									_users.id_status='1'");
        $cek = $query->row();  
        return $cek; 
	}

	public function get_token_exist($email)
	{
        $query = $this->mydb1->query("SELECT 
        									count(_account_reset.id_user) as exist,
        									_account_reset.id_reset 
        								FROM 
        									_account_reset
        								WHERE 
        									_account_reset.email = '$email'
        								and
        									_account_reset.id_status='1'");
        $cek = $query->row();  
        return $cek; 
	}

	public function send_token()
	{
	    $url='';
		$email 			= $this->format_data->string($this->input->post('email',TRUE));
	    $id_status 		= 1;

	    date_default_timezone_set('Asia/Jakarta');
        $created_time     	= gmdate('Y-m-d H:i:s', time()+60*60*7);

	  	$cek = $this->get_id_user($email);
	  	$username = $cek->username;
	  	if ($cek->exist > 0)
	  	{
	  		$token = substr(sha1(rand().$created_time), 0, 35);

	  		$get_token_exist = $this->get_token_exist($email);

	  		if($get_token_exist->exist > 0)
	  		{
	  			$this->mydb1->query("UPDATE _account_reset set token ='$token',  created_date ='$created_time'  WHERE id_reset ='$get_token_exist->id_reset'");   
	  			$this->send_email($token,$email,$username);
	  		}
	  		else
	  		{
	  			$this->insert_token($token,$cek->id_user,$email,$created_time,$id_status,$username);
	  		}

	  	}
	  	else
	  	{
			$this->model_message->messege_proses('Email tidak diketahui.','delete',$url,'fa-check-square-o','success');
	  	}
	}

	public function insert_token($token,$id_user,$email,$created_time,$id_status,$username)
	{
		$this->mydb1->trans_start();

        $this->mydb1->set('token',$token);
        $this->mydb1->set('id_user',$id_user);
        $this->mydb1->set('email',$email);
        $this->mydb1->set('created_date',$created_time);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->insert('_account_reset');
        
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
            $this->send_email($token,$email,$username);
            return TRUE;
        }
	}
	
	public function send_email($token,$email,$username)
	{
	    $url = site_url('reset/account');
	    $url_process = $url.'/'.$token;
	    
	    $subject='Reset Password  ' .$email;
        $message = '<h4 align=\"center\">Hallo, Silahkan perbarui akun anda.</h4>
                <p><b>Username Anda : '.$username.'</b></p>
	              <p> Anda Akan Melakukan Reset Password, Klik Tautan Berikut : <a href="'.$url_process.'">'.$url_process.'</a>
	              <p>';
        
        $to=$email;
        
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
        
        // More headers
        $headers .= 'From: cakrawaladigital.com <noreply@cakrawaladigital.com>'."\r\n" . 'Reply-To: '.$email.' <'.$email.'>'."\r\n";
        $headers .= 'Cc: admin@cakrawaladigital.com' . "\r\n"; //untuk cc lebih dari satu tinggal kasih koma
        @mail($to,$subject,$message,$headers);
        if(@mail)
        {
            $this->model_message->messege_proses('Silahkan Cek Email untuk Mereset Password Anda. Cek Spam Jika tidak masuk ke pesan anda','delete',$url,'fa-check-square-o','success');	
        }
        else
        {
            $this->model_message->messege_proses('<br/>Terjadi Kesalahan,, Link Tidak Dapat Dikirim .','delete',$url,'fa-check-square-o','success');
        }
	}
	
	public function cek_token($token)
	{
	    $query = $this->mydb1->query("SELECT 
        									count(_account_reset.token) as exist,
        									_account_reset.id_user
        								FROM 
        									_account_reset
        								WHERE 
        									_account_reset.token = '$token'
        								and
        									_account_reset.id_status='1'");
        $cek = $query->row();  
        return $cek;
	}
	
	public function reset_password($id_user,$token)
	{
	    //$id_user        = $id_user;
	    $used_token     = $token;
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
            $this->model_login->update_password($id_user);
            $this->expired_token($used_token);
            $this->model_message->messege_proses('Password berhasil diperbarui...','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }  
	}
	
	public function expired_token($used_token)
	{
        $this->mydb1->trans_start();

        $this->mydb1->set('id_status','2');
        $this->mydb1->where('token',$used_token);
        $this->mydb1->update('_account_reset');
        
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

}

?>