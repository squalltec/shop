<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {
    public function index(){
		$this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('cart', $result);
	}
    public function Addtocart(){
        $productID=$this->input->post('productID');
        $qty=$this->input->post('qty');

        $this->db->select('*');
		$this->db->from('tbl_product');
		$this->db->where('idtbl_product', $productID);
		$this->db->where('stock >', 0);
		$query = $this->db->get();
		$row=$query->row_array();

        if($row['disfrom']<=date('Y-m-d') && $row['disto']>=date('Y-m-d')){$itemprice=$row['disprice'];}
        else{$itemprice=$row['price'];}

        $this->db->select('imagepath');
        $this->db->from('tbl_product_images');
        $this->db->where('status', 1);
        $this->db->where('tbl_product_idtbl_product', $productID);
        $this->db->limit(1);

        $respondimage=$this->db->get();

        if(!empty($respondimage->row(0)->imagepath)){$imagepath=$respondimage->row(0)->imagepath;}
        else{$imagepath='images/no-preview.jpg';}
        
        $data = array(           
            'id'      => $row['idtbl_product'],
            'qty'     => $qty,
            'price'   => $itemprice,
            'name'    => preg_replace('/[^a-zA-Z0-9-_\.]/','', $row['productname']),
            'options' => array('shortdesc' => $row['shortdesc'], 'listimagepath' => $imagepath)
        );

        $this->cart->insert($data);
        
        echo $showcart=$this->Showcart();
    }
    public function Showminicart(){
        echo $showcart=$this->Showcart();
    }
    public function Showcart(){
        $output='';
        if(count($this->cart->contents())>0){
            $output.='
            <div class="cart-overlay"></div>
            <a href="#" class="cart-toggle label-down link">
                <i class="w-icon-cart">
                    <span class="cart-count">'.$this->cart->total_items().'</span>
                </i>
                <span class="cart-label">Cart</span>
            </a>
            <div class="dropdown-box">
                <div class="cart-header">
                    <span>Shopping Cart</span>
                    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                </div>

                <div class="products">';
                    $i=1; foreach($this->cart->contents() as $rowshopcart){ if($i<3){
                    $output.='<div class="product product-cart">
                        <div class="product-detail">
                            <a href="#" class="product-name">'.$rowshopcart['name'].'</a>
                            <div class="price-box">
                                <span class="product-quantity">'.$rowshopcart['qty'].'</span>
                                <span class="product-price">Rs. '.$rowshopcart['price'].'</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="product-default.html">
                                <img src="'.base_url().$rowshopcart['options']['listimagepath'].'" alt="product" height="84"
                                    width="94" />
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close removecartitem" id="'.$rowshopcart['rowid'].'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>';
                    }$i++;}
                $output.='</div>

                <div class="cart-total">
                    <label>Subtotal:</label>
                    <span class="price">Rs '.$this->cart->format_number($this->cart->total()).'</span>
                </div>

                <div class="cart-action">
                    <a href="'.base_url().'Cart" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                    <a href="'.base_url().'Cart/Checkout" class="btn btn-primary  btn-rounded">Checkout</a>
                </div>
            </div>
            ';

            return $output;
        }
        else{
            $output.='
            <div class="cart-overlay"></div>
            <a href="#" class="cart-toggle label-down link">
                <i class="w-icon-cart">
                    <span class="cart-count">0</span>
                </i>
                <span class="cart-label">Cart</span>
            </a>
            <div class="dropdown-box">
                <div class="cart-header">
                    <span>Shopping Cart</span>
                    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
                </div>

                <div class="products">&nbsp;</div>

                <div class="cart-total">
                    <label>Subtotal:</label>
                    <span class="price">Rs. 0.00</span>
                </div>

                <div class="cart-action">
                    <a href="#" class="btn btn-dark btn-outline btn-rounded" disabled>View Cart</a>
                    <a href="#" class="btn btn-primary  btn-rounded" disabled>Checkout</a>
                </div>
            </div>
            ';
            return $output;
        }
    }
    public function Removeminicart(){
        $data = array(
			'rowid' => $this->input->post('rowID'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
    }
    public function Checkout(){
        $this->load->model('Commoninfo');
        $this->load->model('Cartinfo');
        $this->load->model('Accountinfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$result['citylist']=$this->Cartinfo->Citylist();
		$result['profileinfo']=$this->Accountinfo->Profileinfo();
		$result['shipcost']=$this->Cartinfo->Shipcost();
		$this->load->view('checkout', $result);
    }
    public function Checkpayment(){
        $this->load->model('Cartinfo');
        $result['fetch_data']=$this->Cartinfo->Checkpayment();
    }
    public function Requestcomplete(){
        $this->load->model('Commoninfo');
		$result['topmenucategory']=$this->Commoninfo->Topmenucategory();
		$this->load->view('requestcomplete', $result);
    }
    public function Buyitnow(){
        if(!empty($_SESSION['user_id'])){
            redirect('Cart/Checkout');
        }
        else{
            redirect('Account/Accountlogin');
        }
    }
    public function Checkcityship(){
        $this->load->model('Cartinfo');
        $result['fetch_data']=$this->Cartinfo->Checkcityship();
    }
}