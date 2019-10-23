<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class User extends Base {
	
	public function api($com = 'list') {
		if ($com === 'list') {
			$this->load->model('Api_model');
			
			$this->Api_model->setTable('users');
			$this->Api_model->setColumnSearch(array('firstname', 'lastname'));
			
			$data = array();
			
			$_POST['filter_rows'] = array();
			$_POST['filter_data'] = array();
			
			$users = $this->Api_model->getRows($_POST);
			
			$idx = (isset($_POST['start'])) ? (int)$_POST['start'] : 0;
			foreach ($users as $user) {
				$idx++;

				if ($user->license) {
					$license = $user->license;
				} else {
					$license = 0;
				}

//				$created = date( 'Y.m.d', strtotime($user->created_at));
//				$updated = date( 'Y.m.d', strtotime($user->updated_at));
				$data[] = array($idx, $user->firstname . $user->lastname, $user->uniqueid, $license, $user->status, null, $user->id);
			}
			
			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Api_model->countAll(),
				'recordsFiltered' => $this->Api_model->countFiltered($_POST),
				'data' => $data,
			);
			
			echo json_encode($output);
		} elseif ($com == 'update') {
			$this->load->model('Users_model');
			$this->load->model('Logs_model');
			
			if ($this->aname === 'admin') {
				$admin = 'スーパー管理者に';
			} else {
				$admin = '管理者「' . $this->aname . '」に';
			}
			
			$id       = $this->input->post('id');
			$status   = $this->input->post('status');
			$password = $this->input->post('password');
			
			$row = $this->Users_model->get_by_id($id);
			
			if (isset($_POST['status'])) {
				$this->Users_model->update_user($id, array('status' => $status));
				
				if ($status == 1) {
					$content = 'ユーザー「' . $row['firstname'] . $row['lastname'] . '」が' . $admin . 'よって有効化されています。';
				} else {
					$content = 'ユーザー「' . $row['firstname'] . $row['lastname'] . '」が' . $admin . 'よって無効にされました。';
				}
			} else {
				$this->Users_model->update_user($id, array('password' => $this->get_hash($password)));
				
				$content = 'ユーザー「' . $row['firstname'] . $row['lastname'] . '」のパスワードが' . $admin . 'よってリセットされました。';
			}
			
			$params = array(
				'user' => '1-' . $this->admin,
				'content' => $content
			);
			
//			$this->Logs_model->add_log($params);
			
			if (isset($_POST['password'])) {
				redirect('user');
			}
		}
	}

	public function index() {
		if ($this->login) {
			$this->load->view('header', array('title' => 'ユーザーリスト'));
			$this->load->view('sidebar', array('id' => 6));
			$this->load->view('user/index');
			$this->load->view('offset');
			$this->load->view('scripts', array('name' => 'user/index'));
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('user')));
		}
	}

	public function create() {
		if ($this->login) {
			if ($this->post_exists()) {
				$this->load->model('Users_model');
				
				$firstname = $this->input->post('firstname');
				$lastname  = $this->input->post('lastname');
				
				$uniqueid = md5($firstname . time() . $lastname);
				
				$params = array(
					'firstname' => $firstname,
					'lastname'  => $lastname,
					'uniqueid'  => $uniqueid,
					'password'  => $this->get_hash($this->input->post('password'))
				);
				
				$this->Users_model->add_user($params);
				
				// Logging...
				$this->load->model('Logs_model');
				
				$content = '新しいユーザー「' . $firstname . $lastname . '」が作成されました。';
				$params = array(
					'user' => '1-1',
					'content' => $content
				);
				
//				$this->Logs_model->add_log($params);
				
				redirect('user');
			}
			$this->load->view('header', array('title' => 'ユーザー追加'));
			$this->load->view('sidebar', array('id' => 7));
			$this->load->view('user/create');
			$this->load->view('offset');
			$this->load->view('scripts');
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('user/create')));
		}
	}
}