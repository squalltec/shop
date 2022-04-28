<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {
	public function index(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('aboutus', $result);
	}
}
