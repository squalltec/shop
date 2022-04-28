<?php
class Homeinfo extends CI_Model{
    public function Newarrivalproduct(){
        $productarray=array();
        $this->db->select('idtbl_product, productname, stock, price, disprice, disfrom, disto');
        $this->db->from('tbl_product');
        $this->db->where('status', 1);
        $this->db->order_by('idtbl_product', 'DESC');
        $this->db->limit(20);

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
            else{$imagepath='images/no-preview.jpg';}

            if($rowproduct->disfrom<=date('Y-m-d') && $rowproduct->disto>=date('Y-m-d')){
                $disprice=$rowproduct->disprice;
            }
            else{
                $disprice=0;
            }

            $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
            $this->db->from('tbl_product_rating');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);

            $respondavgrate=$this->db->get();

            $obj=new stdClass();
            $obj->productid=$rowproduct->idtbl_product;
            $obj->product=$rowproduct->productname;
            $obj->stock=$rowproduct->stock;
            $obj->price=$rowproduct->price;
            $obj->disprice=$disprice;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

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
    public function Offercategoryproducts(){
        $mainarray=array();
        $this->db->select('idtbl_product_category, category, frontimage, titleone, titletwo, titlethree');
        $this->db->from('tbl_product_category');
        $this->db->where('frontstatus', 1);
        $this->db->where('status', 1);
        $this->db->order_by('idtbl_product_category', 'ASC');
        $this->db->limit(3);

        $respond=$this->db->get();

        foreach($respond->result() as $rowfrontcategory){   
            $productarray=array();         
            $categoryID=$rowfrontcategory->idtbl_product_category;

            $this->db->select('idtbl_product, productname, stock, price, disprice, disfrom, disto');
            $this->db->from('tbl_product');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_category_idtbl_product_category', $categoryID);
            $this->db->order_by('idtbl_product', 'DESC');
            $this->db->limit(8);

            $respondproduct=$this->db->get();

            foreach($respondproduct->result() as $rowproduct){
                $productID=$rowproduct->idtbl_product;

                $this->db->select('imagepath');
                $this->db->from('tbl_product_images');
                $this->db->where('status', 1);
                $this->db->where('tbl_product_idtbl_product', $productID);
                $this->db->limit(1);

                $respondimage=$this->db->get();

                if(!empty($respondimage->row(0)->imagepath)){$imagepath=$respondimage->row(0)->imagepath;}
                else{$imagepath='images/no-preview.jpg';}

                if($rowproduct->disfrom<=date('Y-m-d') && $rowproduct->disto>=date('Y-m-d')){
                    $disprice=$rowproduct->disprice;
                }
                else{
                    $disprice=0;
                }

                $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
                $this->db->from('tbl_product_rating');
                $this->db->where('status', 1);
                $this->db->where('tbl_product_idtbl_product', $productID);

                $respondavgrate=$this->db->get();

                $obj=new stdClass();
                $obj->productid=$rowproduct->idtbl_product;
                $obj->product=$rowproduct->productname;
                $obj->stock=$rowproduct->stock;
                $obj->price=$rowproduct->price;
                $obj->disprice=$disprice;
                $obj->imagepath=$imagepath;
                $obj->avgrating=$respondavgrate->row(0)->avgrating;
                $obj->ratecount=$respondavgrate->row(0)->count;

                array_push($productarray, $obj);
            }      
            
            $objmain=new stdClass();
            $objmain->categoryid=$rowfrontcategory->idtbl_product_category;
            $objmain->category=$rowfrontcategory->category;
            $objmain->categoryimage=$rowfrontcategory->frontimage;
            $objmain->titleone=$rowfrontcategory->titleone;
            $objmain->titletwo=$rowfrontcategory->titletwo;
            $objmain->titlethree=$rowfrontcategory->titlethree;
            $objmain->prodcutlist=$productarray;

            array_push($mainarray, $objmain);
        }

        return $mainarray;
    }
    public function Discountedproduct(){
        $productarray=array();
        $this->db->select('idtbl_product, productname, stock, price, discount, disprice, disfrom, disto');
        $this->db->from('tbl_product');
        $this->db->where('status', 1);
        $this->db->where('discountstatus', 1);
        $this->db->order_by('idtbl_product', 'DESC');
        $this->db->limit(20);

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
            else{$imagepath='images/no-preview.jpg';}

            if($rowproduct->disfrom<=date('Y-m-d') && $rowproduct->disto>=date('Y-m-d')){
                $disprice=$rowproduct->disprice;
            }
            else{
                $disprice=0;
            }

            $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
            $this->db->from('tbl_product_rating');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);

