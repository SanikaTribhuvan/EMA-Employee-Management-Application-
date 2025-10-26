<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // The database library should be loaded in your models
        $this->load->database();
    }

    /**
     * Retrieves all admin users.
     * This is a placeholder; you would connect to a 'users' table here.
     */
    public function get_all_admins() {
        // Example query: $query = $this->db->get('users');
        // return $query->result();

        // Returning dummy data for now
        return [
            (object)['username' => 'admin', 'role' => 'Administrator', 'id' => 1],
            (object)['username' => 'editor', 'role' => 'Editor', 'id' => 2],
        ];
    }

    /**
     * Gets a single setting value from the database.
     * This assumes a simple 'settings' table with 'key' and 'value' columns.
     */
    public function get_setting($key) {
        // Example query:
        // $query = $this->db->get_where('settings', ['key' => $key]);
        // $row = $query->row();
        // return $row ? $row->value : null;

        // Returning dummy data for now
        $settings_data = [
            'site_name' => 'Employee Management System',
            'theme' => 'default'
        ];
        return $settings_data[$key] ?? null;
    }

    /**
     * Saves a setting to the database.
     */
    public function save_setting($key, $value) {
        // Example query:
        // $this->db->where('key', $key);
        // $this->db->update('settings', ['value' => $value]);
    }
}