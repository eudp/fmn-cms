<?php
class enlaces_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($link_id = null, $status = 1)
    {
        if ($link_id == null) 
        {
            $this->db->select('u.first_name, e.title, e.url, a.path, e.status, e.link_id, e.creation_date, e.modified_date');
            $this->db->from('enlaces as e');
            $this->db->join('archivos as a', 'a.file_id = e.image_id', 'left');
            $this->db->join('usuarios as u', 'u.id = e.user_id');

            if ($status != null) {
                $this->db->where('e.status' , $status);
            }

            $this->db->order_by('creation_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('e.title, e.url, a.path, e.status, e.link_id, a.file_name');
        $this->db->from('enlaces as e');
        $this->db->join('archivos as a', 'a.file_id = e.image_id', 'left');
        $this->db->where('link_id', $link_id);
        $query = $this->db->get();
        return $query->row_array();
        
    }

    public function set($array, $link_id = null)
    {
        if ($link_id != null) {
            $this->db->set($array);
            $this->db->where('link_id', $link_id);
            $this->db->update('enlaces');
        }
        else {
            $this->db->insert('enlaces', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($link_id)
    {
        $this->db->delete('enlaces', array('link_id' => $link_id));   
    }
}