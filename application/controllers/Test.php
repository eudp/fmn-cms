<?php
class Test extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('test_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
                $data['news'] = $this->test_model->get_news();

                $data['title'] = 'News';

                $this->load->view('test/index', $data);
        }
}
