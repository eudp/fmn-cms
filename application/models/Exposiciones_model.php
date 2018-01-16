<?php
class Exposiciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($active, $exposition_id = FALSE)
    {
        if ($exposition_id === FALSE)
        {
            $this->db->select('e.title, a.path, e.description, e.exposition_id');
            $this->db->from('exposiciones as e');
            $this->db->join('archivos as a', 'a.file_id = e.image_id');
            $this->db->where(array('status' => 1, 'active' => $active ));
            $this->db->order_by('e.creation_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.title, e.description, t.title as title_m, t.address, e.exhibition_place, e.schedule');
        $this->db->from('exposiciones as e');
        $this->db->join('establecimientos as t', 'e.establishment_id = t.establishment_id');
        $this->db->where(array('e.status' => 1,'exposition_id' => $exposition_id ));
        $query = $this->db->get();

        return $query->row_array();
    }
    public function get_carousel($exposition_id)
    {
        $this->db->select('a.path');
        $this->db->from('exposiciones as e');
        $this->db->join('carrusel as c', 'e.exposition_id = c.element_id');
        $this->db->join('archivos as a', 'c.image_id = a.file_id');
        $this->db->where(array('exposition_id' => $exposition_id ));
        $query = $this->db->get();
        return $query->result_array();
    }
}