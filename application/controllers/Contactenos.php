<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Contactenos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('contacto_model');
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

        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Correo', 'required|valid_email');
        $this->form_validation->set_rules('asunto', 'Asunto', 'required');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors('<li>', '</li>'));

            redirect(site_url('contactenos'), 'refresh');

        } else {

            $array = array(
                'name'           => $this->input->post('nombre'),
                'email'          => $this->input->post('email'),
                'subject'        => $this->input->post('asunto'),
                'message'        => $this->input->post('mensaje'),
                'remote_address' => $this->input->ip_address(),
                'date'           => time()
            );

            $this->contacto_model->set($array);

            $this->session->set_flashdata('success', '¡Mensaje enviado con éxito!');

            redirect(site_url('contactenos'), 'refresh');

        }
    }
}
