<?php
require_once('../../connection/db.php');

$record=$_POST['recordID'];

$sql="SELECT * FROM `tbl_order` WHERE `idtbl_order`='$record'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$canceluser=$row['insertuser'];

$sqlcanceluser="SELECT `name` FROM `tbl_user` WHERE `idtbl_user`='$canceluser'";
$resultcanceluser=$conn->query($sqlcanceluser);
$rowcanceluser=$resultcanceluser->fetch_assoc();

$sqldetail="SELECT `tbl_order_detail`.*, `tbl_product`.`productname` AS `product` FROM `tbl_order_detail` LEFT JOIN `tbl_product` ON `tbl_product`.`idtbl_product`=`tbl_order_detail`.`tbl_product_idtbl_product` WHERE `tbl_order_detail`.`tbl_order_idtbl_order`='$record'";
$resultdetail=$conn->query($sqldetail);

$sqldelivery="SELECT * FROM `tbl_order_delivery` WHERE `tbl_order_idtbl_order`='$record'";
$resultdelivery=$conn->query($sqldelivery);
$rowdelivery=$resultdelivery->fetch_assoc();
?>
<div class="row">
    <div class="col-12">
        <table class="w-100 tableprint">
            <tbody>
                <tr>
                    <td>&nbsp;</td>
                    <td class="text-right"><img src="images/login.png" width="80" height="80" class="img-fluid"></td>
                    <td colspan="4" class="text-center small align-middle">
                        <h2 class="font-weight-light m-0">LAOL Mart Holdings (Pvt) Ltd</h2>
                        LAOL Mart, No.603, Colombo Road, Katunayeka. Sri Lanka<br>
                        Tel: (+94)77-722-0632 info@laolmart.com
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>            
        </table>
    </div>
</div>
<h3><?php echo 'PO00'.$record; ?></h3>
<table class="table table-striped table-bordered table-sm small">
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th class="text-center">Qty</th>
            <th class="text-right">Unit Price</th>
            <th class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; while($rowdetail=$resultdetail->fetch_assoc()){ $explode=explode('-', $rowdetail['product']); ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rowdetail['product'] ?></td>
            <td class="text-center"><?php echo $rowdetail['qty'] ?></td>
            <td class="text-right"><?php echo number_format($rowdetail['price'],2) ?></td>
            <td class="text-right"><?php echo number_format($rowdetail['total'],2) ?></td>
        </tr>
        <?php $i++;} ?>
    </tbody>
</table>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Total :</div>
    <div class="col-2 text-right font-weight-bold small <?php if($rowdelivery['otherdeliverystatus']==1){echo 'bg-info-soft';} ?>"><?php echo number_format($row['total'],2) ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Discount :</div>
    <div class="col-2 text-right font-weight-bold small"><?php echo number_format($row['discount'],2); ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Ship Cost :</div>
    <div class="col-2 text-right font-weight-bold small"><?php echo number_format($row['shipcost'],2) ?></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">&nbsp;</div>
    <div class="col-2 text-right font-weight-bold small"><hr class="border-dark"></div>
</div>
<div class="row">
    <div class="col-10 text-right font-weight-bold small">Net Total :</div>
    <div class="col-2 text-right font-weight-bold small"><?php echo number_format(($row['nettotal']),2); ?></div>
</div>
<div class="row">
    <div class="col-12 font-weight-bold small"><hr class="border-dark my-1"></div>
    <div class="col-12 font-weight-bold small text-right">
        <?php if($row['paystatus']==1){echo 'Payment done.';}else{echo "COD";} ?>
    </div>
</div>
<div class="row">
    <div class="col-12"><h6 class="title-style small"><span>Delivery Information</span></h6></div>
    <div class="col-2 small">Name:</div>
    <div class="col-10 small"><?php echo $rowdelivery['name'];?></div>
    <div class="col-2 small">Mobile 1:</div>
    <div class="col-10 small"><?php echo $rowdelivery['mobile'];?></div>
    <div class="col-2 small">Mobile 2:</div>
    <div class="col-10 small"><?php echo $rowdelivery['mobile2'];?></div>
    <div class="col-2 small">Address:</div>
    <div class="col-10 small"><?php echo $rowdelivery['address'].'<br>'.$rowdelivery['city'];?></div>
</div>
<?php if($row['status']==2){ ?>
<div class="row">
    <div class="col-12 text-center">
        <div class="alert alert-danger"><?php echo $row['cancelreason'].' - Cancel by '.$rowcanceluser['name']; ?></div>
    </div>
</div>
<?php } ?>