<?php
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model');
        $this->load->model('multimedia_model');
        $this->load->model('agenda_model');
        $this->load->model('exposiciones_model');

        $this->load->helper('domain_museum');
    }

    public function index()
    {                                         
        $data['news'] = $this->noticias_model->get(null,1,4);
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

	        $data['news'] = $this->noticias_model->get(null,1,4,$this->input->post('search'));
            $data['news_museums'] = $this->noticias_model->get(null,1,4,$this->input->post('search'),'_museos');
	        $data['multimedia'] = $this->multimedia_model->get('',null,null,4, $this->input->post('search'));
            $data['multimedia_museums'] = $this->multimedia_model->get('', null,null,4,$this->input->post('search'), '_museos');
	        $data['diary'] = $this->agenda_model->get(null,1,4,$this->input->post('search'));
            $data['diary_museums'] = $this->agenda_model->get(null,1,4,$this->input->post('search'),'_museos');
	        $data['expositions'] = $this->exposiciones_model->get('',null,1,4,$this->input->post('search'));
            $data['expositions_museums'] = $this->exposiciones_model->get('',null,1,4,$this->input->post('search'),'_museos');
            
	        $h_data['title'] = 'Buscar | Fundación Museos Nacionales';
	        $h_data['active'] = 'search';

			$this->load->view('includes/header',$h_data);
	        $this->load->view('home/search', $data);
	        $this->load->view('includes/footer');

    	} else {
    		redirect(site_url());
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
