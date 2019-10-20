<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class User extends Base {

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ユーザーリスト'));
			$this->load->view('sidebar', array('id' => 6));
			$this->load->view('user/index');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('user')));
		}
	}

	public function create() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ユーザー追加'));
			$this->load->view('sidebar', array('id' => 7));
			$this->load->view('user/index');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('user/create')));
		}
	}
}