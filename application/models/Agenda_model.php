<?php
class Agenda_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($diary_id = null, $status = 1, $limit = null, $search = null, $museos = '')
    {
        if ($diary_id == null)
        {

            $museums =  ($museos != '' ? ', d.museums': '');

            $this->db->select('d.title, d.publication_date, d.diary_id, d.creation_date, d.modified_date, d.status' . $museums);
            $this->db->from('agenda' . $museos . ' as d');

            if ($status != null) {
                $this->db->where('status' , $status);
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

            $this->db->order_by('d.publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        //duda con establecimiento en entrada de agendas de museos
        $this->db->select('d.title, d.description, a.path, d.diary_id, e.title as e_title, d.status, d.establishment_id, a.file_name');
        $this->db->from('agenda' . $museos . ' as d');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = d.image_id', 'left');
        $this->db->join('establecimientos' . ' as e', 'e.establishment_id = d.establishment_id', 'left');
        $this->db->where('d.diary_id', $diary_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_calendar($month = null)
    {
    
        $this->db->select('d.title, d.diary_id, f.date');
        $this->db->from('agenda as d');

        $this->db->where('status' , 1);
        
        $this->db->join('fechas_agenda as f', 'f.diary_id = d.diary_id', 'left');

        $this->db->order_by('f.date', 'DESC');
        
        $query = $this->db->get();

        return $query->result_array();
        
    }

    public function get_fechas_agenda($diary_id, $museos = '') {

        $this->db->select('f.date, f.diary_date_id');
        $this->db->from('agenda' . $museos . ' as d');
        $this->db->join('fechas_agenda' . $museos . ' as f', 'f.diary_id = d.diary_id');
        $this->db->where('d.diary_id', $diary_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function set($array, $diary_id = null, $museos = '')
    {
        if ($diary_id != null) {
            $this->db->set($array);
            $this->db->where('diary_id', $diary_id);
            $this->db->update('agenda' . $museos);
        }
        else {
            $this->db->insert('agenda' . $museos, $array);

            return $this->db->insert_id();
        }  
    }
    public function set_fechas_agenda($array)
    {

        $this->db->insert('fechas_agenda', $array);

        return $this->db->insert_id();
    }

    public function delete($diary_id)
    {
        $this->db->delete('agenda', array('diary_id' => $diary_id));   
    }

    public function delete_fechas_agenda($diary_date_id)
    {
        $this->db->delete('fechas_agenda', array('diary_date_id' => $diary_date_id));   
    }
}