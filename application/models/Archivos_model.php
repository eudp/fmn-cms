<?php
class Archivos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function set ($array, $museos = '')
    {
        $this->db->insert('archivos' . $museos, $array);

        return $this->db->insert_id();
    }
}