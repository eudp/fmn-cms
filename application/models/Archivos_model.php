<?php
class Archivos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function set ($array)
    {
        $r = $this->db->insert('archivos', $array);

        return $this->db->insert_id();
    }
}