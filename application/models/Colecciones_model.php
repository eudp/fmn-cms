<?php
class Colecciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($collection_id = FALSE)
    {
        if ($collection_id === FALSE)
        {
            $this->db->select('c.title, a.path, c.collection_id');
            $this->db->from('colecciones as c');
            $this->db->join('archivos as a', 'a.file_id = c.image_id');
            $this->db->where(array('status' => 1 ));
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('c.title, c.description');
        $this->db->from('colecciones as c');
        $this->db->where(array('status' => 1,'collection_id' => $collection_id ));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_carousel($collection_id)
    {
        $this->db->select('a.path');
        $this->db->from('colecciones as c');
        $this->db->join('carrusel as r', 'c.collection_id = r.element_id');
        $this->db->join('archivos as a', 'r.image_id = a.file_id');
        $this->db->where(array('collection_id' => $collection_id ));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_works($collection_id)
    {
        $this->db->select('o.title, o.description, a.path');
        $this->db->from('obras as o');
        $this->db->join('archivos as a', 'o.image_id = a.file_id');
        $this->db->where(array('collection_id' => $collection_id, 'status' => 1 ));
        $query = $this->db->get();
        return $query->result_array();
    }
}