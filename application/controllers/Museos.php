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
}
