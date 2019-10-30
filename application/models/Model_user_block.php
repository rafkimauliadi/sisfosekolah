<?php
class Model_user_block extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','encryption');
        $this->load->model(array('model_login'));


        $this->mydb1 = $this->load->database('default',TRUE);
        
        //$this->mydb2 = $this->load->database('default2',TRUE);
    }
    
    
    public function validation_field($action)
    {
        $this->model_message->conv_validasi_to_indonesia();

        $username          = $this->input->post('username');
        $password          = $this->input->post('password');
        $email             = $this->input->post('email');
        $nomor_identitas   = $this->input->post('nomor_identitas');

        if ($action=='simpan')
        {
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[_users.username]');
            $this->form_validation->set_rules('email', 'email', 'required|is_unique[_users.email]');
            $this->form_validation->set_rules('nomor_identitas', 'Nomor Identitas', 'is_unique[_users.nomor_identitas]');
        }
        else
        {
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('email', 'email', 'required');
        }

        $this->session->set_flashdata('username', $username);
        $this->session->set_flashdata('password', $password);
        $this->session->set_flashdata('email', $email);
        $this->session->set_flashdata('nomor_identitas', $nomor_identitas);

        
       
    }

    public function exist_id($id)
    {
        $query = $this->mydb1->query("SELECT count(id_user) as exist FROM _users WHERE id_user = '$id'");
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

    public function num_rows()
    {
        $data=$this->mydb1->query("SELECT 
                                            a.id_user,
                                            a.username,
                                            a.email,
                                            a.registerDate,

                                            b.id_status,
                                            b.nm_status,

                                            c.full_name,
                                            c.telp,
                                            c.alamat,

                                            d.nama_instansi,

                                            e.nm_group
                                        from 
                                            _users a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _users_account c on (a.id_user=c.id_user)
                                            LEFT JOIN instansi d on (a.id_instansi=d.id_instansi)
                                            LEFT JOIN _group e on (a.id_group=e.id_group)
                                        WHERE 
                                            a.id_status <> '1'
                                        ");
        return $data->num_rows();
    }

    public function search()
    {
        $query =    $this->mydb1->query("SELECT 
                                            a.username,
                                            a.email
                                        from 
                                            _users a
                                        ");
        return $query->field_data();
    }

    public function get_view($offset,$perpage)
    {
        $change_box = $this->input->post('change_box',TRUE);
        $search_box = $this->input->post('search_box',TRUE);
        $this->session->set_flashdata('search_box', $search_box);
        
        if($search_box != NULL)
    	   $data =$this->mydb1->query("SELECT 
                                            a.id_user,
                                            a.username,
                                            a.email,
                                            a.registerDate,

                                            b.id_status,
                                            b.nm_status,

                                            c.full_name,
                                            c.telp,
                                            c.alamat,

                                            d.nama_instansi,

                                            e.nm_group
                                        from 
                                            _users a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _users_account c on (a.id_user=c.id_user)
                                            LEFT JOIN instansi d on (a.id_instansi=d.id_instansi)
                                            LEFT JOIN _group e on (a.id_group=e.id_group)
                                        where 
                                            (a.".$change_box." like '%$search_box%')
                                        AND 
                                            a.id_status <> '1'
                                        ");
        else
            $data =$this->mydb1->query("SELECT 
                                            a.id_user,
                                            a.username,
                                            a.email,
                                            a.registerDate,

                                            b.id_status,
                                            b.nm_status,

                                            c.full_name,
                                            c.telp,
                                            c.alamat,

                                            d.nama_instansi,

                                            e.nm_group
                                        from 
                                            _users a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _users_account c on (a.id_user=c.id_user)
                                            LEFT JOIN instansi d on (a.id_instansi=d.id_instansi)
                                            LEFT JOIN _group e on (a.id_group=e.id_group)
                                        WHERE 
                                            a.id_status <> '1'
                                        order by a.id_user desc
                                            limit ".$offset.",".$perpage);
        return $data;
    }    	

    public function get_data()
    {
        $id = $this->format_data->string($this->uri->segment(3,0));
        $data =$this->mydb1->query("SELECT 
                                            a.id_user,
                                            a.nomor_identitas,
                                            a.username,
                                            a.password,
                                            a.email,
                                            a.id_instansi,
                                            a.id_group,
                                            a.id_status,

                                            b.nm_status,

                                            c.nm_group
                                        from 
                                            _users a
                                            LEFT JOIN _status_system b on (a.id_status=b.id_status)
                                            LEFT JOIN _group c on (a.id_group=c.id_group)
                                        WHERE 
                                            a.id_user='$id'");
        return $data;
    }

    public function init_update()
    {
        $id_user        = $this->model_hook->init_online_exist();

        $id             = $this->format_data->string($this->input->post('id',TRUE));
        $username       = $this->input->post('username',TRUE);
        $email          = $this->input->post('email',TRUE);
        $id_instansi    = $this->input->post('parent_id',TRUE);
        $id_group       = $this->input->post('id_group',TRUE);
        $id_status      = $this->input->post('id_status',TRUE);

        $password       = $this->input->post('password',TRUE);

        $nomor_identitas   = $this->input->post('nomor_identitas');

        if ($password=="")
        {
            $password       = $this->format_data->string($this->input->post('password_lama',TRUE));
        } 
        else
        { 
            
            $set_password   = $this->format_data->string($this->input->post('password',TRUE));
            $password       = md5(sha1(strip_tags(addslashes(trim($set_password)))).'beye');
            $this->model_login->update_password($id);
        }


        $url            = site_url('user/edit/'.$id);

        $this->mydb1->trans_start();
        $this->mydb1->set('nomor_identitas',$nomor_identitas);
        $this->mydb1->set('username',$username);
        $this->mydb1->set('password',$password);
        $this->mydb1->set('email',$email);
        $this->mydb1->set('id_instansi',$id_instansi);
        $this->mydb1->set('id_group',$id_group);
        $this->mydb1->set('id_status',$id_status);
        $this->mydb1->set('created_by',$id_user);
        $this->mydb1->where('id_user',$id);
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
            $this->model_message->messege_proses('Data Berhasil diperbarui.','delete',$url,'fa-check-square-o','success');
            return TRUE;
        }
    }


    public function cek_exist_akun($tabel,$field1,$field2,$value1,$value2)
    {
        $query = $this->mydb1->query("SELECT count(".$field1.") as exist FROM ".$tabel." where ".$field1."='$value1' and ".$field2." <> $value2");
        $row=$query->row();
            if (isset($row))
                return $row->exist;
        return 0;
    }


}