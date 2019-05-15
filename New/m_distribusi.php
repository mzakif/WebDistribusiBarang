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
}
