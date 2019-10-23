<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Licenses extends Base {
	
	public function api($com = 'generate') {
		if ($com == 'generate') {
			$user = $this->input->post('userid');
			$arr  = str_split($user, 4);
			$seed = $arr[3] . '-' . $arr[0] . '-' . $arr[2] . '-' . $arr[1];
			$hash = $this->get_hash($seed);
			echo json_encode(array('hash' => $hash));
		} elseif ($com === 'list') {
			$this->load->model('Api_model');
			$this->load->model('Users_model');

			$this->Api_model->setTable('licenses');
			$this->Api_model->setColumnSearch(array('license', 'machine'));

			$data = array();

			$_POST['filter_rows'] = array();
			$_POST['filter_data'] = array();

			$licenses = $this->Api_model->getRows($_POST);

			$idx = (isset($_POST['start'])) ? (int)$_POST['start'] : 0;
			foreach ($licenses as $license) {
				$idx++;

				if ($license->machine) {
					$machine = '使用中...';
				} else {
					$machine = '使用されていない';
				}

				if ($license->expires) {
					$now  = date_create();
					$new  = date_create($license->expires);
					$diff = date_diff($new, $now);
					$days = $diff->days;

					if ($now > $new) {
						$expires = '<span class="badge badge-danger">期限切れ</span>';
					} else {
						$expires = '<span class="badge badge-success">アクティブ、残り' . $days . '日</span>';
					}
				} else {
					$expires = '<span class="badge badge-primary">無制限</span>';
				}

				$user = $this->Users_model->get_by_license_id($license->id);

				$data[] = array($idx, $license->license, $machine, $expires, $user['firstname'] . $user['lastname'], null, );
			}

			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Api_model->countAll(),
				'recordsFiltered' => $this->Api_model->countFiltered($_POST),
				'data' => $data,
			);

			echo json_encode($output);
		}
	}

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ライセンスリスト'));
			$this->load->view('sidebar', array('id' => 4));
			$this->load->view('license/index');
			$this->load->view('offset');
			$this->load->view('scripts', array('name' => 'license/index'));
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses')));
		}
	}

	public function generate($com = null) {
		if ($this->login) {
			$this->load->model('Users_model');

			if ($this->post_exists()) {
				$this->load->model('Licenses_model');
				$this->load->model('Logs_model');

				$userid  = $this->input->post('userid');
				
				if (strlen($userid) > 0) {
					$row     = $this->Users_model->get_by_uid($userid);
					
					$license = $this->input->post('license');
					$days    = $this->input->post('expires');
					if ($days == '99999') {
						$expires = null;
					} else {
						$expires = date('Y-m-d', strtotime('+' . (((int) $days) / 30) . ' month'));
					}
					
					$license = $this->Licenses_model->add_license(array('license' => $license, 'expires' => $expires));
					
					$this->Users_model->update_user($row['id'], array('license' => $license));
					
					if ($this->aname === 'admin') {
						$admin = 'スーパー管理者に';
					} else {
						$admin = '管理者「' . $this->aname . '」に';
					}
					
					$content = 'ユーザー「' . $row['firstname'] . $row['lastname'] . '」のライセンスが' . $admin . 'よって作成されました。';
					
					$params = array(
						'user' => '1-' . $this->admin,
						'content' => $content
					);
					
//					$this->Logs_model->add_log($params);
				}
			}

			$data = array('users' => $this->Users_model->with_no_license());
			
			if ($com) { $data['current'] = $com; }
			
			$this->load->view('header', array('title' => 'ライセンス生成'));
			$this->load->view('sidebar', array('id' => 5));
			$this->load->view('license/create', $data);
			$this->load->view('offset');
			$this->load->view('scripts', array('name' => 'license/create'));
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses/generate')));
		}
	}
	
	public function view($id = null) {
		if ($this->login) {
			if ($id) {
				$this->load->model('Licenses_model');
				$this->load->model('Users_model');

				$user = $this->Users_model->get_by_license_id($id);
				$license = $this->Licenses_model->get_by_id($id);

				$this->load->view('header', array('title' => 'ライセンス生成'));
				$this->load->view('sidebar', array('id' => 4));
				$this->load->view('license/view', array('user' => $user, 'license' => $license));
				$this->load->view('offset');
				$this->load->view('scripts', array('name' => 'license/view'));
			} else {
				$this->output->set_status_header('400', 'Bad Request');
			}
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses/view/' . $id)));
		}
	}

	public function extend($id = null) {
		if ($this->login) {
			if ($id) {
				$this->load->model('Licenses_model');

				$expires = date('Y-m-d', strtotime('+3 month'));

				$this->Licenses_model->update_license($id, array('expires' => $expires));

				redirect('licenses/view/' . $id);
			} else {
				$this->output->set_status_header('400', 'Bad Request');
			}
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses')));
		}
	}

	public function unuse($id = null) {
		if ($this->login) {
			if ($id) {
				$this->load->model('Licenses_model');

				$this->Licenses_model->update_license($id, array('machine' => NULL));

				redirect('licenses/view/' . $id);
			} else {
				$this->output->set_status_header('400', 'Bad Request');
			}
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('licenses')));
		}
	}
}