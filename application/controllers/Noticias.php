<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Noticias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model');
    }

    public function index()
    {
        $data['news'] = $this->noticias_model->get();
        $h_data['title'] = 'Noticias | Fundación Museos Nacionales';
        $h_data['active'] = 'noticias';

        $this->load->view('includes/header',$h_data);
        $this->load->view('noticias/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($entry, $museos = '')
    {
        if (!is_numeric($entry)){
            $entry = rawurldecode($entry);
            $data['news_item'] = $this->noticias_model->get($entry, 1, null, null, $museos, true, true);
        } else {
            $data['news_item'] = $this->noticias_model->get($entry, 1, null, null, $museos);
        }
        
        if (empty($data['news_item']) || ($data['news_item']['publication_date'] > time() && !$this->ion_auth->logged_in()) || ($data['news_item']['status'] == 0 && !$this->ion_auth->logged_in())){
            show_404();
        }
        $data['photo_gallery'] = $this->noticias_model->get_galeria_fotos($data['news_item']['news_id']);
        $data['news_item']['publication_date'] = date('j \d\e F, Y', $data['news_item']['publication_date']);
        $data['news_item']['description'] = strip_tags($data['news_item']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td>');
        $data['news_item']['path'] = str_replace('public:/', '', $data['news_item']['path']);

        $h_data['title'] = 'Noticias | Fundación Museos Nacionales';
        $h_data['active'] = 'noticias';

        $this->load->view('includes/header',$h_data);
        $this->load->view('noticias/view', $data);
        $this->load->view('includes/footer');

    }
}
