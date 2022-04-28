<?php
class Shopinfo extends CI_Model{
    public function Leftcategorylist(){
        $this->db->select('idtbl_product_category, category');
        $this->db->from('tbl_product_category');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
    public function Loadallproduct($perpage, $page){
        $num_rec_per_page=$perpage;
        if ($page>0) { $page  = $page; } else { $page=1; }; 
        $start_from = ($page-1) * $num_rec_per_page; 
        // echo $start_from;
        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_category.category, tbl_product.disprice, tbl_product.disfrom, tbl_product.disto');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);
        $this->db->order_by('tbl_product.idtbl_product', 'DESC');
        $this->db->limit($num_rec_per_page, $start_from);

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
            $obj->category=$rowproduct->category;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Loadcategoryproduct($category, $perpage, $page){
        $num_rec_per_page=$perpage;
        if ($page>0) { $page  = $page; } else { $page=1; }; 
        $start_from = ($page-1) * $num_rec_per_page; 

        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_category.category, tbl_product.disprice, tbl_product.disfrom, tbl_product.disto');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);
        $this->db->where('tbl_product.tbl_product_category_idtbl_product_category', $category);
        $this->db->order_by('tbl_product.idtbl_product', 'DESC');
        $this->db->limit($num_rec_per_page, $start_from);

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
            $obj->category=$rowproduct->category;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Productinfo($x){
        $productID=$x;

        $this->db->select('tbl_product.*, tbl_product_category.category, tbl_product_category.imagepath');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);
        $this->db->where('tbl_product.idtbl_product', $productID);

        $respond=$this->db->get();

        $this->db->select('imagepath');
        $this->db->from('tbl_product_images');
        $this->db->where('status', 1);
        $this->db->where('tbl_product_idtbl_product', $productID);

        $respondimage=$this->db->get();

        $this->db->select('AVG(`rating`) AS `avgrating`, COUNT(`idtbl_product_rating`) AS `count`');
        $this->db->from('tbl_product_rating');
        $this->db->where('status', 1);
        $this->db->where('tbl_product_idtbl_product', $productID);

        $respondavgrate=$this->db->get();

        $this->db->select('COUNT(`rating`) AS `ratecount`, `rating`');
        $this->db->from('tbl_product_rating');
        $this->db->where('status', 1);
        $this->db->where('tbl_product_idtbl_product', $productID);
        $this->db->group_by("rating");

        $respondratevise=$this->db->get();

        $this->db->select('`rating`, `name`, `review`, `insertdatetime`');
        $this->db->from('tbl_product_rating');
        $this->db->where('status', 1);
        $this->db->where('tbl_product_idtbl_product', $productID);
        $this->db->group_by("rating");

        $respondrateinfo=$this->db->get();

        $obj=new stdClass();
        $obj->product=$respond->result();
        $obj->productimages=$respondimage->result();
        $obj->productavgrate=$respondavgrate->result();
        $obj->productratevice=$respondratevise->result();
        $obj->productrateinfo=$respondrateinfo->result();

        return $obj;
    }
    public function Categoryproduct($x){
        $productID=$x;

        $productarray=array();

        $sql="SELECT `idtbl_product`, `productname`, `stock`, `price`, `disprice` FROM `tbl_product` WHERE `status`=? AND `tbl_product_category_idtbl_product_category` IN (SELECT `tbl_product_category_idtbl_product_category` FROM `tbl_product` WHERE `status`=? AND `idtbl_product`=?) AND `idtbl_product`!=? ORDER BY `idtbl_product` DESC LIMIT 8";
        $respond=$this->db->query($sql, array(1, 1, $productID, $productID));

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
            $obj->disprice=$rowproduct->disprice;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Categoryproductright($x){
        $productID=$x;

        $productarray=array();

        $sql="SELECT `idtbl_product`, `productname`, `stock`, `price`, `disprice` FROM `tbl_product` WHERE `status`=? AND `tbl_product_category_idtbl_product_category` IN (SELECT `tbl_product_category_idtbl_product_category` FROM `tbl_product` WHERE `status`=? AND `idtbl_product`=?) AND `idtbl_product`!=? ORDER BY `idtbl_product` DESC LIMIT 9,6";
        $respond=$this->db->query($sql, array(1, 1, $productID, $productID));

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
            $obj->disprice=$rowproduct->disprice;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Loadsubcategoryproduct($subcategory, $perpage, $page){
        $num_rec_per_page=$perpage;
        if ($page>0) { $page  = $page; } else { $page=1; }; 
        $start_from = ($page-1) * $num_rec_per_page; 

        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_sub_category.subcategory, tbl_product.disprice, tbl_product.disfrom, tbl_product.disto');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_sub_category', 'tbl_product_sub_category.idtbl_product_sub_category = tbl_product.tbl_product_sub_category_idtbl_product_sub_category ');
        $this->db->where('tbl_product.status', 1);
        $this->db->where('tbl_product.tbl_product_sub_category_idtbl_product_sub_category ', $subcategory);
        $this->db->order_by('tbl_product.idtbl_product', 'DESC');
        $this->db->limit($num_rec_per_page, $start_from);

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
            $obj->category=$rowproduct->subcategory;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Shoptopbanner(){
        $this->db->select('tbl_offer_image.imagepath, tbl_offer_image.titleone, tbl_offer_image.titletwo, tbl_offer_image.titlethree, tbl_offer_image.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_offer_image');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_offer_image.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_offer_image.status', 1);
        $this->db->where('tbl_offer_image.offertype', 4);
        $this->db->limit(1);

        return $respond=$this->db->get();
    }
    public function Rightbanner(){
        $this->db->select('tbl_offer_image.imagepath, tbl_offer_image.titleone, tbl_offer_image.titletwo, tbl_offer_image.titlethree, tbl_offer_image.tbl_product_category_idtbl_product_category, tbl_product_category.category');
        $this->db->from('tbl_offer_image');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_offer_image.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_offer_image.status', 1);
        $this->db->where('tbl_offer_image.offertype', 5);
        $this->db->limit(1);

        return $respond=$this->db->get();
    }
    public function Loadsearchproduct($searchtitle, $perpage, $page){
        $num_rec_per_page=$perpage;
        if ($page>0) { $page  = $page; } else { $page=1; }; 
        $start_from = ($page-1) * $num_rec_per_page; 

        $productarray=array();

        $this->db->select('tbl_product.idtbl_product, tbl_product.productname, tbl_product.stock, tbl_product.price, tbl_product_category.category, tbl_product.disprice, tbl_product.disfrom, tbl_product.disto');
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_category', 'tbl_product_category.idtbl_product_category = tbl_product.tbl_product_category_idtbl_product_category');
        $this->db->where('tbl_product.status', 1);
        $this->db->like('tbl_product.productname', $searchtitle, 'both');
        $this->db->order_by('tbl_product.idtbl_product', 'DESC');
        $this->db->limit($num_rec_per_page, $start_from);

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
            $obj->category=$rowproduct->category;
            $obj->imagepath=$imagepath;
            $obj->avgrating=$respondavgrate->row(0)->avgrating;
            $obj->ratecount=$respondavgrate->row(0)->count;

            array_push($productarray, $obj);
        }        

        return $productarray;
    }
    public function Productrating(){
        $rating=$this->input->post('rating');
        $author=$this->input->post('author');
        $email_1=$this->input->post('email_1');
        $review=$this->input->post('review');
        $producthideid=$this->input->post('producthideid');

        $updatedatetime=date('Y-m-d h:i:s');

        if(!empty($_SESSION['user_id'])){
            $userID=$_SESSION['user_id'];

            $this->db->select('COUNT(*) AS count');
            $this->db->from('tbl_product_rating');
            $this->db->where('status', 1);
            $this->db->where('insertuser', $userID);
            $this->db->where('tbl_product_idtbl_product', $producthideid);

            $respondrateinfo=$this->db->get();

            if($respondrateinfo->row(0)->count==0){
                $datarating = array(
                    'rating'=>$rating, 
                    'name'=>$author, 
                    'email'=>$email_1, 
                    'review'=>$review, 
                    'status'=>'1', 
                    'insertuser'=>$userID, 
                    'insertdatetime'=>$updatedatetime, 
                    'updateuser'=>'', 
                    'updatedatetime'=>'', 
                    'tbl_product_idtbl_product'=>$producthideid
                );  
                $rateinfoinsert=$this->db->insert('tbl_product_rating', $datarating);
                
                redirect($_SERVER['HTTP_REFERER']);
            }
            else{
                $datarating = array(
                    'rating'=>$rating, 
                    'name'=>$author, 
                    'email'=>$email_1, 
                    'review'=>$review,  
                    'updateuser'=>$userID, 
                    'updatedatetime'=>$updatedatetime, 
                );  
                $this->db->where('insertuser', $userID);
                $this->db->where('tbl_product_idtbl_product', $producthideid);
                $updatecutomer=$this->db->update('tbl_product_rating', $datarating);

                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}