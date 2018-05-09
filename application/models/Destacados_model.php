<?php
class Destacados_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('destacados');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set($array)
    {

        $this->db->insert('destacados', $array);

        return $this->db->insert_id();
    }

    public function delete($highlight_id)
    {
        $this->db->delete('destacados', array('highlight_id' => $highlight_id));   
    }

}