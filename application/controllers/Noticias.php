<?php
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

    public function view($news_id)
    {
        $data['news_item'] = $this->noticias_model->get($news_id);

        $data['news_item']['publication_date'] = date('j \d\e F, Y', $data['news_item']['publication_date']);

        if (empty($data['news_item'])) {
            show_404();
        }

        $h_data['title'] = 'Noticias | Fundación Museos Nacionales';
        $h_data['active'] = 'noticias';

        $this->load->view('includes/header',$h_data);
        $this->load->view('noticias/view', $data);
        $this->load->view('includes/footer');

    }
}
