<?php
class Contactenos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $h_data['title'] = 'Contáctenos | Fundación Museos Nacionales';
        $h_data['active'] = 'contactenos';

        $this->load->view('includes/header',$h_data);
        $this->load->view('contactenos/index');
        $this->load->view('includes/footer');
    }

    public function send()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nombre', 'nombre', 'required', array('required' => 'Debes llenar el campo nombre'));
        $this->form_validation->set_rules('apellido', 'Apellido', 'required', array('required' => 'Debes llenar el campo apellido'));
        $this->form_validation->set_rules('email', 'Correo', 'required|valid_email', array('required' => 'Debes llenar el campo correo'));
        $this->form_validation->set_rules('asunto', 'Asunto', 'required', array('required' => 'Debes llenar este campo el campo asunto'));
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required', array('required' => 'Debes llenar este campo el campo mensaje'));

        if ($this->form_validation->run()) {

            

        } else {
            $this->index();
        }
    }
}
