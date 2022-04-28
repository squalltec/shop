<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		$this->load->model('Commoninfo');
		$this->load->model('Homeinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['bestsaleproduct']=$this->Homeinfo->Bestsaleproduct();
		$result['newarrivalproduct']=$this->Homeinfo->Newarrivalproduct();
		$result['discountedproduct']=$this->Homeinfo->Discountedproduct();
		$result['featuredproduct']=$this->Homeinfo->Featuredproduct();
		$result['productcategorylist']=$this->Homeinfo->Productcategorylist();
		$result['offercategoryproducts']=$this->Homeinfo->Offercategoryproducts();
		$result['topofferbanner']=$this->Homeinfo->Topofferbanner();
		$result['middleofferbanner']=$this->Homeinfo->Middleofferbanner();
		$result['bottomofferbanner']=$this->Homeinfo->Bottomofferbanner();
		$result['mainslider']=$this->Homeinfo->Mainslider();
		$this->load->view('home', $result);
	}
	public function Pagenotfound(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('pagenotfound', $result);
	}
	public function Privacy(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('privacydatasecure', $result);
	}
	public function Datasecure(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('privacydatasecure', $result);
	}
	public function Sitemap(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('sitemap', $result);
	}
}
