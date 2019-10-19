<?php

class Licenses_model extends CI_Model {

	/**
	 * Get all fields of table
	 * @return mixed
	 */
	public function get_table_fields() {
		return $this->db->list_fields('licenses');
	}

	/**
	 * Get all licenses
	 * @return mixed
	 */
	public function get_all_licenses() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('licenses')->result_array();
	}

	/**
	 * Function to add new license
	 * @param $params
	 * @return int
	 */
	public function add_license($params) {
		if (!$params['photo']) {
			$params['photo'] = 'empty.png';
		}
		$this->db->insert('licenses', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update license
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_license($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('licenses', $params);
	}

	/**
	 * Function to delete license
	 * @param $id
	 * @return mixed
	 */
	public function delete_license($id) {
		return $this->db->delete('licenses', array('id' => $id));
	}

	/**
	 * Function to get license by id
	 * @param $license_id
	 * @return array
	 */
	public function get_by_id($license_id) {
		return $this->db->get_where('licenses', array('id' => $license_id))->row_array();
	}

	/**
	 * Function to get license by machine id
	 * @param $name
	 * @return array
	 */
	public function get_by_machine($machine) {
		return $this->db->get_where('licenses', array('machine' => $machine))->row_array();
	}

	/**
	 * Function to get license by its value
	 * @param $license
	 * @return array
	 */
	public function get_by_license($license) {
		return $this->db->get_where('licenses', array('license' => $license))->row_array();
	}
}
