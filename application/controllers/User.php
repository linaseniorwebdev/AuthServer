<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	private $login = false;

	public function __construct() {
		parent::__construct();

		if ($this->session->admin) {
			$this->login = true;
		}
	}


	public function index() {
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('home/index');
		$this->load->view('offset');
		$this->load->view('scripts');
	}
}