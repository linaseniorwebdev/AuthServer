<?php

class Api_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	public function __construct() {
		parent::__construct();

		$this->table = 'users';
		$this->column_order = array('id');
		$this->column_search = array();
		$this->order = array('id' => 'asc');
	}

	public function getRows($postData) {
		$this->_get_datatables_query($postData);
		if ((int)$postData['length'] !== -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function countAll() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function _get_datatables_query($postData) {
		$this->db->from($this->table);
		if (isset($postData['filter_rows'])) {
			$len = count($postData['filter_rows']);
			for ($i = 0; $i < $len; $i++) {
				$this->db->where($postData['filter_rows'][$i], $postData['filter_data'][$i]);
			}
		}
		$i = 0;
		foreach($this->column_search as $item) {
			if($postData['search']['value']){
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}

				if (count($this->column_search) - 1 === $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if(isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function setTable($table) {
		$this->table = $table;
	}

	public function setColumnSearch($column_search) {
		$this->column_search = $column_search;
	}
}