<?php
class Commoninfo extends CI_Model{
    public function Topmenucategory(){
        $categoryarray=array();

        $this->db->select('idtbl_product_category, category, ionclass');
        $this->db->from('tbl_product_category');
        $this->db->where('status', 1);

        $respond=$this->db->get();

        foreach($respond->result() as $rowcategory){
            $maincategoryID=$rowcategory->idtbl_product_category;

            $this->db->select('idtbl_product_sub_category, subcategory');
            $this->db->from('tbl_product_sub_category');
            $this->db->where('tbl_product_category_idtbl_product_category', $maincategoryID);
            $this->db->where('status', 1);

            $respondsub=$this->db->get();

            $obj=new stdClass();
            $obj->idtbl_product_category=$rowcategory->idtbl_product_category;
            $obj->category=$rowcategory->category;
            $obj->iconclass=$rowcategory->ionclass;
            $obj->subcategory=$respondsub->result();

            array_push($categoryarray, $obj);
        }

        return $categoryarray;
    }
}