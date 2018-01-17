<?php
class enlaces_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get()
    {
        $this->db->select('e.title, e.url, a.path');
        $this->db->from('enlaces as e');
        $this->db->join('archivos as a', 'a.file_id = e.image_id');
        $this->db->where(array('status' => 1 ));
        $query = $this->db->get();
        return $query->result_array();
    }
}