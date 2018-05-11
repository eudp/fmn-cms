<?php
class Agenda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('agenda_model');
    }

    public function index()
    {
        $data['diary'] = $this->agenda_model->get_calendar();
        $h_data['title'] = 'Agenda | Fundación Museos Nacionales';
        $h_data['active'] = 'agenda';

        $this->load->view('includes/header',$h_data);
        $this->load->view('agenda/index', $data);
        $this->load->view('includes/footer');
    }

    public function view($entry, $museos = '')
    {
        if (!is_numeric($entry)){
            $data['diary_item'] = $this->agenda_model->get($entry,1,null,null,$museos, true);
        } else {
            $data['diary_item'] = $this->agenda_model->get($entry,1,null,null,$museos);
        }
        if (empty($data['diary_item']) || ($data['diary_item']['status'] == 0 && !$this->ion_auth->logged_in())){
            show_404();
        }
        $data['diary_item_fechas'] = $this->agenda_model->get_fechas_agenda($data['diary_item']['diary_id'], $museos);
        $data['diary_item']['description'] = strip_tags($data['diary_item']['description'],'<a><em><strong><p><br><ul><li><table><tbody><tr><td>');

        $h_data['title'] = 'Agenda | Fundación Museos Nacionales';
        $h_data['active'] = 'agenda';

        $this->load->view('includes/header',$h_data);
        $this->load->view('agenda/view', $data);
        $this->load->view('includes/footer');

    }
}
