<?php
class Carrusel_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($element_id, $type, $carousel_id = null, $museos = '')
    {
        if ($carousel_id == null) {

            $this->db->select('d.title, d.description, d.type, d.element_id, d.url, d.carousel_id, a.path, a.file_name');
            $this->db->from('carrusel' . $museos . ' as d');
            $this->db->where(array('d.element_id' => $element_id, 'd.type' => $type));
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = d.image_id', 'left');
            $query = $this->db->get();

            return $query->result_array();
        }

        $this->db->select('n.title, a.path, n.description, a.file_name, n.carousel_id, n.url, n.type, n.element_id');
        $this->db->from('carrusel' . $museos . ' as n');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = n.image_id', 'left');
        $this->db->where('carousel_id', $carousel_id);
        $query = $this->db->get();

        return $query->row_array();

    }

    public function set($array, $carousel_id = null, $museos = '')
    {
        if ($carousel_id != null) {
            $this->db->set($array);
            $this->db->where('carousel_id', $carousel_id);
            $this->db->update('carrusel' . $museos);
        }
        else {
            $this->db->insert('carrusel' . $museos, $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($carousel_id)
    {
        $this->db->delete('carrusel', array('carousel_id' => $carousel_id));   
    }
}