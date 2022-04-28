<?php
session_start();
if(!isset($_SESSION['userid'])){header ("Location:index.php");}
require_once('../../connection/db.php');//die('bc');
$userID=$_SESSION['userid'];
$uploadfilepath='';
$status=0;

$orderlist=json_decode($_POST['orderlist']);
$updatedatetime=date('Y-m-d h:i:s');

function pickup_request($api_key,$client_id,$recipient_name,$recipient_contact_no,$recipient_address,$recipient_city,$parcel_type,$cod_amount,$parcel_description,$order_id,$conn){
    $userID=$_SESSION['userid'];
    $updatedatetime=date('Y-m-d h:i:s');
    // curl post
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://fardardomestic.com/api/p_request_v1.02.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
    "client_id=$client_id&api_key=$api_key&recipient_name=$recipient_name&recipient_contact_no=$recipient_contact_no&recipient_address=$recipient_address&parcel_type=$parcel_type&recipient_city=$recipient_city&parcel_description=$parcel_description&cod_amount=$cod_amount&order_id=$order_id");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close ($ch);

    $arraylist='['.$server_output.']';
    $arraylistdecode=json_decode($arraylist);
    
    foreach($arraylistdecode as $replylist){
        if($replylist->status==204){
            $trackingcode=$replylist->waybill_no;

            $updatetrack="UPDATE `tbl_order` SET `trackingnum`='$trackingcode',`trackingwebsite`='https://fardardomestic.com/',`updatedatetime`='$updatedatetime',`tbl_user_idtbl_user`='$userID' WHERE `idtbl_order`='$order_id'";
            $conn->query($updatetrack);
        }
    }
}

foreach($orderlist as $roworderlist){
    $orderID=$roworderlist->orderid;

    $sql="SELECT * FROM `tbl_order` WHERE `acceptstatus`=1 AND `status`=1 AND `idtbl_order`='$orderID'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();

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
        $orderamount=round(($row['total']+$row['shipcost']+$row['booklet']), 2);
    }
    else{
        $orderamount=round((($row['total']+$row['shipcost']+$row['booklet'])-$row['discount']), 2);
    }

    $contact='';
    $contact.=$rowdeliver['mobile'];
    $address=$rowdeliver['addressone'].' '.$rowdeliver['addresstwo'].' '.$rowdeliver['city'];
    $city=$rowdeliver['city'];
    // $orderno='PO00'.$orderID;

    $api_key = "api60d85c57826cb";
    $client_id = "2871";
    $recipient_name = $customer;
    $recipient_contact_no = $contact;
    $recipient_address = $address;
    $recipient_city = $city;
    $parcel_type = "1";
    $cod_amount = $orderamount;
    $parcel_description = "Cosmetic";
    $order_id = $orderID;

    pickup_request($api_key,$client_id,$recipient_name,$recipient_contact_no,$recipient_address,$recipient_city,$parcel_type,$cod_amount,$parcel_description,$order_id,$conn);
}

header("Location:../ordertracking.php?action=4");