<?php
class Noticias_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($news_id = FALSE)
    {
        if ($news_id === FALSE)
        {
            $this->db->select('n.title, a.path, n.news_id, n.excerpt, n.publication_date');
            $this->db->from('noticias as n');
            $this->db->join('archivos as a', 'a.file_id = n.image_id');
            $this->db->where(array('status' => 1 ));
            $this->db->order_by('publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('n.title, a.path, n.description, n.publication_date');
        $this->db->from('noticias as n');
        $this->db->join('archivos as a', 'a.file_id = n.image_id');
        $this->db->where(array('news_id' => $news_id ));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_news($limit = 4, $search = null)
    {
        $this->db->select('n.title, n.news_id, n.publication_date, n.excerpt, a.path');
        $this->db->from('noticias as n');
        $this->db->join('archivos as a', 'a.file_id = n.image_id');
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