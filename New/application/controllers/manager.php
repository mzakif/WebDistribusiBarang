<?php
defined('BASEPATH') or exit('No direct script access allowed');

class manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('m_user');
        $this->load->model('m_barang');
        $this->load->model('m_distribusi');
    }
    public function index()
    {
        $data['title'] = 'Toko Manager';
        $data['titleGud'] = 'Manager Toko';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();
        $data['user4'] = $this->db->get_where('toko', ['idtoko' => $this->session->userdata('idtoko')])->row_array();

        $this->load->view('v_manager_Toko.php', $data);
    }

    public function getbarang()
    {
        $cek = $this->m_barang->getAll();
        echo json_encode($cek);
    }
    public function getToko($id)
    {
        $cek = $this->m_user->getByToko($id);
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

    public function getdistribusi()
    {
        $cek = $this->m_distribusi->getAllDistribusi();
        echo json_encode($cek);
    }

    public function lihatBarang()
    {
        $data['title'] = 'Toko Manager';
        $data['titleGud'] = 'Manager Toko';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();

        $this->load->view('v_barang', $data);
    }

    public function prosesDistribusi()
    {
        $data['title'] = 'Toko Manager';
        $data['titleGud'] = 'Manager Toko';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();
        $data['barang'] = $this->m_barang->getAll();

        $this->load->view('v_distribusi', $data);
    }

    public function Distribusi()
    {
        $data['title'] = 'Toko Manager';
        $data['titleGud'] = 'Manager Toko';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user2'] = $this->db->get_where('manager', ['level' => $this->session->userdata('levelMG')])->row_array();

        $this->load->view('v_lacakDistribusi', $data);
    }

    function tambah()
    {
        $data_produk = array(
            'id' => $this->input->post('idbarang'),
            'name' => $this->input->post('nama'),
            'price' => $this->input->post(null),
            'qty' => $this->input->post('qty'),
        );
        $this->cart->insert($data_produk);
        redirect('manager');
    }
    function hapus($rowid)
    {
        if ($rowid == "all") {
            $this->cart->destroy();
        } else {
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            $this->cart->update($data);
        }
        redirect('manager');
    }
    function ubah_cart()
    {
        $cart_info = $_POST['cart'];
        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $qty = $cart['qty'];
            $data = array(
                'rowid' => $rowid,
                'qty' => $qty
            );
            $this->cart->update($data);
        }
        redirect('manager');
    }

    public function proses_distribusi()
    {
        //-------------------------Input data pelanggan--------------------------
        // $data_toko = $this->input->post('idmanager');
        // $id_toko = $this->m_user->getByToko($data_toko);

        $data_order = array(
            'idtoko' => $this->input->post('idtoko'),
            'tanggal' => $this->input->post('tanggal'),
            'status' => '0'
        );
        $id_distribusi = $this->m_distribusi->distribusi($data_order);

        //-------------------------Input data detail order-----------------------		

        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $data_detail = array(
                    'idbarang' => $item['id'],
                    'iddistribusi' => $id_distribusi,
                    'jumlah' => $item['qty']
                );

                $proses = $this->m_distribusi->stockKirim($data_detail);
            }
        }
        //-------------------------Hapus shopping cart--------------------------		
        $this->cart->destroy();
        redirect('manager');
    }
}
