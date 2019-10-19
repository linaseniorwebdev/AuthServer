<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License extends CI_Controller {

	private $login = false;

	public function __construct() {
		parent::__construct();

		if ($this->session->admin) {
			$this->login = true;
		}
	}


	public function index() {
		$this->load->view('header');
		$this->load->view('sidebar', array('id' => 4));
		$this->load->view('home/index');
		$this->load->view('offset');
		$this->load->view('scripts');
	}
}