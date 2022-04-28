<?php
class Shopinfo extends CI_Model{
    public function Leftcategorylist(){
        $this->db->select('idtbl_product_category, category');
        $this->db->from('tbl_product_category');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
    public function Loadallproduct(){
        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_category.category');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);

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
            $obj->category=$rowproduct->category;
            $obj->imagepath=$imagepath;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Loadcategoryproduct($category){
        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_category.category');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);
        $this->db->where('tbl_product.tbl_product_category_idtbl_product_category', $category);

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
            $obj->category=$rowproduct->category;
            $obj->imagepath=$imagepath;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
}