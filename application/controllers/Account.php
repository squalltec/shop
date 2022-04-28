<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	public function index(){
		$this->load->model('Commoninfo');
		$this->load->model('Accountinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['citylist']=$this->Accountinfo->Citylist();
		$result['countrylist']=$this->Accountinfo->Countrylist();
		$result['profileinfo']=$this->Accountinfo->Profileinfo();
		$result['orderlist']=$this->Accountinfo->Orderlist();
		$this->load->view('account', $result);
	}
	public function Signup(){
		$this->load->model('Accountinfo');
        $result['fetch_data']=$this->Accountinfo->Signup();
	}
	public function Accountactivate($x){
		$this->load->model('Commoninfo');
		$this->load->model('Accountinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['getotpmsg']=$this->Accountinfo->Getotpmsg($x);
		$result['userid']=$x;
		$this->load->view('activatecode', $result);
	}
	public function Accountactivatecheck(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Accountactivatecheck();
	}
	public function Register(){
		$this->load->model('Commoninfo');
		$this->load->model('Accountinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['countrylist']=$this->Accountinfo->Countrylist();
		$this->load->view('register', $result);
	}
	public function Accountlogin(){
		$this->load->model('Commoninfo');
		$this->load->model('Homeinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['topofferbanner']=$this->Homeinfo->Topofferbanner();
		$this->load->view('login', $result);
	}
	public function Lostpassword(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('lostpassword', $result);
	}
	public function Accountcheck(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Accountcheck();
	}
	public function Changepassword($x){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['accountid']=$x;
		$this->load->view('passwordchange', $result);
	}
	public function Accountpasswordchange(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Accountpasswordchange();
	}
	public function Loginaccount(){
        $this->load->model('Accountinfo');
        $result=$this->Accountinfo->Loginaccount();

        if($result!=false){
            $userdata=array(
                'user_id'=>$result->idtbl_user,
                'accountname'=>$result->name,
                'username'=>$result->username,
                'type'=>$result->tbl_user_type_idtbl_user_type,
                'loggedin'=>true
            );

            $this->session->set_userdata($userdata);
            
			if($this->cart->total()>0){
				redirect(base_url().'Cart/Checkout');
			}
			else{
				//print_r($user_data);
				redirect(base_url());
			}
        }
        else{
            $this->session->set_flashdata('msg', 'Invalid Username or password');
            redirect('Account/Accountlogin');
        }
    }
	public function Logout(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('accountname');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('type');
        $this->session->unset_userdata('loggedin');
        $this->cart->destroy();
        redirect(base_url());
    }
	public function Accountbilladdress(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Accountbilladdress();
	}
	public function Accountshipaddress(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Accountshipaddress();
	}
	public function Profileupdate(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Profileupdate();
	}
	public function Orderview(){
		$this->load->model('Accountinfo');
		$result['fetch_data']=$this->Accountinfo->Orderview();
	}
}
