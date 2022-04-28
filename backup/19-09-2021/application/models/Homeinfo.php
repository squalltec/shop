<?php
class Homeinfo extends CI_Model{
    public function Newarrivalproduct(){
        $productarray=array();
        $this->db->select('idtbl_product, productname, stock, price');
        $this->db->from('tbl_product');
        $this->db->where('status', 1);
        $this->db->order_by('idtbl_product', 'DESC');
        $this->db->limit(18);

        $respond=$this->db->get();

        foreach($respond->result() as $rowproduct){
            $productID=$rowproduct->idtbl_product;

            $this->db->select('imagepath');
            $this->db->from('tbl_product_images');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);
            $this->db->limit(1);

            $respondimage=$this->db->get();

            if(!empty($respondimage->row(0)->imagepath)){$imagepath=$respondimage->row(0)->imagepath;}
            else{$imagepath='images/No-preview.png';}

            $obj=new stdClass();
            $obj->productid=$rowproduct->idtbl_product;
            $obj->product=$rowproduct->productname;
            $obj->stock=$rowproduct->stock;
            $obj->price=$rowproduct->price;
            $obj->imagepath=$imagepath;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Productcategorylist(){
        $this->db->select('idtbl_product_category, category, imagepath');
        $this->db->from('tbl_product_category');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
}