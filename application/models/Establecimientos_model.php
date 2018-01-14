<?php
class Establecimientos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($type, $establishment_id = FALSE)
    {
        if ($establishment_id === FALSE)
        {
            $this->db->select('e.acronym, e.title, a.path');
            $this->db->from('establecimientos as e');
            $this->db->join('archivos as a', 'a.file_id = e.image_id');
            $this->db->where(array('type' => $type, 'status' => 1 ));
            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('establecimientos', array('establishment_id' => $establishment_id, 'type' => $type));
        return $query->row_array();
    }
}