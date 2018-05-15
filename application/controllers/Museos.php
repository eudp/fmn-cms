<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Museos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('establecimientos_model');

        $this->load->helper('servicios');
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
    /**
     * Muestra el elemento
     *
     * @param string|int $entry, id o slug del elemento.
     */
    public function view($entry)
    {
        if (!is_numeric($entry)){
            $entry = rawurldecode($entry);
            $data['establishment_item'] = $this->establecimientos_model->get('museo', $entry, null, true);
        } else {
            $data['establishment_item'] = $this->establecimientos_model->get('museo', $entry);
        }

        if (empty($data['establishment_item']) || ($data['establishment_item']['status'] == 0 && !$this->ion_auth->logged_in())){
            show_404();
        }
        $data['establishment_item']['description'] = strip_tags($data['establishment_item']['description'],'<a><em><strong><p><br><ul><ol><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6><span>');
        $data['establishment_carousel'] = $this->establecimientos_model->get_carousel($data['establishment_item']['establishment_id']);

        $h_data['title'] = $data['establishment_item']['title'] . ' | Fundación Museos Nacionales';
        $h_data['active'] = 'museos';

        $this->load->view('includes/header',$h_data);
        $this->load->view('museos/view', $data);
        $this->load->view('includes/footer');

    }
}
