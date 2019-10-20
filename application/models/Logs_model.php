<?php

class Logs_model extends CI_Model {

	/**
	 * Get all fields of table
	 * @return mixed
	 */
	public function get_table_fields() {
		return $this->db->list_fields('logs');
	}

	/**
	 * Get all logs
	 * @return mixed
	 */
	public function get_all_logs() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('logs')->result_array();
	}

	/**
	 * Function to add new log
	 * @param $params
	 * @return int
	 */
	public function add_log($params) {
		$this->db->insert('logs', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update log
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_log($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('logs', $params);
	}

	/**
	 * Function to delete log
	 * @param $id
	 * @return mixed
	 */
	public function delete_log($id) {
		return $this->db->delete('logs', array('id' => $id));
	}

	/**
	 * Function to get log by id
	 * @param $log_id
	 * @return array
	 */
	public function get_by_id($log_id) {
		return $this->db->get_where('logs', array('id' => $log_id))->row_array();
	}
}
