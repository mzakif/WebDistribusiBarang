<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_user extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Codeigniter : Write Less Do More
    }

    public function getByToko($id)
    {
        $this->db->select('idtoko');
        $this->db->where('idtoko', $id);
        return $this->db->get('toko')->result();
    }
}
