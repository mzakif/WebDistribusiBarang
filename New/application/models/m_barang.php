<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_barang extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function getAll()
    {
        $query = $this->db->get('barang');
        return $query->result_array();
    }
    public function getAllBahanBaku()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('bahanbaku', 'bahanbaku.idbahanbaku=barang.idbarang');
        // $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
    public function getAllProduk()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('produk', 'produk.idproduk=barang.idbarang');
        // $this->db->where($aktif);
        $query = $this->db->get();
        return $query->result();
    }
}
