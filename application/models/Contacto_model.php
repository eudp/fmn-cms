<?php
class Contacto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($id = null)
    {
        if ($id == null) {

            $this->db->select('c.id, c.data, s.date');
            $this->db->from('contact_data as c');
            $this->db->join('contact_submissions as s', 's.id = c.id');
            $this->db->where('c.cid', 3);
            $this->db->group_by('c.id');
            $this->db->order_by('s.date', 'DESC');
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