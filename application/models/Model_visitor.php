<?php
/**
* 
*/
class Model_visitor extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
        $this->mydb1 = $this->load->database('default',TRUE);
	}


    public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function set_counter()
    {
        
        $_IP_SERVER = $_SERVER['SERVER_ADDR'];
        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
        $ip = $_IP_ADDRESS;
        $browser    = $_SERVER['HTTP_USER_AGENT'];
        
        date_default_timezone_set('Asia/Jakarta');
        $tanggal       = gmdate('Y-m-d');
        
        $waktu = time();
        $hitset='1';

        $max=$this->id_max('id_visitor','visitor');
            if($max == 0) 
                $id_visitor = 1;
            else
                $id_visitor = $max+1;

        $query=$this->mydb1->query("SELECT count(*) as view,hits FROM visitor WHERE ip='$ip' AND created_date='$tanggal' and browser='$browser'");
        $row=$query->row();
        $ct=$row->view;
        $hits=$row->hits;

        if ($ct == 0)
        {
            $this->mydb1->trans_start();

            $this->mydb1->set('id_visitor',$id_visitor);
            $this->mydb1->set('created_date',$tanggal);
            $this->mydb1->set('browser',$browser);
            $this->mydb1->set('ip ',$ip);
            $this->mydb1->set('online ',$waktu);
            $this->mydb1->set('hits ',$hitset);
            $this->mydb1->insert('visitor');

            $this->mydb1->trans_complete();
            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                //$this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->messege_proses('data berhasil disimpan.','save',$url);
                return TRUE;
            }  
        }
        else
        {
            $this->mydb1->trans_start();
            $this->mydb1->set('online ',$waktu);
            $this->mydb1->set('hits',$hits+1);
            $this->mydb1->where('ip ',$ip);
            $this->mydb1->where('browser ',$browser);
            $this->mydb1->where('created_date',$tanggal);
            $this->mydb1->update('visitor');

            $this->mydb1->trans_complete();
            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                //$this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->messege_proses('data berhasil disimpan.','save',$url);
                return TRUE;
            }
        }
    }
    
    public function set_keyword($keyword)
    {
        
        $_IP_SERVER = $_SERVER['SERVER_ADDR'];
        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
        $ip = $_IP_ADDRESS;
        $browser    = $_SERVER['HTTP_USER_AGENT'];
        
        date_default_timezone_set('Asia/Jakarta');
        $tanggal       = gmdate('Y-m-d');
        
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);
        
        $waktu = time();
        $hitset='1';

        $max=$this->id_max('id_log','_log_keyword');
            if($max == 0) 
                $id_log = 1;
            else
                $id_log = $max+1;

        $query=$this->mydb1->query("SELECT count(keyword) as view,hits FROM _log_keyword WHERE ip='$ip' AND created_date_object='$tanggal' and browser='$browser' and keyword='$keyword'");
        $row=$query->row();
        $ct=$row->view;
        $hits=$row->hits;

        if ($ct == 0)
        {
            $this->mydb1->trans_start();

            $this->mydb1->set('id_log',$id_log);
            $this->mydb1->set('keyword',$keyword);
            $this->mydb1->set('created_date',$created_date);
            $this->mydb1->set('created_date_object',$tanggal);
            $this->mydb1->set('ip ',$ip);
            $this->mydb1->set('browser',$browser);
            $this->mydb1->set('hits ',$hitset);
            $this->mydb1->insert('_log_keyword');

            $this->mydb1->trans_complete();
            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                //$this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->messege_proses('data berhasil disimpan.','save',$url);
                return TRUE;
            }  
        }
        else
        {
            $this->mydb1->trans_start();
            $this->mydb1->set('hits',$hits+1);
            $this->mydb1->where('keyword ',$keyword);
            $this->mydb1->where('ip ',$ip);
            $this->mydb1->where('browser ',$browser);
            $this->mydb1->where('created_date_object',$tanggal);
            $this->mydb1->update('_log_keyword');

            $this->mydb1->trans_complete();
            if ($this->mydb1->trans_status()==false)
            {
                $this->mydb1->trans_rollback();
                //$this->error();
                return FALSE;
            }
            else
            {
                $this->mydb1->trans_commit();
                //$this->messege_proses('data berhasil disimpan.','save',$url);
                return TRUE;
            }
        }
    }
}

?>