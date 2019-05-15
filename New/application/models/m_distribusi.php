<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_distribusi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function getAllDistribusi()
    {
        return $this->db->get('distribusi')->result();
    }

    public function distribusi($data)
    {
        $this->db->insert('distribusi', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function stockKirim($data)
    {
        $this->db->insert('stokkirim', $data);
    }

    public function getDistribusi()
    {
        $query = $this->db->get('distribusi');
        return $query->result_array();
    }

    public function update_status($data, $id)
    {
        $this->db->where('iddistribusi', $id);
        return $this->db->update('distribusi', $data);
    }
    public function get_distribusi_by_id($id)
    {
        return $this->db->get_where('distribusi', array('iddistribusi' => $id))->result_array();
    }

    public function get_stock_byID($id)
    {
        return $this->db->query("SELECT * FROM distribusi JOIN stokkirim USING(iddistribusi) WHERE iddistribusi = '$id'")->result();
    }

    public function getStokProduk()
    {
        $this->db->select('distribusi.iddistribusi, distribusi.status, stokkirim.idstokkirim, produk.idproduk, barang.nama, stokkirim.jumlah as stokdkirim, produk.stock');
        $this->db->from('distribusi');
        $this->db->join('stokkirim', 'stokkirim.iddistribusi=distribusi.iddistribusi');
        $this->db->join('barang', 'barang.idbarang=stokkirim.idbarang');
        $this->db->join('produk', 'produk.idproduk=barang.idbarang');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_produk_by_id($id)
    {
        return $this->db->get_where('produk', array('idproduk' => $id))->result_array();
    }
    public function update_stock($data, $id)
    {
        $this->db->where('idproduk', $id);
        return $this->db->update('produk', $data);
    }

    public function getStokBahanbaku()
    {
        $this->db->select('distribusi.iddistribusi, distribusi.status, stokkirim.idstokkirim, bahanbaku.idbahanbaku, barang.nama, stokkirim.jumlah as stokdkirim, bahanbaku.qty');
        $this->db->from('distribusi');
        $this->db->join('stokkirim', 'stokkirim.iddistribusi=distribusi.iddistribusi');
        $this->db->join('barang', 'barang.idbarang=stokkirim.idbarang');
        $this->db->join('bahanbaku', 'bahanbaku.idbahanbaku=barang.idbarang');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_bahanbaku_by_id($id)
    {
        return $this->db->get_where('bahanbaku', array('idbahanbaku' => $id))->result_array();
    }
    public function update_bahanbaku($data, $id)
    {
        $this->db->where('idbahanbaku', $id);
        return $this->db->update('bahanbaku', $data);
    }
}
