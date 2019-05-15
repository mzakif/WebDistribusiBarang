<?php
defined('BASEPATH') or exit('No direct script access allowed');

class manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model(array('User_model'));
        $this->load->model('m_barang');
        $this->load->model('m_distribusi');
    }
    public function index()
    {
        $data['title'] = 'Toko Manager';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();

        $this->load->view('v_manager_Toko.php', $data);
    }

    public function getbarang()
    {
        $cek = $this->m_barang->getAll();
        echo json_encode($cek);
    }
    public function getbarangJoin()
    {
        $cek = $this->m_barang->getAllBahanBaku();
        echo json_encode($cek);
    }
    public function getprodukJoin()
    {
        $cek = $this->m_barang->getAllProduk();
        echo json_encode($cek);
    }
    public function lihatBarang()
    {
        $data['title'] = 'Toko Manager';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();

        $this->load->view('v_barang', $data);
    }

    public function getdistribusi()
    {
        $cek = $this->m_distribusi->getAllDistribusi();
        echo json_encode($cek);
    }
    public function Distribusi()
    {
        $data['title'] = 'Toko Manager';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();

        $this->load->view('v_distribusi', $data);
    }
}
