<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Enlaces extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('enlaces_model');
    }

    public function index()
    {
        $data['links'] = $this->enlaces_model->get();
        $h_data['title'] = 'Enlaces | Fundación Museos Nacionales';
        $h_data['active'] = 'enlaces';

        $this->load->view('includes/header',$h_data);
        $this->load->view('enlaces/index', $data);
        $this->load->view('includes/footer');
    }
    
}
