<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Employee_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['employees'] = $this->Employee_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('chart/index', $data);
        $this->load->view('templates/footer');
    }
}
