<?php
class Establecimientos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Recupera registros de este modelo.
     * @param string $type, indica el tipo del establecimiento 'instituto' o 'museo'.
     * @param string|int $entry, id o slug del elemento.
     * @param int $status, estatus del elemento.
     * @param boolean $slug, indica si $entry es id o un slug.
    */


    public function get($type = null, $entry = null, $status = 1, $slug = false)
    {
        if ($entry === null)
        {
            $this->db->select('u.first_name, e.slug, e.acronym, e.title, a.path, e.establishment_id, e.creation_date, e.modified_date, e.status, e.type');
            $this->db->from('establecimientos as e');
            $this->db->join('archivos as a', 'a.file_id = e.image_id', 'left');
            $this->db->join('usuarios as u', 'u.id = e.user_id');

            if ($type !== null){
                $this->db->where('type' , $type );
            }
            if ($status != null) {
                $this->db->where('status' , $status );
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.acronym, e.title, e.description, e.address, e.phone, e.email, e.facebook_url, e.twitter_url, e.site_url, e.schedule, e.services, e.instagram_url, e.establishment_id, e.status, a.file_name, a.path, e.type');
        $this->db->from('establecimientos as e');
        $this->db->join('archivos as a', 'a.file_id = e.image_id', 'left');
        
        if (!$slug) {
            $this->db->where('establishment_id', $entry );
        } else {
            $this->db->where('slug', $entry );
        }
        
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

    public function set($array, $establishment_id = null)
    {
        if ($establishment_id != null) {
            $this->db->set($array);
            $this->db->where('establishment_id', $establishment_id);
            $this->db->update('establecimientos');
        }
        else {
            $this->db->insert('establecimientos', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($establishment_id)
    {
        $this->db->delete('establecimientos', array('establishment_id' => $establishment_id));   
    }

    public function set_slug($establishment_id, $slug)
    {
        $this->db->set('slug', $slug);
        $this->db->where('establishment_id', $establishment_id);
        return $this->db->update('establecimientos');
    }

    public function check_slug($slug)
    {
        $this->db->select('establishment_id');
        $this->db->from('establecimientos');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }
}