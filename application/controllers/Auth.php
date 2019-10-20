<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Auth extends Base {

	public function index() {
		if ($this->login) {
			$url = $this->input->get('redirect');
			if ($url) {
				redirect($url);
			} else {
				redirect('home');
			}
		} else {
			$error = '';

			if ($this->post_exists()) {
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$this->load->model('Admins_model');

				$row = $this->Admins_model->get_by_name($username);
				if ($row) {
					if ($row['status'] == 0) {
						$error = 'アカウントが無効になっています。サポートに連絡してください。';
					} else {
						if ($row['password'] == $this->get_hash($password)) {
							$url = $this->input->get('redirect');
							if ($url) {
								$this->session->set_userdata('admin', $row['id']);
								$this->session->set_userdata('level', $row['level']);
								redirect($url);
							} else {
								redirect('home');
							}
						} else {
							$error = '間違ったパスワード。';
						}
					}
				} else {
					$error = 'そのような管理者はいません。';
				}
			}

			$this->load->view('auth/index', array('error' => $error));
		}
	}

	public function logout() {
		$this->session->unset_userdata('admin');
		$this->session->unset_userdata('level');
		redirect('/');
	}
}