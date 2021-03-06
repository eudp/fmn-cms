<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Colecciones extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('colecciones_model');
    }

    public function index()
    {
        $data['collections'] = $this->colecciones_model->get();
        $h_data['title'] = 'Colecciones | Fundación Museos Nacionales';
        $h_data['active'] = 'colecciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('colecciones/index', $data);
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
            $data['collection_item'] = $this->colecciones_model->get($entry, 1, '', true);

        } else {
            $data['collection_item'] = $this->colecciones_model->get($entry);
        }

        
        if (empty($data['collection_item']) || ($data['collection_item']['status'] == 0 && !$this->ion_auth->logged_in())){
            show_404();
        }
        $data['collection_item']['description'] = strip_tags($data['collection_item']['description'],'<a><em><strong><p><br><ul><ol><li><table><tbody><tr><td><u><strike><h1><h2><h3><h4><h5><h6><span>');
        $data['collection_carousel'] = $this->colecciones_model->get_carousel($data['collection_item']['collection_id']);
        $data['collection_works'] = $this->colecciones_model->get_works($data['collection_item']['collection_id']);

        $h_data['title'] = $data['collection_item']['title'] . ' | Fundación Museos Nacionales';
        $h_data['active'] = 'colecciones';

        $this->load->view('includes/header',$h_data);
        $this->load->view('colecciones/view', $data);
        $this->load->view('includes/footer');

    }
}
