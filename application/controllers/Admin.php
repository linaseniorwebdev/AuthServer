<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'controllers/Base.php';
class Admin extends Base {

	public function api($com = 'list') {
		if ($com === 'list') {
			$this->load->model('Api_model');
			
			$this->Api_model->setTable('admins');
			$this->Api_model->setColumnSearch(array('username'));
			
			$data = array();
			
			$_POST['filter_rows'] = array('level =');
			$_POST['filter_data'] = array(0);
			
			$admins = $this->Api_model->getRows($_POST);
			
			$idx = (isset($_POST['start'])) ? (int)$_POST['start'] : 0;
			foreach ($admins as $admin) {
				$idx++;
				$created = date( 'Y.m.d', strtotime($admin->created_at));
				$modified = date( 'Y.m.d', strtotime($admin->modified_at));
				$data[] = array($idx, $admin->username, $admin->status, $created, $modified, null, $admin->id);
			}
			
			$output = array(
				'draw' => $_POST['draw'],
				'recordsTotal' => $this->Api_model->countAll(),
				'recordsFiltered' => $this->Api_model->countFiltered($_POST),
				'data' => $data,
			);
			
			echo json_encode($output);
		} elseif ($com == 'update') {
			$this->load->model('Admins_model');
			
		}
	}

	public function index() {
		if ($this->login) {
			if ($this->level > 0) {
				$this->load->view('header', array('title' => '管理者リスト'));
				$this->load->view('sidebar', array('id' => 2));
				$this->load->view('admin/index');
				$this->load->view('offset');
				$this->load->view('scripts', array('name' => 'admin/index'));
			} else {
				$this->output->set_status_header('403', 'このページを表示する権限がありません。');
			}
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('admin')));
		}
	}

	public function create() {
		if ($this->login) {
			if ($this->level > 0) {
				if ($this->post_exists()) {
					$this->load->model('Admins_model');
					
					$params = array(
						'username' => $this->input->post('username'),
						'password' => $this->get_hash($this->input->post('password'))
					);
					
					$this->Admins_model->add_admin($params);
					
					// Logging...
					$this->load->model('Logs_model');
					
					$content = '新しい管理者「' . $this->input->post('username') . '」が作成されました。';
					$params = array(
						'user' => '1-1',
						'content' => $content
					);
					
					$this->Logs_model->add_log($params);
					
					redirect('admin');
				}
				$this->load->view('header', array('title' => '管理者追加'));
				$this->load->view('sidebar', array('id' => 3));
				$this->load->view('admin/create');
				$this->load->view('offset');
				$this->load->view('scripts');
			} else {
				$this->output->set_status_header('403', 'このページを表示する権限がありません。');
			}
		} else {
			redirect(base_url('auth') . '?redirect=' . urlencode(base_url('admin/create')));
		}
	}
}