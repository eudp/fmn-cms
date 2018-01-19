<?php
class obras_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($obra_id = null, $status = 1)
    {
        if ($obra_id === null)
        {
            $this->db->select('c.title, a.path, c.obra_id, c.status,c.creation_date, c.modified_date, o.title as title_c');
            $this->db->from('obras as c');
            $this->db->join('archivos as a', 'a.file_id = c.image_id');
            $this->db->join('colecciones as o', 'o.collection_id = c.collection_id');
            if ($status != null) {
                $this->db->where('status', $status);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('c.title, c.description, a.path, a.file_name, c.status, c.obra_id, c.collection_id');
        $this->db->from('obras as c');
        $this->db->join('archivos as a', 'a.file_id = c.image_id');
        $this->db->where('obra_id', $obra_id );
        $query = $this->db->get();
        return $query->row_array();
    }
    public function set ($array, $obra_id = null)
    {
        if ($obra_id != null) {
            $this->db->set($array);
            $this->db->where('obra_id', $obra_id);
            $this->db->update('obras');
        }
        else {
            $this->db->insert('obras', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete ($obra_id)
    {
        $this->db->delete('obras', array('obra_id' => $obra_id));   
    }
}