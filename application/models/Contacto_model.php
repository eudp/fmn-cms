<?php
class Contacto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = null)
    {
        if ($id == null) {

            $this->db->select('id, data');
            $this->db->from('contact_data as c');
            $this->db->group_by('id');
            $query = $this->db->get();
            return $query->result_array();

        } else {
            $this->db->select('cid, data');
            $this->db->from('contact_data as c');
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->result_array();
        }
    }
}