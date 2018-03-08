<?php
class Exposiciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($actual = null, $exposition_id = null, $status = 1, $limit = null, $search = null, $museos = '')
    {
        if ($exposition_id == null)
        {
            $this->db->select('e.title, a.path, e.description, e.exposition_id, e.creation_date, e.modified_date, e.status');
            $this->db->from('exposiciones' . $museos . ' as e');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = e.image_id', 'left');

            if ($actual != null) {
                $this->db->where('actual', $actual);
            }
            if ($status != null) {
                $this->db->where('status', $status);
            }
            if ($search != null){
                $this->db->like('LOWER(description)', strtolower($search));
                $this->db->or_like('LOWER(title)', strtolower($search));
            }
            if ($limit != null){
                $this->db->limit($limit);
            }

            $this->db->order_by('e.creation_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.title, e.description, t.title as title_m, t.address, t.establishment_id, e.exhibition_place, e.schedule, e.status, e.actual, a.path, a.file_name, e.exposition_id');
        $this->db->from('exposiciones' . $museos . ' as e');
        $this->db->join('establecimientos as t', 'e.establishment_id = t.establishment_id', 'left');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = e.image_id', 'left');
        $this->db->where('exposition_id', $exposition_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_carousel($exposition_id, $museos)
    {
        $this->db->select('a.path');
        $this->db->from('exposiciones' . $museos . ' as e');
        $this->db->join('carrusel' . $museos . ' as c', 'e.exposition_id = c.element_id');
        $this->db->join('archivos' . $museos . ' as a', 'c.image_id = a.file_id');
        $this->db->where(array('exposition_id' => $exposition_id ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function set($array, $exposition_id = null)
    {
        if ($exposition_id != null) {
            $this->db->set($array);
            $this->db->where('exposition_id', $exposition_id);
            $this->db->update('exposiciones');
        }
        else {
            $this->db->insert('exposiciones', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($exposition_id)
    {
        $this->db->delete('exposiciones', array('exposition_id' => $exposition_id));   
    }
}