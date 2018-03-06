<?php
class Agenda_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($diary_id = null, $status = 1, $limit = 4, $search = null, $museos = '')
    {
        if ($diary_id == null)
        {
            $this->db->select('d.title, d.publication_date, d.diary_id');
            $this->db->from('agenda' . $museos . ' as d');

            if ($status != null) {
                $this->db->where('status' , $status);
            }
            if ($search != null){
                $this->db->like('LOWER(description)', strtolower($search));
                $this->db->or_like('LOWER(title)', strtolower($search));
            }
            if ($limit != null){
                $this->db->limit($limit);
            }

            $this->db->order_by('d.publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        //duda con establecimiento en entrada de agendas de museos
        $this->db->select('d.title, d.description, a.path, d.diary_id, e.title as e_title');
        $this->db->from('agenda' . $museos . ' as d');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = d.image_id', 'left');
        $this->db->join('establecimientos' . ' as e', 'e.establishment_id = d.establishment_id');
        $this->db->where('d.diary_id', $diary_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_fechas_agenda($diary_id, $museos = '') {

        $this->db->select('f.date');
        $this->db->from('agenda' . $museos . ' as d');
        $this->db->join('fechas_agenda' . $museos . ' as f', 'f.diary_id = d.diary_id');
        $this->db->where('d.diary_id', $diary_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}