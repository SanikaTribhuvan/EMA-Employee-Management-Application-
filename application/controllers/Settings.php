<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Check if the user is logged in
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        
        // Load necessary models, libraries, and helpers
        $this->load->model('Admin_model'); // Assuming you have a model for admin data
        $this->load->helper('url');
    }

    public function index() {
        // Fetch any data you need for the settings page from your model
        // Example: a list of admin users
        $data['admin_users'] = $this->Admin_model->get_all_admins();
        
        // Other data for the view
        $data['themes'] = ['default', 'maroon', 'blue']; // Example data
        
        // Load the views in the correct order: header, content, footer
        $this->load->view('templates/header');
        $this->load->view('settings', $data);
        $this->load->view('templates/footer');
    }
}