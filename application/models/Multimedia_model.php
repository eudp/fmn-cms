<?php
class Multimedia_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($audio = false, $multimedia_id = null, $status = 1, $limit = null, $search = null, $museos = '')
    {
        if ($multimedia_id == null)
        {
            $this->db->select('m.title, a.path, m.multimedia_id, m.creation_date, m.modified_date, m.status');
            $this->db->from('multimedia' . $museos . ' as m');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = m.image_id', 'left');

            if ($audio) {
                if ($museos == ''){
                    $this->db->where('type', '52');
                }
                else {
                    //Aún sin type para audios para la base de datos de museos
                }
            }
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

            $this->db->order_by('m.creation_date', 'DESC');
            $query = $this->db->get();

            return $query->result_array();
        }

        $this->db->select('m.title, m.description, a.path, a.file_name, f.path as multimedia_path, f.file_name as multimedia_name, m.status, m.multimedia_id, m.type');
        $this->db->from('multimedia' . $museos . ' as m');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = m.image_id', 'left');
        $this->db->join('archivos' . $museos . ' as f', 'f.file_id = m.multimedia_file_id', 'left');
        $this->db->where('multimedia_id', $multimedia_id);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function set($array, $multimedia_id = null)
    {
        if ($multimedia_id != null) {
            $this->db->set($array);
            $this->db->where('multimedia_id', $multimedia_id);
            $this->db->update('multimedia');
        }
        else {
            $this->db->insert('multimedia', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($multimedia_id)
    {
        $this->db->delete('multimedia', array('multimedia_id' => $multimedia_id));   
    }

}