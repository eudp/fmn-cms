<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model');
        $this->load->model('multimedia_model');
        $this->load->model('agenda_model');
        $this->load->model('enlaces_model');
        $this->load->model('exposiciones_model');
        $this->load->model('destacados_model');

        $this->load->helper('domain_museum');
    }

    public function index()
    {                                         
        $data['highlight'] = $this->destacados_model->get();


        foreach ($data['highlight'] as $key => $value) {
            if ($value['type'] == 'noticias'){
                $out = $this->noticias_model->get($value['element_id']);
                $data['highlight'][$key] += ['publication_date' => $out['publication_date']];
                $data['highlight'][$key] += ['excerpt' => $out['excerpt']];
                $data['highlight'][$key] += ['slug' => $out['slug']];
            } else if ($value['type'] == 'multimedia') {
                $out = $this->multimedia_model->get(false, $value['element_id']);
                $data['highlight'][$key] += ['slug' => $out['slug']];
            } else if ($value['type'] == 'agenda') {
                $out = $this->agenda_model->get($value['element_id']);
                $data['highlight'][$key] += ['slug' => $out['slug']];
            } else if ($value['type'] == 'enlaces') {
                $out = $this->enlaces_model->get($value['element_id']);
                $data['highlight'][$key] += ['url' => $out['url']];
            } 

            $data['highlight'][$key] += ['title' => $out['title']];
            $data['highlight'][$key] += ['path' => $out['path']];
        }
        $h_data['title'] = 'Fundación Museos Nacionales';
        $h_data['active'] = 'home';

        $this->load->view('includes/header',$h_data);
        $this->load->view('home/index', $data);
        $this->load->view('includes/footer');
    }

    /**
     * Realiza la búsqueda
     */
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
        $h_data['title'] = 'Fundación Museos Nacionales';
        $h_data['active'] = 'fmn';

    	$this->load->view('includes/header', $h_data);
        $this->load->view('home/fmn');
        $this->load->view('includes/footer');
    }

    public function educacion()
    {
        $h_data['title'] = 'Fundación Museos Nacionales';
        $h_data['active'] = 'educacion';

    	$this->load->view('includes/header', $h_data);
        $this->load->view('home/eduacion');
        $this->load->view('includes/footer');
    }
}
