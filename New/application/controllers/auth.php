<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_barang');
        $this->load->model('m_user');
        $this->load->model('m_distribusi');
    }

    public function index()
    {

        // $data['dataUser'] = $this->User_model->get_by_role();
        // $this->load->view('v_tes', $data);
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('v_login', $data);
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        $user2 = $this->db->get_where('manager', ['idmanager' => $user['iduser']])->row_array();
        $user3 = $this->db->get_where('karyawan', ['idkaryawan' => $user['iduser']])->row_array();
        $user4 = $this->db->get_where('toko', ['idmanager' => $user2['idmanager']])->row_array();


        if ($user) {
            if ($password == $user['password']) {
                $data = [
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'nama' => $user['nama'],
                    'idmanager' => $user2['idmanager'],
                    'levelMG' => $user2['level'],
                    'levelKar' => $user3['level'],
                    'idtoko' => $user4['idtoko']
                ];
                $this->session->set_userdata($data);
                if ($user['role'] == 0) {
                    if ($user2['level'] == 1) {
                        redirect('manager');
                    }
                } else if ($user['role'] == 1) {
                    if ($user3['level'] == 1) {
                        redirect('karyawan');
                    }
                } else if ($user['role'] == 2) {
                    redirect('supplier');
                } else {
                    redirect('customer');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Passwoed is error </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Username is error </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('nama');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selesaai </div>');
        redirect('auth');
    }
}
