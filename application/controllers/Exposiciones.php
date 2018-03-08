<?php
class Exposiciones extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('exposiciones_model');
    }

    public function index()
    {
        $data['expositions_active'] = $this->exposiciones_model->get(1);
        $data['expositions_inactive'] = $this->exposiciones_model->get(0);
        $h_data['title'] = 'Exposiciones | Fundación Museos Nacionales';
        $h_data['active'] = 'exposiciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('exposiciones/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($exposition_id)
    {
        $museos = '';
        $data['exposition_item'] = $this->exposiciones_model->get(1,$exposition_id);
        if (empty($data['exposition_item'])){
            $museos = '_museos';
            $data['exposition_item'] = $this->exposiciones_model->get(1, $exposition_id, null, null, null, '_museos');
        }

        if (empty($data['exposition_item'])){
            show_404();
        }
        $data['exposition_item']['description'] = strip_tags($data['exposition_item']['description'],'<a><em><strong><p><br>');
        $data['exposition_carousel'] = $this->exposiciones_model->get_carousel($exposition_id, $museos);

        $h_data['title'] = 'Exposiciones | Fundación Museos Nacionales';
        $h_data['active'] = 'exposiciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('exposiciones/view', $data);
        $this->load->view('includes/footer');

    }
}
