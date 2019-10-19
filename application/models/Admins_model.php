<?php

class Admins_model extends CI_Model {

	/**
	 * Get all fields of table
	 * @return mixed
	 */
	public function get_table_fields() {
		return $this->db->list_fields('admins');
	}

	/**
	 * Get all admins
	 * @return mixed
	 */
	public function get_all_admins() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('admins')->result_array();
	}

	/**
	 * Function to add new admin
	 * @param $params
	 * @return int
	 */
	public function add_admin($params) {
		if (!$params['photo']) {
			$params['photo'] = 'empty.png';
		}
		$this->db->insert('admins', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update admin
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_admin($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('admins', $params);
	}

	/**
	 * Function to delete admin
	 * @param $id
	 * @return mixed
	 */
	public function delete_admin($id) {
		return $this->db->delete('admins', array('id' => $id));
	}

	/**
	 * Function to get admin by id
	 * @param $admin_id
	 * @return array
	 */
	public function get_by_id($admin_id) {
		return $this->db->get_where('admins', array('id' => $admin_id))->row_array();
	}

	/**
	 * Function to get admin by name
	 * @param $name
	 * @return array
	 */
	public function get_by_name($name) {
		return $this->db->get_where('admins', array('username' => $name))->row_array();
	}
}
