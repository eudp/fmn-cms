<?php
class Colecciones extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('colecciones_model');
    }

    public function index()
    {
        $data['collections'] = $this->colecciones_model->get();
        $h_data['title'] = 'Colecciones | Fundación Museos Nacionales';
        $h_data['active'] = 'colecciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('colecciones/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($collection_id)
    {
        $data['collection_item'] = $this->colecciones_model->get($collection_id);
        $data['collection_item']['description'] = strip_tags($data['collection_item']['description'],'<a><em><strong><p><br>');
        $data['collection_carousel'] = $this->colecciones_model->get_carousel($collection_id);
        $data['collection_works'] = $this->colecciones_model->get_works($collection_id);
        if (empty($data['collection_item'])) {
            show_404();
        }

        $h_data['title'] = $data['collection_item']['title'] . ' | Fundación Museos Nacionales';
        $h_data['active'] = 'colecciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('colecciones/view', $data);
        $this->load->view('includes/footer');

    }
}
