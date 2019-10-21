<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {
	
	public $admin = null;
	public $aname = null;
	public $level = 0;
	public $login = false;
	
	public function __construct() {
		parent::__construct();
		
		if ($this->session->admin) {
			$this->admin = $this->session->admin;
			$this->aname = $this->session->names;
			$this->level = (int) $this->session->level;
			$this->login = true;
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