<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Profile extends Base {

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'プロフィール'));
			$this->load->view('sidebar', array('id' => 8));
			$this->load->view('profile/index');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('profile')));
		}
	}
}