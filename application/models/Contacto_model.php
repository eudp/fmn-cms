<?php
class Contacto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($contact_id = null)
    {
/*        if ($id == null) {

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
        }*/

        if ($contact_id == null) {

            $this->db->select('c.contact_id, c.name, c.subject, c.date, c.remote_address');
            $this->db->from('contactenos as c');
            $this->db->order_by('c.date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();

        } else {

            $this->db->select('c.contact_id, c.name, c.subject, c.date, c.message, c.email, c.remote_address');
            $this->db->from('contactenos as c');
            $this->db->where('contact_id', $contact_id);
            $query = $this->db->get();
            return $query->row_array();
        }
    }

    public function set($array)
    {

        $this->db->insert('contactenos', $array);

        return $this->db->insert_id();
        
    }
}