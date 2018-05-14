<?php
class Colecciones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Recupera registros de este modelo.
     *
     * @param string|int $entry, id o slug del elemento.
     * @param int $status, estatus del elemento.
     * @param string $museos, su valor puede ser '_museos' o '', dependiendo cual tabla se quiere mostrar.
     * @param boolean $slug, indica si $entry es id o un slug.
    */

    public function get($entry = null, $status = 1, $museos = '', $slug = false)
    {
        if ($entry === null)
        {
            $museums =  ($museos != '' ? ', c.museums': '');
            $w_user_id = ($museos != '' ? 'u.user_id = c.user_id': 'u.id = c.user_id');

            $this->db->select('u.first_name, c.slug, c.title, a.path, c.collection_id, c.status,c.creation_date, c.modified_date' . $museums);
            $this->db->from('colecciones' . $museos . ' as c');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = c.image_id', 'left');
            $this->db->join('usuarios' . $museos . ' as u', $w_user_id);
            if ($status != null) {
                $this->db->where('status', $status);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('c.title, c.description, a.path, a.file_name, c.status, c.collection_id');
        $this->db->from('colecciones' . $museos . ' as c');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = c.image_id', 'left');

        if (!$slug) {
            $this->db->where('collection_id', $entry );
        } else {
            $this->db->where('slug', $entry );
        }
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

    public function set_slug($collection_id, $slug, $museos = '')
    {
        $this->db->set('slug', $slug);
        $this->db->where('collection_id', $collection_id);
        return $this->db->update('colecciones' . $museos);
    }

    public function check_slug($slug, $museos = '')
    {
        $this->db->select('collection_id');
        $this->db->from('colecciones' . $museos);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }
}