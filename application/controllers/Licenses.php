<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Licenses extends Base {

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ライセンスリスト'));
			$this->load->view('sidebar', array('id' => 4));
			$this->load->view('license/index');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses')));
		}
	}

	public function generate() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ライセンス生成'));
			$this->load->view('sidebar', array('id' => 5));
			$this->load->view('license/create');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses/generate')));
		}
	}
}