<?php
class Test_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news($news_id = FALSE)
	{
        if ($news_id === FALSE)
        {
            $query = $this->db->get('multimedia');
            return $query->result_array();
        }

        $query = $this->db->get_where('noticias', array('news_id' => $news_id));
        return $query->row_array();
	}
}