<?php
session_start();
require_once('../../connection/db.php');

$userID=$_SESSION['userid'];

$fromnoexcel=$_POST['fromnoexcel'];
$tonoexcel=$_POST['tonoexcel'];

$trackinglistarray=array();

$sql="SELECT * FROM `tbl_order` WHERE `acceptstatus`=1 AND `status`=1 AND `shipcost`!=200 AND `idtbl_order` BETWEEN '$fromnoexcel' AND '$tonoexcel'";
$result=$conn->query($sql);
while($row=$result->fetch_assoc()){
    if($row['trackingnum']!=''){
        $orderID=$row['idtbl_order'];
        $customerID=$row['tbl_customer_idtbl_customer'];
        $sqldeliver="SELECT * FROM `tbl_order_delivery` WHERE `status`=1 AND `tbl_order_idtbl_order`='$orderID'";
        $resultdeliver=$conn->query($sqldeliver);
        $rowdeliver=$resultdeliver->fetch_assoc();

        if($rowdeliver['otherdeliverystatus']==0){
            $sqlcustomer="SELECT `firstname`, `lastname` FROM `tbl_customer` WHERE `idtbl_customer`='$customerID'";
            $resultcustomer=$conn->query($sqlcustomer);
            $rowcustomer=$resultcustomer->fetch_assoc();

            $customer=$rowcustomer['firstname'].' '.$rowcustomer['lastname'];
        }
        else{
            $customer=$rowdeliver['name'];
        }

        if($row['dropdiscountstatus']==1){
            $orderamount=round(($row['total']+$row['shipcost']), 2);
        }
        else{
            $orderamount=round((($row['total']+$row['shipcost'])-$row['discount']), 2);
        }

        $contact='';
        $contact.=$rowdeliver['mobile'];
        // if(!empty($rowdeliver['mobiletwo'])){$contact.='/'.$rowdeliver['mobiletwo'];}

        $obj=new stdClass();
        $obj->ordertrack=$row['trackingnum'];
        $obj->orderweight='1';
        $obj->orderno='PO00'.$orderID;
        $obj->orderdesc='Cosmetic';
        $obj->ordercus=$customer;
        $obj->ordercontact=$contact;
        $obj->orderaddress=$rowdeliver['addressone'].' '.$rowdeliver['addresstwo'].' '.$rowdeliver['city'];
        $obj->ordercity=$rowdeliver['city'];
        $obj->orderamount=$orderamount;
        $obj->orderexchange='0';
        array_push($trackinglistarray, $obj);
    }
}
echo '{"data": '.json_encode($trackinglistarray).'}';