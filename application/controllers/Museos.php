<?php
class Museos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('establecimientos_model');
    }

    public function index()
    {
        $data['establishments'] = $this->establecimientos_model->get('museo');
        $h_data['title'] = 'Museos | Fundación Museos Nacionales';
        $h_data['active'] = 'museos';

        $this->load->view('includes/header',$h_data);
        $this->load->view('museos/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($establishment_id)
    {
        $data['establishment_item'] = $this->establecimientos_model->get('museo', $establishment_id);
        $data['establishment_item']['description'] = strip_tags($data['establishment_item']['description'],'<a><em><strong><p>');
        $data['establishment_carousel'] = $this->establecimientos_model->get_carousel($establishment_id);
        if (empty($data['establishment_item'])) {
            show_404();
        }

        $h_data['title'] = $data['establishment_item']['title'] . ' | Fundación Museos Nacionales';
        $h_data['active'] = 'museos';

        $this->load->view('includes/header',$h_data);
        $this->load->view('museos/view', $data);
        $this->load->view('includes/footer');

    }
}
