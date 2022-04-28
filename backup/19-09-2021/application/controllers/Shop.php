<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	public function index(){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['loadproduct']=$this->Shopinfo->Loadallproduct();
		$this->load->view('shop', $result);
	}
	public function Product(){
		$this->load->view('productview');
	}
	public function Category($x, $y){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['loadproduct']=$this->Shopinfo->Loadcategoryproduct($x);
		$this->load->view('shop', $result);
	}
}
