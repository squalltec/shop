<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	public function index(){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');

		$sql="SELECT `idtbl_product` FROM `tbl_product` WHERE `status`=?";
        $respond=$this->db->query($sql, array(1));

        $config['base_url'] = base_url().'Shop/Loadallproductlist/Page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $respond->num_rows();
        $config['per_page'] = 12;

		$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

		if($page==0){
			$startproductno=1;
			if($respond->num_rows()>12){$endproductno=12;}
			else{$endproductno=$respond->num_rows();}
		}
		else{
			$startproductno=($page-1)*$config['per_page'];
			$endcount=$page*$config['per_page'];

			if($respond->num_rows()>$endcount){$endproductno=$endcount;}
			else{$endproductno=$respond->num_rows();}
		}
        
        $config['full_tag_open']    = '<div class="toolbox toolbox-pagination justify-content-between"><p class="showing-info mb-2 mb-sm-0">Showing<span>'.$startproductno.'-'.$endproductno.' of '.$respond->num_rows().'</span>Products</p><ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next"><a href="#" aria-label="Next">';
        $config['next_tag_close']   = '</a></li>';
        $config['prev_tag_open']    = '<li class="prev disabled"><a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
        $config['prev_tag_close']   = '</a></li>';
        $config['first_tag_open']   = '';
        $config['first_tag_close']  = '';
        $config['last_tag_open']    = '';
        $config['last_tag_close']   = '';
        $config['next_link'] = 'Next<i class="w-icon-long-arrow-right"></i>';
        $config['prev_link'] = '<i class="w-icon-long-arrow-left"></i>Prev';

        $this->pagination->initialize($config);
        $result['pagination'] = $this->pagination->create_links(); 

		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['shoptopbanner']=$this->Shopinfo->Shoptopbanner();
		$result['loadproduct']=$this->Shopinfo->Loadallproduct($config["per_page"], $page);
		$this->load->view('shop', $result);
	}
	public function Loadallproductlist(){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');

		$sql="SELECT `idtbl_product` FROM `tbl_product` WHERE `status`=?";
        $respond=$this->db->query($sql, array(1));

        $config['base_url'] = base_url().'Shop/Loadallproductlist/Page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $respond->num_rows();
        $config['per_page'] = 12;

		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		if($page==0){
			$startproductno=1;
			if($respond->num_rows()>12){$endproductno=12;}
			else{$endproductno=$respond->num_rows();}
		}
		else{
			$startproductno=($page-1)*$config['per_page'];
			$endcount=$page*$config['per_page'];

			if($respond->num_rows()>$endcount){$endproductno=$endcount;}
			else{$endproductno=$respond->num_rows();}
		}
        
        $config['full_tag_open']    = '<div class="toolbox toolbox-pagination justify-content-between"><p class="showing-info mb-2 mb-sm-0">Showing<span>'.$startproductno.'-'.$endproductno.' of '.$respond->num_rows().'</span>Products</p><ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next"><a href="#" aria-label="Next">';
        $config['next_tag_close']   = '</a></li>';
        $config['prev_tag_open']    = '<li class="prev disabled"><a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
        $config['prev_tag_close']   = '</a></li>';
        $config['first_tag_open']   = '';
        $config['first_tag_close']  = '';
        $config['last_tag_open']    = '';
        $config['last_tag_close']   = '';
        $config['next_link'] = 'Next<i class="w-icon-long-arrow-right"></i>';
        $config['prev_link'] = '<i class="w-icon-long-arrow-left"></i>Prev';

        $this->pagination->initialize($config);
        $result['pagination'] = $this->pagination->create_links(); 

		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['shoptopbanner']=$this->Shopinfo->Shoptopbanner();
		$result['loadproduct']=$this->Shopinfo->Loadallproduct($config["per_page"], $page);
		$this->load->view('shop', $result);
	}
	public function Product($x, $y){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['productinfo']=$this->Shopinfo->Productinfo($x);
		$result['categoryproduct']=$this->Shopinfo->Categoryproduct($x);
		$result['categoryproductright']=$this->Shopinfo->Categoryproductright($x);
		$result['rightbanner']=$this->Shopinfo->Rightbanner();
		$this->load->view('productview', $result);
	}
	public function Category($x, $y){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');

		$sql="SELECT `idtbl_product` FROM `tbl_product` WHERE `status`=? AND `tbl_product_category_idtbl_product_category`=?";
        $respond=$this->db->query($sql, array(1, $x));

        $config['base_url'] = base_url().'Shop/Category/'.$x.'/'.$y.'/Page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $respond->num_rows();
        $config['per_page'] = 12;

		$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

		if($page==0){
			$startproductno=1;
			if($respond->num_rows()>12){$endproductno=12;}
			else{$endproductno=$respond->num_rows();}
		}
		else{
			$startproductno=($page-1)*$config['per_page'];
			$endcount=$page*$config['per_page'];

			if($respond->num_rows()>$endcount){$endproductno=$endcount;}
			else{$endproductno=$respond->num_rows();}
		}
        
        $config['full_tag_open']    = '<div class="toolbox toolbox-pagination justify-content-between"><p class="showing-info mb-2 mb-sm-0">Showing<span>'.$startproductno.'-'.$endproductno.' of '.$respond->num_rows().'</span>Products</p><ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next"><a href="#" aria-label="Next">';
        $config['next_tag_close']   = '</a></li>';
        $config['prev_tag_open']    = '<li class="prev disabled"><a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
        $config['prev_tag_close']   = '</a></li>';
        $config['first_tag_open']   = '';
        $config['first_tag_close']  = '';
        $config['last_tag_open']    = '';
        $config['last_tag_close']   = '';
        $config['next_link'] = 'Next<i class="w-icon-long-arrow-right"></i>';
        $config['prev_link'] = '<i class="w-icon-long-arrow-left"></i>Prev';

        $this->pagination->initialize($config);
        $result['pagination'] = $this->pagination->create_links(); 

		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['shoptopbanner']=$this->Shopinfo->Shoptopbanner();
		$result['loadproduct']=$this->Shopinfo->Loadcategoryproduct($x, $config["per_page"], $page);
		$this->load->view('shop', $result);
	}
	public function Subcategory($x, $y){
		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');

		$sql="SELECT `idtbl_product` FROM `tbl_product` WHERE `status`=? AND `tbl_product_sub_category_idtbl_product_sub_category`=?";
        $respond=$this->db->query($sql, array(1, $x));

        $config['base_url'] = base_url().'Shop/Subcategory/'.$x.'/'.$y.'/Page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $respond->num_rows();
        $config['per_page'] = 12;

		$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

		if($page==0){
			$startproductno=1;
			if($respond->num_rows()>12){$endproductno=12;}
			else{$endproductno=$respond->num_rows();}
		}
		else{
			$startproductno=($page-1)*$config['per_page'];
			$endcount=$page*$config['per_page'];

			if($respond->num_rows()>$endcount){$endproductno=$endcount;}
			else{$endproductno=$respond->num_rows();}
		}
        
        $config['full_tag_open']    = '<div class="toolbox toolbox-pagination justify-content-between"><p class="showing-info mb-2 mb-sm-0">Showing<span>'.$startproductno.'-'.$endproductno.' of '.$respond->num_rows().'</span>Products</p><ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next"><a href="#" aria-label="Next">';
        $config['next_tag_close']   = '</a></li>';
        $config['prev_tag_open']    = '<li class="prev disabled"><a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
        $config['prev_tag_close']   = '</a></li>';
        $config['first_tag_open']   = '';
        $config['first_tag_close']  = '';
        $config['last_tag_open']    = '';
        $config['last_tag_close']   = '';
        $config['next_link'] = 'Next<i class="w-icon-long-arrow-right"></i>';
        $config['prev_link'] = '<i class="w-icon-long-arrow-left"></i>Prev';

        $this->pagination->initialize($config);
        $result['pagination'] = $this->pagination->create_links(); 

		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['shoptopbanner']=$this->Shopinfo->Shoptopbanner();
		$result['loadproduct']=$this->Shopinfo->Loadsubcategoryproduct($x, $config["per_page"], $page);
		$this->load->view('shop', $result);
	}
	public function Topform(){
		$search=addslashes($this->input->post('search'));
		redirect(base_url().'Shop/Topsearch/'.$search);
	}
	public function Topsearch($x){
		$x=str_replace('%20', ' ', $x);

		$this->load->model('Commoninfo');
		$this->load->model('Shopinfo');

		// $sql="SELECT `idtbl_product` FROM `tbl_product` WHERE `status`=? AND `productname` LIKE ?%";
        // $respond=$this->db->query($sql, array(1, $x));

		$this->db->select('idtbl_product');
        $this->db->from('tbl_product');
        $this->db->where('status', 1);
        $this->db->like('productname', $x, 'both');

		$respond=$this->db->get();

        $config['base_url'] = base_url().'Shop/Category/'.$x.'/Page/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $respond->num_rows();
        $config['per_page'] = 12;

		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		if($page==0){
			$startproductno=1;
			if($respond->num_rows()>12){$endproductno=12;}
			else{$endproductno=$respond->num_rows();}
		}
		else{
			$startproductno=($page-1)*$config['per_page'];
			$endcount=$page*$config['per_page'];

			if($respond->num_rows()>$endcount){$endproductno=$endcount;}
			else{$endproductno=$respond->num_rows();}
		}
        
        $config['full_tag_open']    = '<div class="toolbox toolbox-pagination justify-content-between"><p class="showing-info mb-2 mb-sm-0">Showing<span>'.$startproductno.'-'.$endproductno.' of '.$respond->num_rows().'</span>Products</p><ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['next_tag_open']    = '<li class="next"><a href="#" aria-label="Next">';
        $config['next_tag_close']   = '</a></li>';
        $config['prev_tag_open']    = '<li class="prev disabled"><a href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">';
        $config['prev_tag_close']   = '</a></li>';
        $config['first_tag_open']   = '';
        $config['first_tag_close']  = '';
        $config['last_tag_open']    = '';
        $config['last_tag_close']   = '';
        $config['next_link'] = 'Next<i class="w-icon-long-arrow-right"></i>';
        $config['prev_link'] = '<i class="w-icon-long-arrow-left"></i>Prev';

        $this->pagination->initialize($config);
        $result['pagination'] = $this->pagination->create_links(); 

		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['leftcategory']=$this->Shopinfo->Leftcategorylist();
		$result['shoptopbanner']=$this->Shopinfo->Shoptopbanner();
		$result['loadproduct']=$this->Shopinfo->Loadsearchproduct($x, $config["per_page"], $page);
		$this->load->view('shop', $result);
	}
	public function Productrating(){
		$this->load->model('Shopinfo');
        $result['fetch_data']=$this->Shopinfo->Productrating();
	}
}
