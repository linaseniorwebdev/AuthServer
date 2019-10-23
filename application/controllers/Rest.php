<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Rest extends REST_Controller {

	public function check_get() {
		$this->load->model('Licenses_model');

		$machine = $this->get('machine');

		$license = $this->Licenses_model->get_by_machine($machine);

		if ($license) {
			$this->response(['status' => TRUE], REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'このマシンは登録されていません。'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function auth_post() {
		$this->load->model('Users_model');

		$username = $this->post('user');
		$password = $this->post('pass');
		$machine  = $this->post('mach');

		$user = $this->Users_model->get_by_uid($username);
		if ($user) {
			if ($user['status'] == 0) {
				$this->response([
					'status' => FALSE,
					'message' => 'このユーザーは無効になっています。'
				], REST_Controller::HTTP_FORBIDDEN);
			} else {
				if ($user['password'] == hash('sha256', $password)) {
					if ($user['license']) {
						$this->load->model('Licenses_model');

						$license = $this->Licenses_model->get_by_id($user['license']);

						if ($license['expires'] && $this->expired($license['expires'])) {
							$this->response([
								'status' => FALSE,
								'message' => 'ライセンスの期限が切れました。'
							], REST_Controller::HTTP_FORBIDDEN);
						} else {
							if ($license['machine']) {
								if ($license['machine'] == $machine) {
									$this->set_response(['status' => TRUE], REST_Controller::HTTP_OK);
								} else {
									$this->response([
										'status' => FALSE,
										'message' => 'このライセンスはすでに使用中です。'
									], REST_Controller::HTTP_FORBIDDEN);
								}
							} else {
								$this->Licenses_model->update_license($license['id'], array('machine' => $machine));

								$this->set_response(['status' => TRUE], REST_Controller::HTTP_OK);
							}
						}
					} else {
						$this->response([
							'status' => FALSE,
							'message' => 'このユーザーにはライセンスキーがありません。'
						], REST_Controller::HTTP_FORBIDDEN);
					}
				} else {
					$this->response([
						'status' => FALSE,
						'message' => '正しくないパスワード。'
					], REST_Controller::HTTP_FORBIDDEN);
				}
			}
		} else {
			$this->response([
				'status' => FALSE,
				'message' => '指定されたユーザーIDは存在しません。'
			], REST_Controller::HTTP_NOT_FOUND);
		}
	}

	private function expired($expires) {
		$now  = date_create();
		$new  = date_create($expires);

		if ($now > $new) { return true; }

		return false;
	}
}