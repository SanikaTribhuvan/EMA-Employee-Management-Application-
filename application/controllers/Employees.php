<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Employee_model');
        $this->load->library(['form_validation', 'pagination']);
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $search = $this->input->get('search');
        
        // Pagination settings
        $config['base_url'] = base_url('index.php/employees/index');
        $config['total_rows'] = $this->Employee_model->count_all($search);
        $config['per_page'] = 5;
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next &rarr;';
        $config['prev_link'] = '&larr; Previous';
        $config['cur_tag_open'] = '<span class="current">';
        $config['cur_tag_close'] = '</span>';
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';

        $this->pagination->initialize($config);

        $page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        $data['employees'] = $this->Employee_model->get_all($config['per_page'], $page, $search);
        $data['search'] = $search;
        $data['pagination_links'] = $this->pagination->create_links();
        $data['success'] = $this->session->flashdata('success');

        $this->load->view('templates/header');
        $this->load->view('employees/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        // Load data for the form (using a more specific model call)
        $data['managers'] = $this->Employee_model->get_managers_and_ceos();

        // Set validation rules
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('ename','Employee Code','required|is_unique[employees.ename]|alpha_dash');
        $this->form_validation->set_rules('designation','Designation','required|trim');
        $this->form_validation->set_rules('level','Level','required|integer|greater_than[0]');
        $this->form_validation->set_rules('mob','Mobile','trim|regex_match[/^[0-9+\-]{10,15}$/]');
        $this->form_validation->set_rules('manager','Manager','callback_validate_manager');
        $this->form_validation->set_rules('mgrid','Manager ID','callback_validate_mgrid');

        // Check form submission and validation
        if ($this->form_validation->run() === FALSE) {
            // Check custom business rules and add errors if they exist
            $this->validate_business_rules($this->input->post(), $data);

            $this->load->view('templates/header');
            $this->load->view('employees/create', $data);
            $this->load->view('templates/footer');
        } else {
            // Validation passed, insert the employee
            $post_data = $this->input->post();
            
            if ($this->Employee_model->insert_employee($post_data)) {
                $this->session->set_flashdata('success', 'Employee added successfully!');
                redirect('employees');
            } else {
                $this->session->set_flashdata('error', 'There was an error adding the employee.');
                redirect('employees/create');
            }
        }
    }

    public function edit($id) {
        $employee = $this->Employee_model->get($id);
        if(!$employee){
            show_404();
        }

        // Load data for the form (using a more specific model call)
        $data['employee'] = $employee;
        $data['managers'] = $this->Employee_model->get_managers_and_ceos($id);

        // Validation rules for edit (ename is readonly)
        $this->form_validation->set_rules('name','Name','required|trim');
        $this->form_validation->set_rules('designation','Designation','required|trim');
        $this->form_validation->set_rules('level','Level','required|integer|greater_than[0]');
        $this->form_validation->set_rules('mob','Mobile','trim|regex_match[/^[0-9+\-]{10,15}$/]');
        $this->form_validation->set_rules('manager','Manager','callback_validate_manager');
        $this->form_validation->set_rules('mgrid','Manager ID','callback_validate_mgrid');

        if ($this->form_validation->run() === FALSE) {
            $this->validate_business_rules($this->input->post(), $data, $id);

            $this->load->view('templates/header');
            $this->load->view('employees/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $post_data = $this->input->post();
            if ($this->Employee_model->update_employee($id, $post_data)) {
                $this->session->set_flashdata('success', 'Employee updated successfully!');
                redirect('employees');
            } else {
                $this->session->set_flashdata('error', 'There was an error updating the employee.');
                redirect('employees/edit/' . $id);
            }
        }
    }

    public function delete($id) {
        // Good practice to ensure it's a POST request for deletion
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_404();
        }

        $this->Employee_model->delete_employee($id);
        $this->session->set_flashdata('success', 'Employee deleted successfully!');
        redirect('employees');
    }

    // Custom validation for manager field
    public function validate_manager($manager) {
        if(!empty($manager)) {
            $manager_exists = $this->Employee_model->get_by_ename($manager);
            if(!$manager_exists) {
                $this->form_validation->set_message('validate_manager', 'Selected manager does not exist');
                return FALSE;
            }
        }
        return TRUE;
    }

    // Custom validation for mgrid field
    public function validate_mgrid($mgrid) {
        if(!empty($mgrid)) {
            $manager_exists = $this->Employee_model->get($mgrid);
            if(!$manager_exists) {
                $this->form_validation->set_message('validate_mgrid', 'Selected manager ID does not exist');
                return FALSE;
            }
        }
        return TRUE;
    }

    // Business rule validations (now adds errors to the form_validation library)
    private function validate_business_rules($data, &$data_for_view, $exclude_id = null) {
        $valid = TRUE;

        // Check manager and mgrid consistency
        if (!empty($data['manager']) && !empty($data['mgrid'])) {
            $manager = $this->Employee_model->get_by_ename($data['manager']);
            if ($manager && $manager->empid != $data['mgrid']) {
                $this->form_validation->set_message('manager', 'Manager name and Manager ID do not match.');
                $valid = FALSE;
            }
        }

        // Check hierarchy level constraint
        if (!empty($data['manager']) && !empty($data['level'])) {
            $manager = $this->Employee_model->get_by_ename($data['manager']);
            if ($manager && $manager->level >= $data['level']) {
                $this->form_validation->set_message('level', 'Manager level must be less than employee level.');
                $valid = FALSE;
            }
        }

        // Check for exactly one CEO (level 1)
        if (isset($data['level']) && $data['level'] == 1) {
            $existing_ceo = $this->Employee_model->get_ceo($exclude_id);
            if ($existing_ceo) {
                $this->form_validation->set_message('level', 'Only one CEO (level 1) is allowed.');
                $valid = FALSE;
            }
            if (!empty($data['manager']) || !empty($data['mgrid'])) {
                $this->form_validation->set_message('manager', 'CEO cannot have a manager.');
                $valid = FALSE;
            }
        }

        return $valid;
    }
}