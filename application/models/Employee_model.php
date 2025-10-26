<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all employees with optional search and pagination
    public function get_all($limit = 0, $start = 0, $search = NULL) {
        if ($search) {
            $this->db->group_start()
                     ->like('name', $search)
                     ->or_like('ename', $search)
                     ->or_like('designation', $search)
                     ->group_end();
        }
        if ($limit) {
            $this->db->limit($limit, $start);
        }
        $this->db->order_by('level', 'ASC');
        return $this->db->get('employees')->result();
    }

    // Count total employees with optional search
    public function count_all($search = NULL) {
        if ($search) {
            $this->db->group_start()
                     ->like('name', $search)
                     ->or_like('ename', $search)
                     ->or_like('designation', $search)
                     ->group_end();
        }
        return $this->db->count_all_results('employees');
    }

    // Get a single employee by ID
    public function get($id) {
        return $this->db->get_where('employees', ['empid' => $id])->row();
    }

    // Get a list of managers (exclude self if editing)
    public function get_all_managers($exclude_id = NULL) {
        if ($exclude_id) {
            $this->db->where('empid !=', $exclude_id);
        }
        $this->db->order_by('level', 'ASC');
        return $this->db->get('employees')->result();
    }

    // Insert new employee
    public function insert_employee($data) {
        $insert_data = [
            'name'        => trim($data['name']),
            'mob'         => !empty($data['mob']) ? trim($data['mob']) : NULL,
            'ename'       => trim($data['ename']),
            'designation' => trim($data['designation']),
            'level'       => (int) $data['level'],
            'manager'     => !empty($data['manager']) ? $data['manager'] : NULL,
            'mgrid'       => !empty($data['mgrid']) ? (int) $data['mgrid'] : NULL
        ];
        return $this->db->insert('employees', $insert_data);
    }

    // Update existing employee
    public function update_employee($id, $data) {
        $update_data = [
            'name'        => trim($data['name']),
            'mob'         => !empty($data['mob']) ? trim($data['mob']) : NULL,
            'designation' => trim($data['designation']),
            'level'       => (int) $data['level'],
            'manager'     => !empty($data['manager']) ? $data['manager'] : NULL,
            'mgrid'       => !empty($data['mgrid']) ? (int) $data['mgrid'] : NULL
        ];
        $this->db->where('empid', $id);
        return $this->db->update('employees', $update_data);
    }

    // Delete employee
    public function delete_employee($id) {
        $this->db->where('empid', $id);
        return $this->db->delete('employees');
    }
    
    // Get employee by ename (for validation)
    public function get_by_ename($ename) {
        return $this->db->get_where('employees', ['ename' => $ename])->row();
    }

    // Get CEO (level 1 employee) excluding specific ID
    public function get_ceo($exclude_id = null) {
        $this->db->where('level', 1);
        if ($exclude_id) {
            $this->db->where('empid !=', $exclude_id);
        }
        return $this->db->get('employees')->row();
    }
    
    // NEW METHOD: Get only managers and CEOs for dropdowns
    public function get_managers_and_ceos($exclude_id = NULL) {
        if ($exclude_id) {
            $this->db->where('empid !=', $exclude_id);
        }
        // Get all employees with a level of 1 or 2 (CEO and Manager)
        $this->db->where_in('level', [1, 2]);
        $this->db->order_by('level', 'ASC');
        return $this->db->get('employees')->result();
    }
} // <--- The class's final closing brace is correctly placed here.