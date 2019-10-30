<?php
class Model_supir extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
    }

    public function get_data_supir()
    {
        $sql = "select * from supir";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function delete_supir()
    {
      $id = $this->input->post('id_supir');

      $sql = "DELETE FROM supir WHERE id_supir = ?;";
      $queryRec = $this->db->query($sql, array($id));
      return $queryRec;
    }

    public function save_supir()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $nama_supir = $this->input->post('nama_supir');
        $tanggal_bergabung = $this->input->post('tanggal_bergabung');
        $no_handphone = $this->input->post('no_handphone');

        $sql = "INSERT INTO `supir`(`id_supir`, `nama_supir`, `tanggal_bergabung`, `no_hp`, `created_date`)  values (null,?,?,?,?)";
        $queryRec = $this->db->query($sql, array($nama_supir, $tanggal_bergabung, $no_handphone, $created_date));
        return $queryRec;
    }

    public function get_supir()
    {
      $id = $this->input->post('id_supir');
      $sql = "select * from supir where id_supir = ?";
      $queryRec = $this->db->query($sql, array($id))->row_array();
      return $queryRec;
    }

    public function get_list_supir()
    {
      $sql = "select * from supir";
      $queryRec = $this->db->query($sql)->result_array();
      return $queryRec;
    }

    public function edit_supir()
    {
      $id_supir = $this->input->post('id_supir');
      $nama_supir = $this->input->post('nama_supir');
      $tanggal_bergabung = $this->input->post('tanggal_bergabung');
      $no_handphone = $this->input->post('no_handphone');

      $sql = "update supir set nama_supir = ?, tanggal_bergabung = ?, no_hp =? where id_supir = ?";
      $queryRec = $this->db->query($sql, array($nama_supir, $tanggal_bergabung, $no_handphone, $id_supir));
      return $queryRec;
    }
}