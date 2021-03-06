<?php defined('BASEPATH') OR exit('No direct script access allowed');
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
    /**
     * Muestra el elemento
     *
     * @param string|int $entry, id o slug del elemento.
     * @param string $museos, su valor puede ser '_museos' o '', dependiendo cual tabla se quiere mostrar.
     */
    
    public function view($entry, $museos = '')
    {
        if (!is_numeric($entry)){
            $entry = rawurldecode($entry);
            $data['exposition_item'] = $this->exposiciones_model->get(1, $entry, 1, null, null, $museos, true);
        } else {
            $data['exposition_item'] = $this->exposiciones_model->get(1, $entry, 1, null, null, $museos);
        }

        

        if (empty($data['exposition_item']) || ($data['exposition_item']['status'] == 0 && !$this->ion_auth->logged_in())){
            show_404();
        }
        $data['exposition_item']['description'] = strip_tags($data['exposition_item']['description'],'<a><em><strong><p><br><ul><ol><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6><span>');
        $data['exposition_carousel'] = $this->exposiciones_model->get_carousel($data['exposition_item']['exposition_id'], $museos);

        $h_data['title'] = 'Exposiciones | Fundación Museos Nacionales';
        $h_data['active'] = 'exposiciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('exposiciones/view', $data);
        $this->load->view('includes/footer');

    }
}
