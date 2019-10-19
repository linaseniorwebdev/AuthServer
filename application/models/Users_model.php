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
		if (!$params['photo']) {
			$params['photo'] = 'empty.png';
		}
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
	 * @return array
	 */
	public function get_by_id($user_id) {
		return $this->db->get_where('users', array('id' => $user_id))->row_array();
	}

	/**
	 * Function to get user by name
	 * @param $name
	 * @return array
	 */
	public function get_by_name($name) {
		return $this->db->get_where('users', array('username' => $name))->row_array();
	}
}
