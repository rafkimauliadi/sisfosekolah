<?php
/**
* 
*/
class Model_home extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
        $this->mydb1 = $this->load->database('default',TRUE);
	}
	
	public function xml()
	{
	    $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content");
        return $data;   
	}
	
	public function init_tags()
	{
	    return $query=$this->mydb1->query("SELECT 
	                                            id_category,
	                                            title_category, 
	                                            count(id_content) as jml 
	                                        FROM 
	                                            view_recent_content 
	                                        GROUP BY 
	                                            id_category 
	                                        ORDER BY rand()");
	}
	
	public function id_max($field,$tabel)
    {
        $query = $this->mydb1->query("SELECT MAX(".$field.") as exist FROM ".$tabel."");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }

    public function set_hits($id,$tabel)
    {
        $_IP_SERVER = $_SERVER['SERVER_ADDR'];
        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR']; 
        $ip = $_IP_ADDRESS;
        
        
        date_default_timezone_set('Asia/Jakarta');
        $tanggal       = gmdate('Y-m-d');
        
        
        $hitset='1';

        $max=$this->id_max('id_read','content_statistik');
            if($max == 0) 
                $id_read = 1;
            else
                $id_read = $max+1;

        $query=$this->mydb1->query("SELECT 
                                        count(*) as view,
                                        hits 
                                    FROM 
                                        content_statistik 
                                    WHERE 
                                        ip='$ip' 
                                    AND 
                                        created_date='$tanggal' 
                                    AND 
                                        id_content='$id' 
                                    AND 
                                        from_tabel='$tabel'");
        $row=$query->row();
        $ct=$row->view;
        $hits=$row->hits;

        if ($ct == 0)
        {
            $this->mydb1->trans_start();

            $this->mydb1->set('id_read',$id_read);
            $this->mydb1->set('created_date',$tanggal);
            $this->mydb1->set('ip ',$ip);
            $this->mydb1->set('id_content ',$id);
            $this->mydb1->set('hits ',$hitset);
            $this->mydb1->set('from_tabel',$tabel);
            $this->mydb1->insert('content_statistik');

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
            $this->mydb1->where('ip ',$ip);
            $this->mydb1->where('id_content ',$id);
            $this->mydb1->where('created_date',$tanggal);
            $this->mydb1->where('from_tabel',$tabel);
            $this->mydb1->update('content_statistik');

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
    
    public function hits_content($id,$field,$tabel)
    {
        $query=$this->mydb1->query("SELECT hits as hits FROM ".$tabel." WHERE ".$field."='$id'");
        $row=$query->row();
        $hits=$row->hits;

        $this->mydb1->trans_start();
        $this->mydb1->set('hits ',$hits+1);
        $this->mydb1->where($field,$id);
        $this->mydb1->where('id_status ','4');
        $this->mydb1->update($tabel);

        $this->mydb1->trans_complete();
        if ($this->mydb1->trans_status()==false)
        {
            $this->mydb1->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->mydb1->trans_commit();
            return TRUE;
        }
    }
    
    public function init_terbaru($offset,$perpage)
    {
        $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                         limit ".$offset.",".$perpage);
        return $data;
    }

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content");
        return $data->num_rows();
    }
    
    public function exist_content($id)
    {
        $query = $this->mydb1->query("SELECT count(id_content) as exist FROM content WHERE id_content = '$id' and id_status='4'");
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
    
    public function init_details()
    {
        $id  = abs($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                        WHERE 
                                            id_content='$id'");
        return $data;
    }

    public function meta_keyword_content($details)
    {
        $identitas  = $this->model_hook->identitas();
        $url       = site_url('home/read/'.$details->row()->id_content.'-'.strtolower(str_replace(' ','-',$details->row()->title)).'.html');
        
        
        
        $title     = $details->row()->title;
        $isi       = strip_tags(addslashes(trim(substr($details->row()->isi,0,300))));

        $year = substr($details->row()->created_modified,0,4);
        $month = substr($details->row()->created_modified,5,2);
                        
        if ($details->row()->gambar!=NULL)
        {
            $post_images=base_url().'images/'.$year.'/'.$month.'/thumbnails/'.$details->row()->gambar;
        }
        else
        {
            $post_images =cek_img_tag($details->row()->isi);
        }
        
        
        if ($post_images=="")
            $post_images =base_url('favicon.png');
            
        $kat1   =   $identitas->row()->keyword;
        $kat2   =   $title;
        $kat3   =   str_replace(" ", ", ", $title);
        
        $keyword=$kat1.', '.$kat2.', '.$kat3;
        
        $meta_keyword='<meta property="og:url"           content="'.$url.'" />
                        <meta property="og:type"          content="website & aplikasi" />
                        <meta property="og:title"         content="'.$title.'" />
                        <meta property="og:description"   content="'.$isi.'" />
                        <meta property="og:keyword"       content="'.$keyword.'" />
                        <meta property="og:image"         content="'.$post_images.'" />';

        return $meta_keyword;
    }

    public function init_searching($keyword,$offset,$perpage)
    {
        $pisah_kata = explode(" ", $keyword);
        $jumlah_kata = (integer)count($pisah_kata);
        $jml_kata = $jumlah_kata - 1;
        $sql='';
        for ($i=0; $i<=$jml_kata; $i++)
        {
            $sql .= "(title like '%$pisah_kata[$i]%' or isi like '%$pisah_kata[$i]%')";

            if($i < $jml_kata)
            {
                $sql .= " OR ";
            }
        }

        $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                        WHERE 
                                            ".$sql."
                                        order by created_date desc 
                                         limit ".$offset.",".$perpage);
        return $data;
    }

    public function num_rows_search($keyword)
    {
        $pisah_kata = explode(" ", $keyword);
        $jumlah_kata = (integer)count($pisah_kata);
        $jml_kata = $jumlah_kata - 1;
        $sql='';
        for ($i=0; $i<=$jml_kata; $i++)
        {
            $sql .= "(title like '%$pisah_kata[$i]%' or isi like '%$pisah_kata[$i]%')";

            if($i < $jml_kata)
            {
                $sql .= " OR ";
            }
        }

        $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                        WHERE 
                                            ".$sql."
                                        order by created_date desc");
        return $data->num_rows();
    }
    
    public function init_category()
    {
        $id_category  = abs($this->uri->segment(3,0));
        
        $data =$this->mydb1->query("SELECT 
                                            id_category,
                                            title
                                        from 
                                            category
                                    WHERE 
                                        id_category='$id_category'");
        return $data;
    }
    
    public function meta_keyword_category($details)
    {
        $identitas  = $this->model_hook->identitas();
        $url       = site_url('home/category/'.$details->row()->id_category);
        
        
        
        $title     = $details->row()->title;
        $isi       = strip_tags(addslashes(trim($details->row()->title)));

        
        $post_images =base_url('favicon.png');
        
        $kat1   =   $identitas->row()->keyword;
        $kat2   =   $title;
        $kat3   =   str_replace(" ", ", ", $title);
        
        
        $keyword=$kat1.', '.$kat2.', '.$kat3;

        $meta_keyword='<meta property="og:url"           content="'.$url.'" />
                        <meta property="og:type"          content="website & aplikasi" />
                        <meta property="og:title"         content="'.$title.'" />
                        <meta property="og:description"   content="'.$isi.'" />
                        <meta property="og:keyword"       content="'.$keyword.'" />
                        <meta property="og:image"         content="'.$post_images.'" />';

        return $meta_keyword;
    }
    
    public function init_recent_category($id_category,$offset,$perpage)
    {
        $id_category  = abs($this->uri->segment(3,0));
        
        $data =$this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                        WHERE 
                                            id_category='$id_category'
                                            
                                        limit ".$offset.",".$perpage);
        return $data;
    }
    
    public function exist_category()
    {
        $id_category  = abs($this->uri->segment(3,0));
        $query = $this->mydb1->query("SELECT count(id_category) as exist FROM category WHERE id_category = '$id_category'");
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
    
    public function num_rows_category($id_category)
    {
        $data = $this->mydb1->query("SELECT 
                                            *
                                        from 
                                            view_recent_content
                                        WHERE 
                                            id_category='$id_category'
                                        order by created_date desc");
        return $data->num_rows();
    }
}

?>