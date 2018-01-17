<?php
class Agenda_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($diary_id = FALSE)
    {
        if ($diary_id === FALSE)
        {
            $this->db->select('d.title, d.publication_date, d.diary_id');
            $this->db->from('agenda as d');
            $this->db->where(array('status' => 1 ));
            $this->db->order_by('d.publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('d.title, d.description, a.path, d.diary_id, e.title as e_title');
        $this->db->from('agenda as d');
        $this->db->join('archivos as a', 'a.file_id = d.image_id', 'left');
        $this->db->join('establecimientos as e', 'e.establishment_id = d.establishment_id');
        $this->db->where(array('d.diary_id' => $diary_id ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_fechas_agenda($diary_id) {

        $this->db->select('f.date');
        $this->db->from('agenda as d');
        $this->db->join('fechas_agenda as f', 'f.diary_id = d.diary_id');
        $this->db->where(array('d.diary_id' => $diary_id ));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_diary($limit = 4, $search = null)
    {
        $this->db->select('n.title,, n.diary_id, n.publication_date');
        $this->db->from('agenda as n');
        $this->db->where(array('status' => 1 ));
        $this->db->order_by('publication_date', 'DESC');
        $this->db->limit($limit);

        if ($search !== null){
            $this->db->like('LOWER(description)', strtolower($search));
            $this->db->or_like('LOWER(title)', strtolower($search));
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}