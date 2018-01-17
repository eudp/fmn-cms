<?php
class Multimedia_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($audio = false, $multimedia_id = false)
    {
        if ($multimedia_id === false)
        {
            $this->db->select('m.title, a.path, m.multimedia_id');
            $this->db->from('multimedia as m');
            $this->db->join('archivos as a', 'a.file_id = m.image_id');
            $this->db->where(array('status' => 1));
            if ($audio) {
                $this->db->where('type', '52');
            }
            $this->db->order_by('m.creation_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('m.title, m.description, a.path, f.path as multimedia_path, f.file_name');
        $this->db->from('multimedia as m');
        $this->db->join('archivos as a', 'a.file_id = m.image_id');
        $this->db->join('archivos as f', 'f.file_id = m.multimedia_file_id', 'left');
        $this->db->where(array('multimedia_id' => $multimedia_id ));
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_multimedia($limit = 4, $search = null)
    {
        $this->db->select('n.title, n.multimedia_id, n.creation_date');
        $this->db->from('multimedia as n');
        $this->db->where(array('status' => 1 ));
        $this->db->order_by('creation_date', 'DESC');
        $this->db->limit($limit);

        if ($search !== null){
            $this->db->like('LOWER(description)', strtolower($search));
            $this->db->or_like('LOWER(title)', strtolower($search));
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}