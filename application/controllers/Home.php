<?php
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model');
        $this->load->model('multimedia_model');
        $this->load->model('agenda_model');
        $this->load->model('exposiciones_model');
    }

    public function index()
    {
        $data['news'] = $this->noticias_model->get_news();
        $h_data['title'] = 'Fundación Museos Nacionales';
        $h_data['active'] = 'home';

        $this->load->view('includes/header',$h_data);
        $this->load->view('home/index', $data);
        $this->load->view('includes/footer');
    }

    public function search()
    {
    	$this->load->library('form_validation');

    	$this->form_validation->set_rules('search', 'Search', 'required');

    	if ($this->form_validation->run()) {

	        $data['news'] = $this->noticias_model->get_news(4, $this->input->post('search'));
	        $data['multimedia'] = $this->multimedia_model->get_multimedia(4, $this->input->post('search'));
	        $data['diary'] = $this->agenda_model->get_diary(4, $this->input->post('search'));
	        $data['expositions'] = $this->exposiciones_model->get_expositions(4, $this->input->post('search'));

	        $h_data['title'] = 'Buscar | Fundación Museos Nacionales';
	        $h_data['active'] = 'search';

			$this->load->view('includes/header',$h_data);
	        $this->load->view('home/search', $data);
	        $this->load->view('includes/footer');

    	} else {
    		redirect($this->index());
    	}
    }

    public function fmn()
    {
    	$this->load->view('includes/header');
        $this->load->view('home/fmn');
        $this->load->view('includes/footer');
    }

    public function educacion()
    {
    	$this->load->view('includes/header');
        $this->load->view('home/eduacion');
        $this->load->view('includes/footer');
    }
}
