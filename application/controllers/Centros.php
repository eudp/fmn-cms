<?php
class Centros extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('establecimientos_model');
    }

    public function index()
    {
        $data['establishments'] = $this->establecimientos_model->get('instituto');
        $h_data['title'] = 'Centros | Fundación Museos Nacionales';
        $h_data['active'] = 'centros';

        $this->load->view('includes/header',$h_data);
        $this->load->view('centros/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($establishment_id)
    {
        $data['establishment_item'] = $this->establecimientos_model->get('instituto', $establishment_id);
        $data['establishment_item']['description'] = strip_tags($data['establishment_item']['description'],'<a><em><strong><p>');
        $data['establishment_carousel'] = $this->establecimientos_model->get_carousel($establishment_id);
        if (empty($data['establishment_item'])) {
            show_404();
        }

        $h_data['title'] = $data['establishment_item']['title'] . ' | Fundación Museos Nacionales';
        $h_data['active'] = 'centros';

        $this->load->view('includes/header',$h_data);
        $this->load->view('centros/view', $data);
        $this->load->view('includes/footer');

    }
}
