<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	
	public $login = false;
	public $level = 0;
	
	public function __construct() {
		parent::__construct();
		
		if ($this->session->admin) {
			$this->login = true;
			$this->level = (int) $this->session->level;
		}
	}
	
	public function post_exists() {
		if (isset($_POST) && count($_POST) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public function get_hash($string) {
		return hash('sha256', $string);
	}
}