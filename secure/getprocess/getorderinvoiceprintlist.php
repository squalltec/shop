<?php 
require_once('../../connection/db.php');

$fromnoprint=$_POST['fromnoprint'];
$tonoprint=$_POST['tonoprint'];

$sql="SELECT * FROM `tbl_order` WHERE `acceptstatus`=1 AND `trackingnum`!='' AND `status`=1 AND `idtbl_order` BETWEEN '$fromnoprint' AND '$tonoprint'";
$result=$conn->query($sql);
?>
<div class="scrollbar pb-3" id="style-2">
<table class="table table-striped table-bordered table-sm small nowrap" id="tableprintlist">
    <thead>
        <tr>
            <th class="text-center">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkprintallocate" id="selectPrintAll">
                    <label class="custom-control-label" for="selectPrintAll"></label>
                </div>
            </th>
            <th class="d-none">OrderID</th>
            <th>Order No</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Tracking Code</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row=$result->fetch_assoc()){if($row['trackingnum']!=''){
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
        ?>
        <tr>
            <td class="text-center">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input checkallocate" id="customCheck<?php echo $row['idtbl_order'] ?>">
                    <label class="custom-control-label" for="customCheck<?php echo $row['idtbl_order'] ?>"></label>
                </div>
            </td>
            <td class="d-none"><?php echo $orderID; ?></td>
            <td nowrap><?php echo 'PO00'.$orderID; ?></td>
            <td nowrap><?php echo $row['orderdate']; ?></td>
            <td nowrap><?php echo $customer; ?></td>
            <td nowrap><?php echo $rowdeliver['addressone'].' '.$rowdeliver['addresstwo'].' '.$rowdeliver['city']; ?></td>
            <td nowrap><?php echo $rowdeliver['mobile']; ?></td>
            <td nowrap><?php echo $row['trackingnum']; ?></td>
            <td nowrap class="text-right"><?php echo number_format($orderamount, 2); ?></td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
</div>