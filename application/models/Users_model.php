<?php

class Users_model extends CI_Model {

	/**
	 * Get all fields of table
	 * @return mixed
	 */
	public function get_table_fields() {
		return $this->db->list_fields('users');
	}

	/**
	 * Get all users
	 * @return mixed
	 */
	public function get_all_users() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('users')->result_array();
	}

	/**
	 * Function to add new user
	 * @param $params
	 * @return int
	 */
	public function add_user($params) {
		$this->db->insert('users', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update user
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_user($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('users', $params);
	}

	/**
	 * Function to delete user
	 * @param $id
	 * @return mixed
	 */
	public function delete_user($id) {
		return $this->db->delete('users', array('id' => $id));
	}

	/**
	 * Function to get user by id
	 * @param $user_id
	 * @return mixed
	 */
	public function get_by_id($user_id) {
		return $this->db->get_where('users', array('id' => $user_id))->row_array();
	}

	/**
	 * Function to get user by name
	 * @param $name
	 * @return mixed
	 */
	public function get_by_uid($uniqueid) {
		return $this->db->get_where('users', array('uniqueid' => $uniqueid))->row_array();
	}
	
	/**
	 * Function to get user by license id
	 * @param $license_id
	 * @return mixed
	 */
	public function get_by_license_id($license_id) {
		return $this->db->get_where('users', array('license' => $license_id))->row_array();
	}
	
	/**
	 * Function to get users with no license
	 * @return mixed
	 */
	public function with_no_license() {
		return $this->db->from('users')->where('license', null)->get()->result_array();
	}
}
