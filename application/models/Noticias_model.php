<?php
class Noticias_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($news_id = null, $status = 1, $limit = null, $search = null, $museos = '')
    {
        if ($news_id == null)
        {
            $this->db->select('n.title, a.path, n.news_id, n.excerpt, n.publication_date, n.creation_date, n.modified_date, n.status');
            $this->db->from('noticias' . $museos . ' as n');
            $this->db->join('archivos as a', 'a.file_id = n.image_id', 'left');

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

            $this->db->order_by('publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('n.title, a.path, n.description, n.publication_date, n.excerpt, a.file_name, n.status, n.news_id');
        $this->db->from('noticias' . $museos . ' as n');
        $this->db->join('archivos as a', 'a.file_id = n.image_id', 'left');
        $this->db->where(array('news_id' => $news_id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function set($array, $news_id = null)
    {
        if ($news_id != null) {
            $this->db->set($array);
            $this->db->where('news_id', $news_id);
            $this->db->update('noticias');
        }
        else {
            $this->db->insert('noticias', $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($news_id)
    {
        $this->db->delete('noticias', array('news_id' => $news_id));   
    }

}