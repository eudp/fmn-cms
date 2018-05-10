<?php
class Noticias_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($news_id = null, $status = 1, $limit = null, $search = null, $museos = '', $actual = true)
    {
        if ($news_id == null)
        {

            $museums =  ($museos != '' ? ', n.museums': '');

            $this->db->select('n.title, a.path, n.news_id, n.excerpt, n.publication_date, n.creation_date, n.modified_date, n.status' . $museums);
            $this->db->from('noticias' . $museos . ' as n');
            $this->db->join('archivos' . $museos . ' as a', 'a.file_id = n.image_id', 'left');

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

            if ($actual == true) {
                $this->db->where('publication_date <=' , time());
            }

            $this->db->order_by('publication_date', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('n.title, a.path, n.description, n.publication_date, n.excerpt, a.file_name, n.status, n.news_id');
        $this->db->from('noticias' . $museos . ' as n');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = n.image_id', 'left');
        $this->db->where('news_id', $news_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function set($array, $news_id = null, $museos = '')
    {
        if ($news_id != null) {
            $this->db->set($array);
            $this->db->where('news_id', $news_id);
            $this->db->update('noticias' . $museos);
        }
        else {
            $this->db->insert('noticias' . $museos, $array);

            return $this->db->insert_id();
        }  
    }

    public function delete($news_id)
    {
        $this->db->delete('noticias', array('news_id' => $news_id));   
    }

    public function get_galeria_fotos($news_id, $museos = '')
    {

        $this->db->select('d.photo_gallery_id, a.path, a.file_name, a.width, a.height');
        $this->db->from('noticias_galeria_fotos' . $museos . ' as d');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = d.image_id', 'left');
        $this->db->where('d.news_id', $news_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function set_galeria_fotos($array)
    {

        $this->db->insert('noticias_galeria_fotos', $array);

        return $this->db->insert_id();
         
    }

    public function delete_galeria_fotos($photo_gallery_id)
    {
        $this->db->delete('noticias_galeria_fotos', array('photo_gallery_id' => $photo_gallery_id));   
    }

    public function set_slug($news_id, $slug, $museos = '')
    {
        $this->db->set('slug', $slug);
        $this->db->where('news_id', $news_id);
        return $this->db->update('noticias' . $museos);
    }

    public function check_slug($slug, $museos = '')
    {
        $this->db->select('news_id');
        $this->db->from('noticias' . $museos);
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

}