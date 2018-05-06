<?php
class Colecciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($collection_id = null, $status = 1, $museos = '')
    {
        if ($collection_id === null)
        {
            $museums =  ($museos != '' ? ', c.museums': '');

            $this->db->select('c.title, a.path, c.collection_id, c.status,c.creation_date, c.modified_date' . $museums);
            $this->db->from('colecciones' . $museos . ' as c');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = c.image_id', 'left');
            if ($status != null) {
                $this->db->where('status', $status);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('c.title, c.description, a.path, a.file_name, c.status, c.collection_id');
        $this->db->from('colecciones' . $museos . ' as c');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = c.image_id', 'left');
        $this->db->where('collection_id', $collection_id );
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_carousel($collection_id, $museos = '')
    {
        $this->db->select('a.path');
        $this->db->from('colecciones ' . $museos . ' as c');
        $this->db->join('carrusel ' . $museos . ' as r', 'c.collection_id = r.element_id');
        $this->db->join('archivos ' . $museos . ' as a', 'r.image_id = a.file_id');
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
    public function set($array, $collection_id = null, $museos = '')
    {
        if ($collection_id != null) {
            $this->db->set($array);
            $this->db->where('collection_id', $collection_id);
            $this->db->update('colecciones' . $museos);
        }
        else {
            $this->db->insert('colecciones' . $museos, $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($collection_id)
    {
        $this->db->delete('colecciones', array('collection_id' => $collection_id));   
    }
}