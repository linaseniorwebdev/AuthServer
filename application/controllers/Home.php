<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Home extends Base {

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ダッシュボード'));
			$this->load->view('sidebar', array('id' => 1));
			$this->load->view('home/index');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('home')));
		}
	}
}