<?php
class Galeria_fotos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get($news_id, $museos = '')
    {

        $this->db->select('d.photo_gallery_id, a.path, a.file_name, a.width, a.height');
        $this->db->from('noticias_galeria_fotos' . $museos . ' as d');
        $this->db->join('archivos' . $museos . ' as a', 'a.file_id = d.image_id', 'left');
        $this->db->where('d.news_id', $news_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function set($array)
    {

        $this->db->insert('noticias_galeria_fotos', $array);

        return $this->db->insert_id();
         
    }

    public function delete($photo_gallery_id)
    {
        $this->db->delete('noticias_galeria_fotos', array('photo_gallery_id' => $photo_gallery_id));   
    }
}