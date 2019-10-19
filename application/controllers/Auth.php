<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $login = false;

	public function __construct() {
		parent::__construct();

		if ($this->session->admin) {
			$this->login = true;
		}
	}

	public function index() {
		if ($this->login) {
			redirect('home');
		} else {
			$error = '';

			if (isset($_POST) && count($_POST) > 0) {
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$this->load->model('Admins_model');

				$row = $this->Admins_model->get_by_name($username);
				if ($row) {
					$password = hash('sha256', $password);
					if ($row['password'] === $password) {
						$url = $this->input->get('redirect');
						if ($url) {
							$this->session->set_userdata('admin', $row['id']);
							redirect($url);
						} else {
							redirect('home');
						}
					} else {
						$error = '間違ったパスワード。';
						$usern = $username;
					}
				} else {
					$error = 'そのような管理者はいません。';
				}
			}

			$this->load->view('auth/index', array('error' => $error));
		}
	}
}