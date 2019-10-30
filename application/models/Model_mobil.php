<?php
class Model_mobil extends CI_Model
{	

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation','image_lib');
        $this->mydb1 = $this->load->database('default',TRUE);
    }

    public function get_data_mobil()
    {
        $sql = "select * from mobil";
        $queryRec = $this->db->query($sql);
        return $queryRec;
    }

    public function delete_mobil()
    {
      $id = $this->input->post('id_mobil');

      $sql = "DELETE FROM mobil WHERE id_mobil = ?;";
      $queryRec = $this->db->query($sql, array($id));
      return $queryRec;
    }

    public function save_mobil()
    {
        date_default_timezone_set('Asia/Jakarta');
        $created_date       = gmdate('Y-m-d H:i:s', time()+60*60*7);

        $plat_nomor = $this->input->post('plat_nomor');
        $merk_mobil = $this->input->post('merk_mobil');
        $tahun_mobil = $this->input->post('tahun_mobil');
        $tahun_beli = $this->input->post('tahun_beli');

        $sql = "INSERT INTO `mobil`(`id_mobil`, `nomor_plat`, `merk_mobil`, `tahun_mobil`,`tahun_beli`, `created_date`)  values (null,?,?,?,?,?)";
        $queryRec = $this->db->query($sql, array($plat_nomor, $merk_mobil, $tahun_mobil,$tahun_beli, $created_date));
        return $queryRec;
    }

    public function get_mobil()
    {
      $id = $this->input->post('id_mobil');
      $sql = "select * from mobil where id_mobil = ?";
      $queryRec = $this->db->query($sql, array($id))->row_array();
      return $queryRec;
    }

    public function get_list_mobil()
    {
      $sql = "select * from mobil";
      $queryRec = $this->db->query($sql)->result_array();
      return $queryRec;
    }

    public function edit_mobil()
    {
      $id = $this->input->post('id_mobil');
      $plat_nomor = $this->input->post('plat_nomor');
      $merk_mobil = $this->input->post('merk_mobil');
      $tahun_mobil = $this->input->post('tahun_mobil');
      $tahun_beli = $this->input->post('tahun_beli');

      $sql = "update mobil set nomor_plat = ?, merk_mobil = ?, tahun_mobil =?,tahun_beli =? where id_mobil = ?";
      $queryRec = $this->db->query($sql, array($plat_nomor, $merk_mobil, $tahun_mobil,$tahun_beli, $id));
      return $queryRec;
    }
}