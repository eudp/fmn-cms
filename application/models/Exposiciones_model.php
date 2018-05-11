<?php
class Exposiciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($actual = null, $entry = null, $status = 1, $limit = null, $search = null, $museos = '', $slug = false)
    {
        if ($entry == null)
        {

            $museums =  ($museos != '' ? ', e.museums': '');
            $w_user_id = ($museos != '' ? 'u.user_id = e.user_id': 'u.id = e.user_id');

            $this->db->select('u.first_name, e.slug, e.title, a.path, e.description, e.exposition_id, e.creation_date, e.modified_date, e.status' . $museums);
            $this->db->from('exposiciones' . $museos . ' as e');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = e.image_id', 'left');
            $this->db->join('usuarios' . $museos . ' as u', $w_user_id);

            if ($actual != null) {
                $this->db->where('actual', $actual);
            }
            if ($status != null) {
                $this->db->where('status', $status);
            }
            if ($search != null){
                $this->db->group_start();
                $this->db->like('LOWER(description)', strtolower($search));
                $this->db->or_like('LOWER(title)', strtolower($search));
                $this->db->group_end();
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

        if (!$slug) {
            $this->db->where('e.exposition_id', $entry);
        } else {
            $this->db->where('e.slug', $entry);
        }
        
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

    public function set($array, $exposition_id = null, $museos = '')
    {
        if ($exposition_id != null) {
            $this->db->set($array);
            $this->db->where('exposition_id', $exposition_id);
            $this->db->update('exposiciones' . $museos);
        }
        else {
            $this->db->insert('exposiciones' . $museos, $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($exposition_id)
    {
        $this->db->delete('exposiciones', array('exposition_id' => $exposition_id));   
    }

    public function set_slug($exposition_id, $slug, $museos = '')
    {
        $this->db->set('slug', $slug);
        $this->db->where('exposition_id', $exposition_id);
        return $this->db->update('exposiciones' . $museos);
    }

    public function check_slug($slug, $museos = '')
    {
        $this->db->select('exposition_id');
        $this->db->from('exposiciones' . $museos);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }
}