<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('employees'); // redirect to employees instead of dashboard
        }
        $this->load->view('templates/header');
        $this->load->view('auth/login');
        $this->load->view('templates/footer');
    }

    public function login() {
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('auth/login');
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Hardcoded admin credentials
            if ($username === 'admin' && $password === 'admin123') {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_flashdata('success', 'Login successful!');
                redirect('employees');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->set_flashdata('success', 'Logged out successfully!');
        redirect('auth');
    }
}
