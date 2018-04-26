<?php
class Multimedia extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('multimedia_model');
    }

    public function index()
    {
        $data['multimedia_audio'] = $this->multimedia_model->get(true);
        $data['multimedia_others'] = $this->multimedia_model->get();
        $h_data['title'] = 'Multimedias | Fundación Museos Nacionales';
        $h_data['active'] = 'multimedia';

        $this->load->view('includes/header',$h_data);
        $this->load->view('multimedia/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($multimedia_id, $museos = '')
    {
        $data['multimedia_item'] = $this->multimedia_model->get('', $multimedia_id, 1, null, null, $museos );

        if (empty($data['multimedia_item'])){
            show_404();
        }
        $data['multimedia_item']['description'] = strip_tags($data['multimedia_item']['description'],'<a><em><strong><p><br>');
        $data['multimedia_item']['path'] = str_replace('public:/', '', $data['multimedia_item']['path']);

        $h_data['title'] = 'Multimedias | Fundación Museos Nacionales';
        $h_data['active'] = 'multimedia';

        $this->load->view('includes/header',$h_data);
        $this->load->view('multimedia/view', $data);
        $this->load->view('includes/footer');

    }
}
