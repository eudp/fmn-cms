<?php
class Establecimientos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($type, $establishment_id = FALSE)
    {
        if ($establishment_id === FALSE)
        {
            $this->db->select('e.acronym, e.title, a.path, e.establishment_id');
            $this->db->from('establecimientos as e');
            $this->db->join('archivos as a', 'a.file_id = e.image_id');
            $this->db->where(array('type' => $type, 'status' => 1 ));
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.acronym, e.title, e.description, e.address, e.phone, e.email, e.facebook_url, e.twitter_url, e.site_url, e.schedule, e.services');
        $this->db->from('establecimientos as e');
        $this->db->where(array('type' => $type, 'status' => 1,'establishment_id' => $establishment_id ));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_carousel($establishment_id)
    {
        $this->db->select('a.path');
        $this->db->from('establecimientos as e');
        $this->db->join('carrusel as c', 'e.establishment_id = c.element_id');
        $this->db->join('archivos as a', 'c.image_id = a.file_id');
        $this->db->where(array('establishment_id' => $establishment_id ));
        $query = $this->db->get();
        return $query->result_array();
    }
}