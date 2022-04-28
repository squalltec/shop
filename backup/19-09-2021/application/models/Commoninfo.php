<?php
class Commoninfo extends CI_Model{
    public function Topmenucategory(){
        $this->db->select('idtbl_product_category, category');
        $this->db->from('tbl_product_category');
        $this->db->where('status', 1);

        return $respond=$this->db->get();
    }
}