            $respondavgrate=$this->db->get();

            $obj=new stdClass();
            $obj->productid=$rowproduct->idtbl_product;
            $obj->product=$rowproduct->productname;
            $obj->stock=$rowproduct->stock;
            $obj->price=$rowproduct->price;
            $obj->disprice=$disprice;
            $obj->discount=$rowproduct->discount;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Featuredproduct(){
        $productarray=array();
        $this->db->select('idtbl_product, productname, stock, price, disprice, disfrom, disto');
        $this->db->from('tbl_product');
        $this->db->where('status', 1);
        $this->db->order_by('idtbl_product', 'DESC');
        $this->db->limit(20);

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
            else{$imagepath='images/no-preview.jpg';}

            if($rowproduct->disfrom<=date('Y-m-d') && $rowproduct->disto>=date('Y-m-d')){
                $disprice=$rowproduct->disprice;
            }
            else{
                $disprice=0;
            }

            $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
            $this->db->from('tbl_product_rating');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);

            $respondavgrate=$this->db->get();

            $obj=new stdClass();
            $obj->productid=$rowproduct->idtbl_product;
            $obj->product=$rowproduct->productname;
            $obj->stock=$rowproduct->stock;
            $obj->price=$rowproduct->price;
            $obj->disprice=$disprice;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Bestsaleproduct(){
        $productarray=array();

        $sql="SELECT `idtbl_product`, `productname`, `stock`, `price`, disprice, disfrom, disto FROM `tbl_product` WHERE `status`=? AND `idtbl_product` IN (SELECT `tbl_product_idtbl_product` FROM `tbl_order_detail` WHERE `status`=? GROUP BY `tbl_product_idtbl_product` ORDER BY SUM(`qty`) DESC) LIMIT 20";
        $respond=$this->db->query($sql, array(1, 1));

        foreach($respond->result() as $rowproduct){
            $productID=$rowproduct->idtbl_product;

            $this->db->select('imagepath');
            $this->db->from('tbl_product_images');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);
            $this->db->limit(1);

            $respondimage=$this->db->get();

            if(!empty($respondimage->row(0)->imagepath)){$imagepath=$respondimage->row(0)->imagepath;}
            else{$imagepath='images/no-preview.jpg';}

            if($rowproduct->disfrom<=date('Y-m-d') && $rowproduct->disto>=date('Y-m-d')){
                $disprice=$rowproduct->disprice;
            }
            else{
                $disprice=0;
            }

            $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
            $this->db->from('tbl_product_rating');
            $this->db->where('status', 1);
            $this->db->where('tbl_product_idtbl_product', $productID);

            $respondavgrate=$this->db->get();

            $obj=new stdClass();
            $obj->productid=$rowproduct->idtbl_product;
            $obj->product=$rowproduct->productname;
            $obj->stock=$rowproduct->stock;
            $obj->price=$rowproduct->price;
            $obj->disprice=$disprice;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Mainslider(){
        $this->db->select('tbl_slideshow.imagepath, tbl_slideshow.titleone, tbl_slideshow.titletwo, tbl_slideshow.titlethree, tbl_slideshow.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_slideshow');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_slideshow.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_slideshow.status', 1);

        return $respond=$this->db->get();
    }
    public function Topofferbanner(){
        $this->db->select('tbl_offer_image.imagepath, tbl_offer_image.titleone, tbl_offer_image.titletwo, tbl_offer_image.titlethree, tbl_offer_image.titlefour, tbl_offer_image.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_offer_image');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_offer_image.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_offer_image.status', 1);
        $this->db->where('tbl_offer_image.offertype', 1);
        $this->db->limit(2);

        return $respond=$this->db->get();
    }
    public function Middleofferbanner(){
        $this->db->select('tbl_offer_image.imagepath, tbl_offer_image.titleone, tbl_offer_image.titletwo, tbl_offer_image.titlethree, tbl_offer_image.titlefour, tbl_offer_image.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_offer_image');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_offer_image.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_offer_image.status', 1);
        $this->db->where('tbl_offer_image.offertype', 2);
        $this->db->limit(2);

        return $respond=$this->db->get();
    }
    public function Bottomofferbanner(){
        $this->db->select('tbl_offer_image.imagepath, tbl_offer_image.titleone, tbl_offer_image.titletwo, tbl_offer_image.titlethree, tbl_offer_image.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_offer_image');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_offer_image.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_offer_image.status', 1);
        $this->db->where('tbl_offer_image.offertype', 3);
        $this->db->limit(1);

        return $respond=$this->db->get();
    }
}