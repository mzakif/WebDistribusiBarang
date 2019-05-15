<?php
defined('BASEPATH') or exit('No direct script access allowed');

class karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('m_user');
        $this->load->model('m_barang');
        $this->load->model('m_distribusi');
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

    public function index()
    {
        $data['title'] = 'Gudang karyawan';
        $data['titleKar'] = 'Karyawan Gudang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user3'] = $this->db->get_where('karyawan', ['level' => $this->session->userdata('levelKar')])->row_array();

        $this->load->view('v_karyawan_gudang.php', $data);
    }

    public function cekBarangGud()
    {
        $data['title'] = 'Gudang Karyawan';
        $data['titleKar'] = 'Karyawan Gudang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user3'] = $this->db->get_where('karyawan', ['level' => $this->session->userdata('levelKar')])->row_array();

        $this->load->view('v_kar_barang.php', $data);
    }

    public function pesananDistribusi()
    {
        $data['title'] = 'Gudang Karyawan';
        $data['titleKar'] = 'Karyawan Gudang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user3'] = $this->db->get_where('karyawan', ['level' => $this->session->userdata('levelKar')])->row_array();
        $data['distri'] = $this->m_distribusi->getDistribusi();


        $this->load->view('v_pesanan_distri_kar.php', $data);
    }

    public function showDetailKirim($id)
    {
        $stok = $this->m_distribusi->get_stock_byID($id);
        echo json_encode($stok);
    }

    public function update_status($id = NULL)
    {
        $distribusi = $this->m_distribusi->get_distribusi_by_id($id);
        $this->session->set_flashdata('update_id', $id);
        if ($distribusi) {
            $data['status'] = $this->input->post('status');
            $this->m_distribusi->update_status($data, $id);
            $this->session->set_flashdata('update_berhasil', TRUE);
        }
        redirect('karyawan/pesananDistribusi', 'location');
    }

    public function lihatUpdateBarang()
    {
        $data['title'] = 'Gudang Karyawan';
        $data['titleKar'] = 'Karyawan Gudang';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user3'] = $this->db->get_where('karyawan', ['level' => $this->session->userdata('levelKar')])->row_array();
        $data['stokUp'] = $this->m_distribusi->getStokProduk();
        $data['stokUp2'] = $this->m_distribusi->getStokBahanbaku();


        $this->load->view('v_stokUp.php', $data);
    }

    public function update_produk($id = NULL)
    {
        $produk = $this->m_distribusi->get_produk_by_id($id);
        $this->session->set_flashdata('update_id', $id);
        if ($produk) {
            $data['stock'] = $this->input->post('stock');
            $this->m_distribusi->update_stock($data, $id);
            $this->session->set_flashdata('update_berhasil', TRUE);
        }
        redirect('karyawan/lihatUpdateBarang', 'location');
    }

    public function update_bahanbaku($id = NULL)
    {
        $bahanbaku = $this->m_distribusi->get_bahanbaku_by_id($id);
        $this->session->set_flashdata('update_id', $id);
        if ($bahanbaku) {
            $data['qty'] = $this->input->post('qty');
            $this->m_distribusi->update_bahanbaku($data, $id);
            $this->session->set_flashdata('update_berhasil', TRUE);
        }
        redirect('karyawan/lihatUpdateBarang', 'location');
    }
}
